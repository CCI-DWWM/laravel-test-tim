<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;


class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    // Créer un produit via un POST et vérifier qu'il est bien enregistrer en BDD

    public function testCreateProduct()
    {
        // je créé un produit
        $product = Product::create(
            [
                'name' => 'Example Product Test',
                'price' => 14,
                'stock' => 4
            ]
        );
        // je stock le produit créé dans une var grace a son id
        $createdProduct = Product::find($product->id);
        $id = $product->id;
        // je verifie que le produit ne sois pas nul
        $this->assertNotNull($createdProduct);
        // je verifie chaque cols si elle correspand a ce que j'ai créé
        $this->assertEquals('Example Product Test', $createdProduct->name);
        $this->assertEquals(14, $createdProduct->price);
        $this->assertEquals(4, $createdProduct->stock);
        // je vérifie que la page details du produit existe
        $response = $this->get("products/$id");
        $response->assertStatus(200);


    }

    // Listes les produits et vérifier le code 200
    public function testIndex()
    {
        // je verifie le statut de la page
        $response = $this->get('/products');
        $response->assertStatus(200);
    }
    // Vérifier les erreurs de validation (par exemple, si le nom est vide)
    public function testCreateProductValidation()
    {

        //  je créé un produit
        $product = $this->post(route('products.store'), [
            'name' => '',
            'price' => -4,
            'stock' => 'Im not a number'
        ]);
        // je vérifie que la session n'a pas d'erreur
        $product->assertSessionHasNoErrors();


    }
    // Modifier un produit existant et vérifier que la mise à jour est correct
    public function testUpdate()
    {
        // je créé un produit
        $product = Product::create(
            [
                'name' => 'Example Product Test For Update Function',
                'price' => 14,
                'stock' => 4
            ]
        );

        $id = $product->id;
    // j'update le produit
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
        // je vérifie son statut
        $response->assertStatus(302);
    }

    // Supprimer un produit et vérifier qu'il disparait de la BDD

    public function testDestroy()
    {
        // je créé un produit
        $product = Product::create(
            [
                'name' => 'Example Product Test For Destroy Function',
                'price' => 14,
                'stock' => 4
            ]
        );

        $id = $product->id;
        // je supprime le produit
        $response = $this->delete(route('products.destroy', $id));
        // je verifie son statut
        $response->assertStatus(302);
        // je verifie si le produit n'est plus dans la db
        $this->assertDatabaseMissing('products', ['id' => $id]);


    }
}
// php artisan test tests/Feature/ProductControllerTest.php
