<?php

namespace Database\Seeders;

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
                'sku' => 'GAM001',
                'name' => 'RGB Gaming Keyboard',
                'description' => 'Mechanical gaming keyboard with RGB lighting and responsive keys.',
                'price' => 79.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Keyboard',
                'stock' => 25,
            ],
            [
                'sku' => 'GAM002',
                'name' => 'Wireless Gaming Mouse',
                'description' => 'Lightweight wireless gaming mouse with adjustable DPI.',
                'price' => 49.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Mouse',
                'stock' => 40,
            ],
            [
                'sku' => 'GAM003',
                'name' => 'Gaming Headset',
                'description' => 'Comfortable gaming headset with surround sound and microphone.',
                'price' => 89.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Headset',
                'stock' => 20,
            ],
            [
                'sku' => 'GAM004',
                'name' => 'Pro Gaming Controller',
                'description' => 'Ergonomic controller with customizable buttons and triggers.',
                'price' => 69.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Controller',
                'stock' => 30,
            ],
            [
                'sku' => 'GAM005',
                'name' => '27-inch Gaming Monitor',
                'description' => 'High-refresh-rate gaming monitor with a sharp 1440p display.',
                'price' => 249.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Monitor',
                'stock' => 15,
            ],
            [
                'sku' => 'GAM006',
                'name' => 'XL Gaming Mouse Pad',
                'description' => 'Large non-slip mouse pad with a smooth gaming surface.',
                'price' => 24.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Mouse+Pad',
                'stock' => 50,
            ],
            [
                'sku' => 'GAM007',
                'name' => 'USB Gaming Microphone',
                'description' => 'USB microphone for streaming, gaming, and voice chat.',
                'price' => 59.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Microphone',
                'stock' => 18,
            ],
            [
                'sku' => 'GAM008',
                'name' => 'Gaming Webcam',
                'description' => '1080p webcam designed for streaming and video calls.',
                'price' => 74.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Webcam',
                'stock' => 22,
            ],
            [
                'sku' => 'GAM009',
                'name' => 'RGB Gaming Speakers',
                'description' => 'Stereo gaming speakers with customizable RGB lighting.',
                'price' => 99.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Gaming+Speakers',
                'stock' => 12,
            ],
            [
                'sku' => 'GAM010',
                'name' => 'Gaming Laptop Cooling Pad',
                'description' => 'Adjustable laptop cooling pad with quiet built-in fans.',
                'price' => 39.99,
                'image_url' => 'https://placehold.co/400x300/172554/ffffff?text=Cooling+Pad',
                'stock' => 35,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['sku' => $product['sku']], $product);
        }
    }
}
