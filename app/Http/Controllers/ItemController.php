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
        if ($user->hasRole('ADMIN')) {
            $items = Item::where('active', 1)->paginate(10);
        } elseif ($user->hasAnyRole(['OT SISTEMA VISOR', 'OT SISTEMA PRESTA'])) {
            $items = Item::where('active', 1)->where('section_id', 1)->paginate(10);
        } elseif ($user->hasAnyRole(['OT PATIO MRO VISOR', 'OT PATIO MRO PRESTA'])) {
            $items = Item::where('active', 1)->where('section_id', 2)->paginate(10);
        } elseif ($user->hasAnyRole(['FISCOMEX SISTEMAS VISOR', 'FISCOMEX SISTEMAS PRESTA'])) {
            $items = Item::where('active', 1)->where('section_id', 3)->paginate(10);
        } elseif ($user->hasAnyRole(['FISCOMEX PATIO VISOR', 'FISCOMEX PATIO PRESTA'])) {
            $items = Item::where('active', 1)->where('section_id', 4)->paginate(10);
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

        if ($user->hasRole('OT SISTEMA PRESTA')) {
            $data['section_id'] = 1;
        } elseif ($user->hasRole('OT PATIO MRO PRESTA')) {
            $data['section_id'] = 2;
        } elseif ($user->hasRole('FISCOMEX SISTEMAS PRESTA')) {
            $data['section_id'] = 3;
        } elseif ($user->hasRole('FISCOMEX PATIO PRESTA')) {
            $data['section_id'] = 4;
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
