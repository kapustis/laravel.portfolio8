<?php

namespace Tests\Feature;


use App\Model\Activity;
use Tests\TestCase;

//use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\Thread;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** гости могут не создавать темы*/
    function test_guests_may_not_create_threads()
    {
        $this->withExceptionHandling();
        $this->get('/blog/create')->assertRedirect(route('login'));
        $this->post('/blog')->assertRedirect(route('login'));
    }

    /** аутентифицированные пользователи должны сначала подтвердить свой адрес электронной почты, прежде чем создавать темы **/
    function test_authenticated_users_must_first_confirm_their_email_address_before_creating_threads()
    {
        $user = factory('App\Model\User')->states('unconfirmed')->create();
        $this->signIn($user);
        $thread = make('App\Model\Thread');
        $this->post(route('blog'), $thread->toArray())
            ->assertRedirect(route('blog'))
            ->assertSessionHas('flash', 'You must first confirm your email address.');
    }

    /** аутентифицированный пользователь может создавать новые темы форума*/
    function testAnAuthenticatedUserCanCreateNewForumThreads()
    {
        $response = $this->publishThread(['title' => 'Title', 'body' => 'body.']);

        $this->get($response->headers->get('Location'))
            ->assertSee('Title')
            ->assertSee('body.');
    }

    /** для темы требуется канал-категория*/
    function test_a_thread_requires_a_channel()
    {
        factory('App\Model\Channel', 2)->create();
        $this->publishThread(['channel_id' => null])->assertSessionHasErrors('channel_id');
        $this->publishThread(['channel_id' => 999])->assertSessionHasErrors('channel_id');
    }

    /** для темы требуется уникальный slug **/
    function test_a_thread_requires_a_unique_slug()
    {
        $this->signIn();
        $thread = create('App\Model\Thread', ['title' => 'Help Me']);
        $this->assertEquals('help-me', $thread->slug);
        $thread = $this->postJson(route('blog'), $thread->toArray())->json();
        $this->assertEquals("help-me-{$thread['id']}", $thread['slug']);

    }

    /** цепочка с заголовком, заканчивающимся числом, должна генерировать правильный slug **/
    function test_a_thread_with_a_title_that_ends_in_a_number_should_generate_the_proper_slug()
    {
        $this->signIn();
        $thread = create('App\Model\Thread', ['title' => 'Help 13']);
        $thread = $this->postJson(route('blog'), $thread->toArray())->json();
        $this->assertEquals("help-13-{$thread['id']}", $thread['slug']);
    }

    /** для темы требуется заголовок*/
    function test_a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])->assertSessionHasErrors('title');
    }

    /** для темы требуется текст*/
    function test_a_thread_requires_a_body_text()
    {
        $this->publishThread(['body' => null])->assertSessionHasErrors('body');
    }

    /** неавторизованные пользователи могут не удалить тему*/
    function test_unauthorized_users_may_not_delete_threads()
    {
        $this->withExceptionHandling();
        $thread = create('App\Model\Thread');
        $this->delete($thread->path())->assertRedirect('/login');

        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);
    }

    /** авторизованные пользователи могут удалить  тему */
    function test_authorized_users_can_delete_threads()
    {
        $this->signIn();
        $thread = create('App\Model\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Model\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, Activity::count());
    }

    /** публиковать статью*/
    protected function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Model\Thread', $overrides);
        return $this->post(route('blog'), $thread->toArray());
    }
}

