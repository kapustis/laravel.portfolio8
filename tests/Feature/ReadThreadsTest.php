<?php

namespace Tests\Feature;

use App\Models\BlogThread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property mixed thread
 */
class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() :void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = BlogThread::factory()->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {

        $this->get('/blog')
            ->assertSee($this->thread->title);

    }

    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

//    /** @test */
//    function a_user_can_read_replies_that_are_associated_with_a_thread()
//        /**пользователь может читать ответы, которые связаны с темой*/
//    {
//        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);
//        $this->get($this->thread->path())
//            ->assertSee($reply->body);
//    }

    function test_a_user_can_filter_threads_according_to_a_channel()
        /** пользователь может фильтровать темы в соответствии с катигорией*/
    {
        $channel = create('App\Models\BlogChannel');
        $ThreadInChannel = create('App\Models\BlogThread', ['channel_id' => $channel->id]);
        $ThreadNotInChannel = create('App\Models\BlogThread');
        $this->get('/blog/' . $channel->slug)
            ->assertSee($ThreadInChannel->title)
            ->assertDontSee($ThreadNotInChannel->title);
    }

    function test_filter_threads_by_any_user_name()
    {
        $this->signIn(create('App\Models\User', ['name' => 'root']));
        $threadBy_root = create('App\Models\BlogThread', ['user_id' => auth()->id()]);
        $threadBy_Not_root = create('App\Models\BlogThread');
        $this->get('blog?by=root')
            ->assertSee($threadBy_root->title)
            ->assertDontSee($threadBy_Not_root->title);
    }

    function test_user_filter_threads_by_popularity()
    {
        $threadTwoReplies = create('App\Models\BlogThread');
        create('App\Models\BlogReply', ['thread_id' => $threadTwoReplies->id], 2);
        $threadThreeReplies = create('App\Models\BlogThread');
        create('App\Models\BlogReply', ['thread_id' => $threadThreeReplies->id], 3);
        $threadNOReplies = $this->thread;
        $response = $this->getJson('blog?popular=1')->json();
        $this->assertEquals([3, 2, 0], array_column($response['data'], 'replies_count'));
    }

    function test_a_user_can_filter_threads_by_those_that_are_unanswered()
    {
        $thread = create('App\Models\BlogThread');
        create('App\Models\BlogReply',['thread_id' => $thread->id]);
        $response = $this->getJson('blog?unanswered=1')->json();
        $this->assertCount(1, $response['data']);
    }

    function test_a_user_can_request_all_replies_for_a_given_thread()
        /** пользователь может запросить все ответы на данный поток(темы)*/
    {
        $thread = create('App\Models\BlogThread');
        create('App\Models\BlogReply', ['thread_id' => $thread->id], 2);
        $response = $this->getJson($thread->path() . '/replies')->json();
        $this->assertCount(2, $response['data']);
        $this->assertEquals(2, $response['total']);
    }

}
