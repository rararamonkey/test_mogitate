<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'キウイ',
            'price' => 800,
            'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。',
            'image' => 'products/kiwi.png',
        ]);

        Product::create([
            'name' => 'ストロベリー',
            'price' => 1200,
            'description' => '大人から子供まで大人気のストロベリー。',
            'image' => 'products/strawberry.png',
        ]);

        Product::create([
            'name' => 'オレンジ',
            'price' => 850,
            'description' => '甘さと濃厚な果汁が魅力のオレンジ。',
            'image' => 'products/orange.png',
        ]);

        Product::create([
            'name' => 'スイカ',
            'price' => 700,
            'description' => '甘くてシャリシャリ食感が魅力のスイカ。',
            'image' => 'products/watermelon.png',
        ]);

        Product::create([
            'name' => 'ピーチ',
            'price' => 1000,
            'description' => 'とろける甘さが魅力のピーチ。',
            'image' => 'products/peach.png',
        ]);

        Product::create([
            'name' => 'シャインマスカット',
            'price' => 1400,
            'description' => '上品な甘みのシャインマスカット。',
            'image' => 'products/muscat.png',
        ]);

        Product::create([
            'name' => 'パイナップル',
            'price' => 800,
            'description' => '甘酸っぱいトロピカルな味。',
            'image' => 'products/pineapple.png',
        ]);

        Product::create([
            'name' => 'ブドウ',
            'price' => 1100,
            'description' => '濃厚な甘みの巨峰。',
            'image' => 'products/grapes.png',
        ]);

        Product::create([
            'name' => 'バナナ',
            'price' => 600,
            'description' => '栄養満点のバナナ。',
            'image' => 'products/banana.png',
        ]);

        Product::create([
            'name' => 'メロン',
            'price' => 900,
            'description' => 'ジューシーで上品な甘さのメロン。',
            'image' => 'products/melon.png',
        ]);
    }
}