<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLoanRequest;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Loan;
use App\Models\Type;

class LoansController extends Controller
{
    public function index()
    {
        $loans = Loan::where('active', 1)->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $types = Type::where('active', 1)->get();
        $employees = Employee::where('active', 1)->get();

        return view('loans.create', compact('types', 'employees'));

    }

    public function store(SaveLoanRequest $request)
    {
        $data = $request->validated();
        Loan::create($data);

        return redirect()->route('loans.index');

    }

    public function destroy(Loan $loan)
    {
        $loan->update(['active' => 0]);

        return redirect()->route('loans.index');
    }

    public function itemsByType($id)
    {
        $items = Item::with('brand')
            ->where('type_id', $id)
            ->available()
            ->get();

        return response()->json($items);
    }
}
