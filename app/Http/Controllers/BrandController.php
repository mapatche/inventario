<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('active', 1)->paginate(10);
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(SaveBrandRequest $request)
    {
        $data = $request->validated();
        Brand::create($data);
        return redirect()->route('brands.index');
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(SaveBrandRequest $request, Brand $brand)
    {
        $data = $request->validated();
        $brand->update($data);
        return redirect()->route('brands.index');
    }

    public function destroy(Brand $brand)
    {
        $brand->update(['active' => 0]);
        return redirect()->route('brands.index');
    }
}
