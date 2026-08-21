<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTypeRequest;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $itemtypes = Type::where('active', 1)->paginate(10);
        return view('itemtypes.index', compact('itemtypes'));
    }

    public function create()
    {
        return view('itemtypes.create');
    }

    public function store(SaveTypeRequest $request)
    {
        $data = $request->validated();
        Type::create($data);
        return redirect()->route('itemtypes.index');
    }

    public function edit(Type $itemtype)
    {
        return view('itemtypes.edit', compact('itemtype'));
    }

    public function update(SaveTypeRequest $request, Type $itemtype)
    {
        $data = $request->validated();
        $itemtype->update($data);
        $itemtypes = Type::where('active', 1)->paginate(10);
        return view('itemtypes.index', compact('itemtypes'));
    }

    public function destroy(Type $itemtype)
    {
        $itemtype->update(['active' => 0]);
        $itemtypes = Type::where('active', 1)->paginate(10);
        return view('itemtypes.index', compact('itemtypes'));
    }
}
