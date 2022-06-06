<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_database()
    {
        $this->assertDatabaseHas('users',[
            'name' => 'Denisa',
            'email' => 'xchowaniecova@stuba.sk'
        ]);
    }
}
