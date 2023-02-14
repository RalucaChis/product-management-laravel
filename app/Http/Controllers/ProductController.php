<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
//        $products = auth()->user()->products();
        $products = Product::with('tags')->get();
        return view('products', compact('products'));
    }

    public function add()
    {
        return view('views_product/add_product');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpg,jpeg,bmp,png'
            ]);

            $request->file->store('images', 'public');

            $product = new Product();
            $product->name = $request->name;
            $product->image_path = $request->file->hashName();
            $product->article_number = $request->article_number;
            $product->description = $request->description;
            $product->brand_id = $request->brand_selected;
            $product->user_id = auth()->user()->id;
            $product->save();

            $tags = $request->tags_selected;
            foreach ($tags as $tag) {
                $product->tags()->attach($tag);
            }
            $categories = $request->categories_selected;
            foreach ($categories as $category) {
                $product->categories()->attach($category);
            }
            $colors = $request->colors_selected;
            foreach ($colors as $col) {
                $product->colors()->attach($col);
            }
            $options = $request->options_selected;
            foreach ($options as $opt) {
                $product->options()->attach($opt);
            }
        }
        return redirect('/products');
    }

    public function edit(Product $product)
    {
        if (auth()->user()->id == $product->user_id)
        {
            return view('views_product/edit_product', compact('product'));
        }
        else {
            return redirect('/products');
        }
    }

    public function update(Request $request, Product $product)
    {
        if(isset($_POST['delete'])) {
            $product->delete();
            return redirect('/products');
        }
        else
        {
            $this->validate($request, [
                'name' => 'required'
            ]);
            if ($request->hasFile('file')) {

                $request->validate([
                    'image' => 'mimes:jpg,jpeg,bmp,png'
                ]);

                $request->file->store('images', 'public');
                $product->image_path = $request->file->hashName();
            }
            $product->name = $request->name;
            $product->article_number = $request->article_number;
            $product->description = $request->description;
            $product->brand_id = $request->brand_selected;
            $product->user_id = auth()->user()->id;
            $product->save();

            $tags = $request->tags_selected;
            $product->tags()->sync($tags);

            $categories = $request->categories_selected;
            $product->categories()->sync($categories);

            $colors = $request->colors_selected;
            $product->colors()->sync($colors);

            $options = $request->options_selected;
            $product->options()->sync($options);
            return redirect('/products');
        }
    }
}
