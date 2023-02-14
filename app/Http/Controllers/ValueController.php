<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Value;
class ValueController extends Controller
{
    public function index()
    {
        $values = auth()->user()->values();
        return view('values', compact('values'));
    }

    public function add()
    {
        return view('views_value/add_value');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $value = new Value();
        $value->name = $request->name;
        $value->option_id = $request->option_selected;
        $value->user_id = auth()->user()->id;
        $value->save();
        return redirect('/values');
    }

    public function edit(Value $value)
    {
        if (auth()->user()->id == $value->user_id)
        {
            return view('views_value/edit_value', compact('value'));
        }
        else {
            return redirect('/values');
        }
    }

    public function update(Request $request, Value $value)
    {
        if(isset($_POST['delete'])) {
            $value->delete();
            return redirect('/values');
        }
        else
        {
            $this->validate($request, [
                'name' => 'required'
            ]);
            $value->name = $request->name;
            $value->option_id = $request->option_selected;
            $value->save();
            return redirect('/values');
        }
    }
}
