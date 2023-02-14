<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = auth()->user()->brands();
        return view('brands', compact('brands'));
    }

    public function add()
    {
        return view('views_brand/add_brand');
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

            $brand = new Brand();
            $brand->name = $request->name;
            $brand->image_path = $request->file->hashName();
            $brand->user_id = auth()->user()->id;
            $brand->save();
        }
        return redirect('/brands');
    }

    public function edit(Brand $brand)
    {
        if (auth()->user()->id == $brand->user_id)
        {
            return view('views_brand/edit_brand', compact('brand'));
        }
        else {
            return redirect('/brands');
        }
    }

    public function update(Request $request, Brand $brand)
    {
        if(isset($_POST['delete'])) {
            $brand->delete();
            return redirect('/brands');
        }
        else
        {
            $this->validate($request, [
                'name' => 'required'
            ]);
            if ($request->hasFile('file')) {

                $request->validate([
                    'image' => 'mimes:jpg,jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);

                $request->file->store('images', 'public');

                $brand->name = $request->name;
                $brand->image_path = $request->file->hashName();
                $brand->save();
            } else {
                $brand->name = $request->name;
                $brand->save();
            }
            return redirect('/brands');
        }
    }
}
