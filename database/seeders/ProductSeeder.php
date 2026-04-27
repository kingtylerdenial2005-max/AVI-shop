<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Premium Cotton Printed Nighty',
                'slug' => 'premium-cotton-printed-nighty',
                'description' => 'Ultra-soft 100% pure cotton nighty with vibrant floral prints. Designed for maximum comfort and breathability.',
                'price' => 899.00,
                'discount_price' => 599.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1585435421671-0c1676763d09?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.8,
                'is_featured' => true,
            ],
            [
                'name' => 'Classic Satin Silk Nighty',
                'slug' => 'classic-satin-silk-nighty',
                'description' => 'Luxurious satin silk nighty with elegant lace detailing. Perfect for a premium sleepwear experience.',
                'price' => 1299.00,
                'discount_price' => 849.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1582533075177-3bc012826a73?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.9,
                'is_featured' => true,
            ],
            [
                'name' => 'Embroidered Kaftan Nighty',
                'slug' => 'embroidered-kaftan-nighty',
                'description' => 'Stylish kaftan-style nighty with delicate hand embroidery. Loose fit for ultimate relaxation.',
                'price' => 999.00,
                'discount_price' => 699.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1612459284970-e8f027596582?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.7,
                'is_featured' => true,
            ],
            [
                'name' => 'Full Length Rayon Nighty',
                'slug' => 'full-length-rayon-nighty',
                'description' => 'Premium rayon fabric nighty that feels like a second skin. Elegant patterns and long-lasting colors.',
                'price' => 799.00,
                'discount_price' => 499.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1574015974293-817f0efebb1b?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.5,
                'is_featured' => false,
            ],
            [
                'name' => 'Cotton Feeding Nighty - Blue',
                'slug' => 'cotton-feeding-nighty-blue',
                'description' => 'Comfortable 100% cotton feeding nighty with high-quality zips. Designed for convenience and style.',
                'price' => 950.00,
                'discount_price' => 699.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1566206091558-7f218b696731?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.6,
                'is_featured' => false,
            ],
            [
                'name' => 'Luxury Velvet Winter Nighty',
                'slug' => 'luxury-velvet-winter-nighty',
                'description' => 'Stay warm and cozy with our premium velvet nighty. Ultra-soft texture and elegant embroidery.',
                'price' => 1800.00,
                'discount_price' => 1299.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.9,
                'is_featured' => true,
            ],
            [
                'name' => 'Lycra Stretchable Nighty',
                'slug' => 'lycra-stretchable-nighty',
                'description' => 'Perfect fit lycra nighty with great stretch and comfort. Ideal for daily wear.',
                'price' => 699.00,
                'discount_price' => 450.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1612459284670-e4d8bc8ef64d?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.4,
                'is_featured' => false,
            ],
            [
                'name' => 'Premium Ajrakh Print Nighty',
                'slug' => 'premium-ajrakh-print-nighty',
                'description' => 'Authentic Ajrakh hand block printed nighty in pure cotton. A touch of tradition in your sleepwear.',
                'price' => 1100.00,
                'discount_price' => 799.00,
                'category' => 'Nighties',
                'image' => 'https://images.unsplash.com/photo-1590736910118-20ec9471f008?auto=format&fit=crop&q=80&w=600',
                'rating' => 4.7,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
