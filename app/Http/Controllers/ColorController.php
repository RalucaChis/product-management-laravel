<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $colors = auth()->user()->colors();
        return view('colors', compact('colors'));
    }

    public function add()
    {
        return view('views_color/add_color');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $tag = new Color();
        $tag->name = $request->name;
        $tag->hashcode = $request->hashcode;
        $tag->user_id = auth()->user()->id;
        $tag->save();
        return redirect('/colors');
    }

    public function edit(Color $color)
    {
        if (auth()->user()->id == $color->user_id)
        {
            return view('views_color/edit_color', compact('color'));
        }
        else {
            return redirect('/colors');
        }
    }

    public function update(Request $request, Color $color)
    {
        if(isset($_POST['delete'])) {
            $color->delete();
            return redirect('/colors');
        }
        else
        {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $color->name = $request->name;
            $color->hashcode = $request->hashcode;
            $color->save();
            return redirect('/colors');
        }
    }
}
