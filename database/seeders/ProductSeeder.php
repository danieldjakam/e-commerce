<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer toutes les catégories et brands pour les relations
        $categories = Category::pluck('id')->toArray();
        $brands = Brand::pluck('id')->toArray();

        // Générer 20 produits fictifs
        for ($i = 1; $i <= 20; $i++) {
            $title = "Produit $i";

            Product::create([
                'title' => $title,
                'slug' => Str::slug($title . '-' . time() . '-' . $i),
                'summary' => "Résumé du produit $i",
                'description' => "Description détaillée du produit $i. Lorem ipsum dolor sit amet.",
                'photo' => "products/product$i.jpg", // tu peux remplacer par des images réelles
                'stock' => rand(1, 100),
                'size' => ['S', 'M', 'L', 'XL'][array_rand(['S','M','L','XL'])],
                'condition' => ['default', 'new', 'hot'][array_rand(['default','new','hot'])],
                'status' => ['active', 'inactive'][array_rand(['active','inactive'])],
                'price' => rand(1000, 5000),
                'discount' => rand(0, 500),
                'is_featured' => rand(0, 1),
                'cat_id' => $categories[array_rand($categories)],
                'child_cat_id' => $categories[array_rand($categories)],
                'brand_id' => $brands[array_rand($brands)],
            ]);
        }
    }
}
