<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;
use Illuminate\Support\Facades\App;

class MakerController extends Controller
{
    public function index()
    {
        $makers = Maker::all();
        return view('admin.makers.index',[
            'makers' => $makers,
        ]);
    }
    public function create()
    {
        return view('admin.makers.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:makers,name',
        ]);

        Maker::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.makers')->with('success', __('Se agrego el fabricante correctamente.'));
    }
}
