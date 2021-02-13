<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;


    public function test_a_user_has_a_profile()
    {
        $user = create('App\Models\User');
        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    public function test_display_all_threads_created_by_the_associated_user(){
        $this->signIn();

        $threads = create('App\Models\BlogThread',['user_id' => auth()->id()]);
//        dd($threads->body);
        $this->get("/profiles/".auth()->user()->name)
            ->assertSee($threads->title)
            ->assertSee($threads->body);
    }
}
