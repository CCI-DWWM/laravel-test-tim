<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ProductTest extends TestCase
{
    use RefreshDatabase;
// je test la une function/methode
    public function testCreateProduct()
    {
        $product = Product::create(
            [
                'name' => 'Example Product Test',
                'price' => 14,
                'stock' => 4
            ]
        );
        $createdProduct = Product::find($product->id);
        $this->assertNotNull($createdProduct);

    }


    public function testUpdate()
    {
        $product = Product::create(
            [
                'name' => 'Example Product Test For Update Function',
                'price' => 14,
                'stock' => 4
            ]
        );

        $id = $product->id;

        $response = $this->put(route('products.update', $id), [
            'name'  => 'New name for the test product update',
            'price' => 10,
            'stock' => 2
        ]);

        $response->assertStatus(302);
    }

    public function testDestroy()
    {
        $product = Product::create(
            [
                'name' => 'Example Product Test For Destroy Function',
                'price' => 14,
                'stock' => 4
            ]
        );

        $id = $product->id;
        $response = $this->delete(route('products.destroy', $id));
        $response->assertStatus(302);


    }

}
