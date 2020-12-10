<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateThreadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withExceptionHandling();
        $this->signIn();
    }

    /** Неавторизованные пользователи не могут обновлять темы **/
    function testUnauthorizedUsersMayNotUpdateThreads()
    {
        $thread = create('App\Models\Thread', ['user_id' => create('App\Model\User')->id]);
        $this->patch($thread->path(), [])->assertStatus(403);
    }

    /** Тема требует обновления заголовка и тела **/
    function testAThreadRequiresATitleAndBodyToBeUpdated()
    {
        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $this->patch($thread->path(), ['title' => 'Changed'])->assertSessionHasErrors('body');
        $this->patch($thread->path(), ['body' => 'Changed'])->assertSessionHasErrors('title');
    }

    /** Тема может быть обновлена ее создателем **/
    function testAThreadCanBeUpdatedByItsCreator()
    {
        $thread = create('App\Models\Thread', ['user_id' => auth()->id()]);
        $this->patch($thread->path(), ['title' => 'Changed', 'body' => 'Changed body.']);
        $this->assertEquals('Changed', $thread->fresh()->title);
        $this->assertEquals('Changed body.', $thread->fresh()->body);

    }
}
