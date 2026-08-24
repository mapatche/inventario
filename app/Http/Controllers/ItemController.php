<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveItemRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Type;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::where('active', 1)->paginate(10);

        return view('items.index', compact('items'));
    }

    public function create()
    {
        $types = Type::where('active', 1)->get();
        $brands = Brand::where('active', 1)->get();

        return view('items.create', compact('types', 'brands'));
    }

    public function store(SaveItemRequest $request)
    {
        $data = $request->validated();
        Item::create($data);

        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        $types = Type::where('active', 1)->get();
        $brands = Brand::where('active', 1)->get();

        return view('items.edit', compact('item', 'types', 'brands'));
    }

    public function update(SaveItemRequest $request, Item $item)
    {
        $data = $request->validated();
        $item->update($data);

        return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        $item->update(['active' => 0]);

        return redirect()->route('items.index');
    }
}
