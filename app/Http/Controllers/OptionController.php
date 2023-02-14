<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index()
    {
        $options = auth()->user()->options();
        return view('options', compact('options'));
    }

    public function add()
    {
        return view('views_option/add_option');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $option = new Option();
        $option->name = $request->name;
        $option->user_id = auth()->user()->id;
        $option->save();
        return redirect('/options');
    }

    public function edit(Option $option)
    {
        if (auth()->user()->id == $option->user_id)
        {
            return view('views_option/edit_option', compact('option'));
        }
        else {
            return redirect('/options');
        }
    }

    public function update(Request $request, Option $option)
    {
        if(isset($_POST['delete'])) {
            $option->delete();
            return redirect('/options');
        }
        else
        {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $option->name = $request->name;
            $option->save();
            return redirect('/options');
        }
    }
}
