<?php

namespace Tests\Feature;

use App\Product;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Carbon\Carbon;


class ProductTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected $product;

    protected function setUp(): void
    {
        parent::setup();

        $this->product = factory(Product::class)->create();
    }

    public function testIndexProduct()
    {
        $response = $this->get("/products");
        $response->assertOk()
                 ->assertSee('name')
                 ->assertSee('price');
    }

    public function testShowProduct()
    {
        $response = $this->get("/product/{$this->product->id}/show");
        $response->assertOk()
                 ->assertSee('name')
                 ->assertSee('price');
    }


    public function testStoreProduct()
    {
        $response = $this->post("/product/store", [
            'name' => $this->product->name,
            'price'      => $this->product->price
        ]);

        $response->assertOk();
    }

    public function testUpdateProduct()
    {
        $response = $this->put("/product/{$this->product->id}/update", [
            'name' => $this->product->name,
            'price'      => $this->product->price
        ]);
        $response->assertOk();
    }

    public function testDestroyProduct()
    {
        $response = $this->delete("/product/{$this->product->id}/destroy");
        $response->assertOk();
    }
}
