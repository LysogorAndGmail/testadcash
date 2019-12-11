<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UserTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected $user;

    protected function setUp(): void
    {
        parent::setup();

        $this->user = factory(User::class)->create();
    }

    public function testIndexUsers()
    {
        $response = $this->get("/users");
        $response->assertOk()
                 ->assertSee('full_name');
    }

    public function testShowUser()
    {
        $response = $this->get("/user/{$this->user->id}/show");
        $response->assertOk()
                 ->assertSee('full_name');
    }

    public function testStoreUser()
    {
        $response = $this->post("/user/store", [
            'full_name'        => $this->user->full_name,
        ]);
        $response->assertOk();
    }

    public function testUpdateUser()
    {
        $response = $this->put("/user/{$this->user->id}/update", [
            'full_name'        => $this->user->full_name,
        ]);
        $response->assertOk();
    }

    public function testDestroyUser()
    {
        $response = $this->delete("/user/{$this->user->id}/destroy");
        $response->assertOk();
    }

}
