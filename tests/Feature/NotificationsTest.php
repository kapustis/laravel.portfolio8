<?php

namespace Tests\Feature;

use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->signIn();
    }

    /** уведомление готовится, когда подписанный поток получает новый ответ от текущего пользователя **/
    function test_a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_by_the_current_user()

    {
        $thread = create('App\Models\Thread')->subscribe();
        $this->assertCount(0, auth()->user()->notifications);

        // Then, each time a new reply is left... // Затем каждый раз, когда остается новый ответ ...
        $thread->addReply(['user_id' => auth()->id(), 'body' => 'Text from user']);
        $this->assertCount(0, auth()->user()->fresh()->notifications);

        $thread->addReply(['user_id' => create('App\Models\User')->id, 'body' => 'Text from user']);
        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** пользователь может получать свои непрочитанные уведомления */
    function test_a_user_can_fetch_their_unread_notifications()
    {
//        create(DatabaseNotification::class);
//        $this->assertCount(1, $this->getJson("/profiles/" . auth()->user()->name . "/notifications")->json());
	    $thread = create('App\Models\Thread')->subscribe();

	    $thread->addReply([
		    'user_id' => create('App\Models\User')->id,
		    'body' => 'Some reply here'
	    ]);

	    $user = auth()->user();

	    $response =  $this->getJson("/profiles/" . $user->name . "/notifications")->json();

	    $this->assertCount(1,$response);


    }

    /** пользователь может отметить уведомление как прочитанное */
//    function test_a_user_can_mark_a_notification_as_read()
//    {
//        DatabaseNotification::factory()->create();
//        tap(auth()->user(), function ($user) {
//            $this->assertCount(1, $user->unreadNotifications);
//            $this->delete("/profiles/{$user->name}/notifications/" . $user->unreadNotifications->first()->id);
//            $this->assertCount(0, $user->fresh()->unreadNotifications);
//        });
//    }
}
