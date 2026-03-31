<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 一覧
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->sort === 'asc') {
            $products = $products->orderBy('price');
        } elseif ($request->sort === 'desc') {
            $products = $products->orderByDesc('price');
        }

        if (!empty($request->keyword)) {
            $products = $products->where('name', 'like', '%' . $request->keyword . '%');
        }
        
        $products = $products->paginate(6);

        return view('products.index', compact('products'));
    }

    // 詳細
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::all();

        return view('products.detail', compact('product', 'seasons'));
    }

    // ⭐ 登録画面
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    // ⭐ 登録処理
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        $product->seasons()->attach($validated['season_ids']);

        return redirect()->route('products.index');
    }

    // 更新
    public function update(ProductRequest $request, $id)
    {
        $validated = $request->validated();

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
        ]);

        $product->seasons()->sync($validated['season_ids']);

        return redirect()->route('products.index');
    }

    // 削除
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}