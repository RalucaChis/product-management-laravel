<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
//        $categories = auth()->user()->categories();
        $categories = Category::with('tags')->get();
        return view('categories', compact('categories'));
    }

    public function add()
    {
        return view('views_category/add_category');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpg,jpeg,bmp,png'
            ]);

            $request->file->store('images', 'public');

            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->image_path = $request->file->hashName();
            $category->user_id = auth()->user()->id;
            $category->save();

//            $tags = Tag::where('id', 7)->first();
            $tags = $request->tags_selected;
            foreach ($tags as $tag) {
                $category->tags()->attach($tag);
            }
        }

        return redirect('/categories');
    }

    public function edit(Category $category)
    {
        if (auth()->user()->id == $category->user_id) {
            return view('views_category/edit_category', compact('category'));
        } else {
            return redirect('/categories');
        }
    }

    public function update(Request $request, Category $category)
    {
        if (isset($_POST['delete'])) {
            $category->tags()->detach();
            $category->delete();
            return redirect('/categories');
        } else {
            $this->validate($request, [
                'name' => 'required',
            ]);
            if ($request->hasFile('file')) {

                $request->validate([
                    'image' => 'mimes:jpg,jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);

                $request->file->store('images', 'public');
                $category->image_path = $request->file->hashName();
            }
                $category->name = $request->name;
                $category->description = $request->description;
                $category->user_id = auth()->user()->id;
                $category->save();

                $tags = $request->tags_selected;
                $category->tags()->sync($tags);

            return redirect('/categories');
        }
    }
}
