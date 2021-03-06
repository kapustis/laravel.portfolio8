<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
	use CreatesApplication;

	protected function setUp() : void
	{
		parent::setUp();
		DB::statement('PRAGMA foreign_keys=on;');
		$this->withoutExceptionHandling();
	}

	protected function signIn($user = null)
	{
//		$user = $user ?: factory('App\Models\User')->create();
		$user = $user ?: User::factory()->create();
		$this->actingAs($user);
		return $this;
	}
}
