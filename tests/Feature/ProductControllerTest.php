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
        $response = $this->post(route('products.store'), [
            'name' => 'Example Product Test',
            'description' => 'Tatata',
            'price' => 14,
            'stock' => 4
        ]);


        $response->assertRedirect('/products');
        $response->assertSessionHas('success');

        $response->assertStatus(302);

        $page = $this->followRedirects($response);
        // je verifie si le message de sucess est le meme que dans le controller
        $page->assertSee('Produit ajouté avec succès !');

        $this->assertDatabaseHas('products', [
            'name' => 'Example Product Test',
            'description' => 'Tatata',
            'price' => 14,
            'stock' => 4
        ]);

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
            'descripton' => 4,
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
                'name' => 'New name for the test product update',
                'price' => 10,
                'stock' => 2
            ]
        );


        $id = $product->id;
    // j'update le produit
        $response = $this->put(route('products.update', $id), [
            'name'  => 'New name for the test product update',
            'price' => 10,
            'stock' => 2
        ]);


        $page = $this->followRedirects($response);
        // je verifie si le message de sucess est le meme que dans le controller
        $page->assertSeeText('Produit mis à jour avec succès !');

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
        $page = $this->followRedirects($response);
        // je verifie si le message de sucess est le meme que dans le controller
        $page->assertSeeText('Produit supprimé avec succès !');
        // je verifie si le produit n'est plus dans la db
        $this->assertDatabaseMissing('products', ['id' => $id]);


    }
}
// php artisan test tests/Feature/ProductControllerTest.php
