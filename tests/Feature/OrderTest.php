<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Product;
use App\User;
use App\Order;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected $product;
    protected $user;
    protected $order;


    protected function setUp(): void
    {
        parent::setup();

        $this->product = factory(Product::class)->create();
        $this->user = factory(User::class)->create();
        $this->order = factory(Order::class)->create();

    }

    public function testIndexOrder()
    {
        $filter_type = 1; //all orders
        $response = $this->get("/orders/" . $filter_type);
        $response->assertOk()
            ->assertSee('user_id')
            ->assertSee('product_id')
            ->assertSee('product_price')
            ->assertSee('product_count')
            ->assertSee('order_sum');
    }

    public function testSearchOrder()
    {
        $filter_type = 1; //all orders

        $search = $this->product->name;

        $response = $this->get("/orders/" . $filter_type . "/" . $search);
        $response->assertOk()
            ->assertSee('user_id')
            ->assertSee('product_id')
            ->assertSee('product_price')
            ->assertSee('product_count')
            ->assertSee('order_sum');
    }

    public function testShowOrder()
    {
        $response = $this->get("/order/{$this->order->id}/show");
        $response->assertOk()
            ->assertSee('user_id')
            ->assertSee('product_id')
            ->assertSee('product_price')
            ->assertSee('product_count')
            ->assertSee('order_sum');
    }

    public function testStoreOrder()
    {

        $response = $this->post("/order/store", [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'product_price' => $this->product->price,
            'product_count' => 1,
            'order_sum' => $this->product->price
        ]);

        $response->assertOk();
    }

    public function testUpdateOrder()
    {
        $response = $this->put("/order/{$this->order->id}/update", [
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'product_price' => $this->product->price,
            'product_count' => 1,
            'order_sum' => $this->product->price
        ]);
        $response->assertOk();
    }

    public function testDestroyOrder()
    {
        $response = $this->delete("/order/{$this->order->id}/destroy");
        $response->assertOk();
    }

}
