<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Le dernier iPhone avec des fonctionnalités avancées et un design premium.',
                'price' => 1199.99,
                'stock' => 25,
            ],
            [
                'name' => 'MacBook Air M2',
                'description' => 'Ordinateur portable ultra-léger avec puce M2 pour des performances exceptionnelles.',
                'price' => 1499.99,
                'stock' => 15,
            ],
            [
                'name' => 'AirPods Pro',
                'description' => 'Écouteurs sans fil avec réduction de bruit active et audio spatial.',
                'price' => 249.99,
                'stock' => 50,
            ],
            [
                'name' => 'iPad Air',
                'description' => 'Tablette polyvalente parfaite pour la créativité et la productivité.',
                'price' => 699.99,
                'stock' => 30,
            ],
            [
                'name' => 'Apple Watch Series 9',
                'description' => 'Montre connectée avec suivi de santé avancé et notifications intelligentes.',
                'price' => 399.99,
                'stock' => 20,
            ],
            [
                'name' => 'iMac 24"',
                'description' => 'Ordinateur tout-en-un avec écran Retina 4.5K et puce M1.',
                'price' => 1299.99,
                'stock' => 8,
            ],
            [
                'name' => 'Magic Keyboard',
                'description' => 'Clavier sans fil avec design minimaliste et touches scissor.',
                'price' => 99.99,
                'stock' => 45,
            ],
            [
                'name' => 'HomePod mini',
                'description' => 'Haut-parleur intelligent avec assistant vocal Siri intégré.',
                'price' => 99.99,
                'stock' => 35,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 