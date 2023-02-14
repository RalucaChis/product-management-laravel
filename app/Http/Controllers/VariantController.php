<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $tags = auth()->user()->tags();
        return view('tags', compact('tags'));
    }

    public function add()
    {
        return view('views_tag/add_tag');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->user_id = auth()->user()->id;
        $tag->save();
        return redirect('/tags');
    }

    public function edit(Tag $tag)
    {
        if (auth()->user()->id == $tag->user_id)
        {
            return view('views_tag/edit_tag', compact('tag'));
        }
        else {
            return redirect('/tags');
        }
    }

    public function update(Request $request, Tag $tag)
    {
        if(isset($_POST['delete'])) {
            $tag->delete();
            return redirect('/tags');
        }
        else
        {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $tag->name = $request->name;
            $tag->save();
            return redirect('/tags');
        }
    }
}
