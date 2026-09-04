<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLoanRequest;
use App\Models\Employee;
use App\Models\Item;
use App\Models\Loan;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LoansController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        if ($user->hasRole('ADMIN')) {
            $loans = Loan::where('active', 1)->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($user->hasAnyRole(['OT SISTEMA VISOR', 'OT SISTEMA PRESTA'])) {
            $loans = Loan::whereHas('item', function ($query) {
                $query->where('section_id', 1);
            })->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($user->hasAnyRole(['OT PATIO MRO VISOR', 'OT PATIO MRO PRESTA'])) {
            $loans = Loan::whereHas('item', function ($query) {
                $query->where('section_id', 2);
            })->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($user->hasAnyRole(['FISCOMEX SISTEMAS VISOR', 'FISCOMEX SISTEMAS PRESTA'])) {
            $loans = Loan::whereHas('item', function ($query) {
                $query->where('section_id', 3);
            })->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($user->hasAnyRole(['FISCOMEX PATIO VISOR', 'FISCOMEX PATIO PRESTA'])) {
            $loans = Loan::whereHas('item', function ($query) {
                $query->where('section_id', 4);
            })->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $types = Type::where('active', 1)->get();
        $employees = Employee::where('active', 1)->get();
        $aths = User::role('LOANS ADMIN')->get();

        return view('loans.create', compact('types', 'employees', 'aths'));
    }

    public function store(SaveLoanRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        Loan::create($data);

        return redirect()->route('loans.index');

    }

    public function destroy(Loan $loan)
    {
        $loan->update(['active' => 0]);

        return redirect()->route('loans.index');
    }

    public function itemsByType($id, Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('ADMIN')) {
            $items = Item::with('brand')
                ->where('type_id', $id)
                ->available()
                ->get();

        } elseif ($user->hasAnyRole(['OT SISTEMA VISOR', 'OT SISTEMA PRESTA'])) {
            $items = Item::with('brand')
                ->where('type_id', $id)
                ->where('section_id', 1)
                ->available()
                ->get();
        } elseif ($user->hasAnyRole(['OT PATIO MRO VISOR', 'OT PATIO MRO PRESTA'])) {
            $items = Item::with('brand')
                ->where('type_id', $id)
                ->where('section_id', 2)
                ->available()
                ->get();
        } elseif ($user->hasAnyRole(['FISCOMEX SISTEMAS VISOR', 'FISCOMEX SISTEMAS PRESTA'])) {
            $items = Item::with('brand')
                ->where('type_id', $id)
                ->where('section_id', 3)
                ->available()
                ->get();
        } elseif ($user->hasAnyRole(['FISCOMEX PATIO VISOR', 'FISCOMEX PATIO PRESTA'])) {
            $items = Item::with('brand')
                ->where('type_id', $id)
                ->where('section_id', 4)
                ->available()
                ->get();
        }

        return response()->json($items);
    }

    public function loanToSheet($idLoan)
    {
        $loan = Loan::with('employee.department', 'item.brand', 'item.type')->findOrFail($idLoan);

        $rutaArchivo = storage_path('app/templates/formato_prestamo.xlsx');
        $spreadsheet = IOFactory::load($rutaArchivo);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B7', $loan->employee->first_name.' '.$loan->employee->last_name);
        $sheet->setCellValue('B8', $loan->employee->department->name);
        $sheet->setCellValue('B13', $loan->item->type->name);
        $sheet->setCellValue('B14', $loan->item->brand->name);
        $sheet->setCellValue('B15', $loan->item->model);
        $sheet->setCellValue('B16', $loan->item->serial);
        $sheet->setCellValue('B17', $loan->item->notes);
        $sheet->setCellValue('B24', $loan->created_at);
        $sheet->setCellValue('B25', $loan->uuid);
        $sheet->setCellValue('B26', $loan->notes);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="formato.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
