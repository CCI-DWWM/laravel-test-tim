<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ProductTest extends TestCase
{
    use RefreshDatabase;
// je test une function/methode
    public function testCreateProduct()
    {
        //je créé un produit
        $product = Product::create(
            [
                'name' => 'Example Product Test',
                'price' => 14,
                'stock' => 4
            ]
        );
        // je stock ce produit dans une var
        // je stock le produit créé dans une var grace a son id
        $createdProduct = Product::find($product->id);
        $id = $product->id;
        // je verifie que le produit ne sois pas nul
        $this->assertNotNull($createdProduct);
        // je verifie chaque cols si elle correspand a ce que j'ai créé
        $this->assertEquals('Example Product Test', $createdProduct->name);
        $this->assertEquals(14, $createdProduct->price);
        $this->assertEquals(4, $createdProduct->stock);

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
        // je stock le produit créé en le cherchant avec son id
        $updateProduct = Product::find($id);
        // je vérifie chaque cols si elle correspand au info modifier
        $this->assertEquals('New name for the test product update', $updateProduct->name);
        $this->assertEquals(10, $updateProduct->price);
        $this->assertEquals(2, $updateProduct->stock);

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
