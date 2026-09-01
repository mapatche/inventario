<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveItemRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Section;
use App\Models\Type;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        if ($user->hasRole('admin')) {
            $items = Item::where('active', 1)->paginate(10);
        } elseif ($user->hasAnyRole(['visor_oficina', 'presta_oficina'])) {
            $items = Item::where('active', 1)->where('section_id', 1)->paginate(10);
        } else {
            $items = Item::where('active', 1)->where('section_id', 2)->paginate(10);
        }

        return view('items.index', compact('items'));
    }

    public function create()
    {
        $types = Type::where('active', 1)->get();
        $brands = Brand::where('active', 1)->get();
        $sections = Section::all();

        return view('items.create', compact('types', 'brands', 'sections'));
    }

    public function store(SaveItemRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        if ($request->hasFile('bill_location')) {
            $data['bill_location'] = $request->file('bill_location')->store('items', 'public');
        }

        if ($user->hasRole('presta_oficina')) {
            $data['section_id'] = 1;
        } elseif ($user->hasRole('presta_patio')) {
            $data['section_id'] = 2;
        }
        Item::create($data);

        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        $types = Type::where('active', 1)->get();
        $brands = Brand::where('active', 1)->get();
        $sections = Section::all();

        return view('items.edit', compact('item', 'types', 'brands', 'sections'));
    }

    public function update(SaveItemRequest $request, Item $item)
    {
        $data = $request->validated();
        if ($request->hasFile('bill_location')) {
            $data['bill_location'] = $request->file('bill_location')->store('items', 'public');
        } else {
            unset($data['bill_location']);
        }

        $item->update($data);

        return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        $item->update(['active' => 0]);

        return redirect()->route('items.index');
    }
}
