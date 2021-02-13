<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    function test_guests_can_not_favorite_anything()
        /** гости не могут "лайкать" ничего*/
    {
        $this->withExceptionHandling()->post('reply/1/favorites')->assertRedirect('/login');
    }


    public function test_an_authenticated_user_can_favorite_any_reply()
        /** аутентифицированный пользователь может "лайкать" любой ответ*/
    {
        $this->signIn();
        $reply = create('App\Models\BlogReply');
        $this->post('reply/' . $reply->id . '/favorites');
        $this->assertCount(1, $reply->favorites);

    }

    public function test_an_authenticated_user_can_favorite_a_reply_once()
        /** аутентифицированный пользователь  может "лайкнуть" только 1 раз*/
    {
        $this->signIn();
        $reply = create('App\Models\BlogReply');
        try{
            $this->post('reply/' . $reply->id . '/favorites');
            $this->post('reply/' . $reply->id . '/favorites');
        }catch ( \Exception $e){
            $this->fail("Did not expect to insert the same record set twice");
        }

        $this->assertCount(1, $reply->favorites);
    }

    public function test_an_authenticated_user_can_unfavorite_a_reply()
        /** аутентифицированный пользователь может "лайкать" любой ответ*/
    {
        $this->signIn();
        $reply = create('App\Models\BlogReply');
        $reply->favorite();

        $this->delete('reply/' . $reply->id . '/favorites');
        $this->assertCount(0, $reply->fresh()->favorites);
    }
}
