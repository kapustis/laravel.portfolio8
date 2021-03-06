<?php

namespace Tests\Feature;


use App\Models\Activity;
use App\Models\Channel;
use App\Models\User;
use Tests\TestCase;


use Illuminate\Foundation\Testing\RefreshDatabase;


class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** публиковать статью*/
    protected function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Models\Thread', $overrides);
        return $this->post(route('blog'), $thread->toArray());
    }

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
        $user = User::factory()->unconfirmed()->create();
        $this->signIn($user);
        $thread = make('App\Models\Thread');
        $this->post(route('blog'), $thread->toArray())
            ->assertRedirect(route('blog'))
            ->assertSessionHas('flash', 'You must first confirm your email address.');
    }

    /** аутентифицированный пользователь может создавать новые темы форума*/
    function test_an_authenticated_user_can_create_new_forum_threads()
    {
        $thread = create('App\Models\Thread');
        $this->get($thread->path())
            ->assertSee('title')
            ->assertSee('body');
    }

    /** для темы требуется канал-категория*/
    function test_a_thread_requires_a_channel()
    {
        Channel::factory()->count(2)->create();
        $this->publishThread(['channel_id' => null])->assertSessionHasErrors('channel_id');
        $this->publishThread(['channel_id' => 999])->assertSessionHasErrors('channel_id');
    }

    /** для темы требуется уникальный slug **/
    function test_a_thread_requires_a_unique_slug()
    {
        $this->signIn();
        $thread = create('App\Models\Thread', ['title' => 'Help Me']);
        $this->assertEquals('help-me', $thread->slug);
        $thread2 = create('App\Models\Thread', ['title' => 'Help Me']);
        $this->assertEquals("help-me-{$thread2['id']}", $thread2['slug']);

    }

    /** цепочка с заголовком, заканчивающимся числом, должна генерировать правильный slug **/
    function test_a_thread_with_a_title_that_ends_in_a_number_should_generate_the_proper_slug()
    {
        $this->signIn();
        create('App\Models\Thread', ['title' => 'Help 13']);
        $thread2 = create('App\Models\Thread', ['title' => 'Help 13']);
        $this->assertEquals("help-13-{$thread2['id']}", $thread2['slug']);
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
        $thread = create('App\Models\Thread');
        $this->delete($thread->path())->assertRedirect('/login');

        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);
    }

    /** авторизованные пользователи могут удалить  тему */
    function test_authorized_users_can_delete_threads()
    {
        $this->signIn();
        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Models\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, Activity::count());
    }


}

