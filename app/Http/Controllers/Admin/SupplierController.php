<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Suppliers')->only(['createForm', 'create']);
        $this->middleware('can:Read Suppliers')->only(['index', 'read']);
        $this->middleware('can:Update Suppliers')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Suppliers'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $suppliers = Supplier::query();
            $datatable = datatables($suppliers)
                ->editColumn('actions', function ($supplier) {
                    return view('admin.suppliers.datatable.actions', compact('supplier'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Supplier Name', 'data' => 'supplier_name'],
            ['title' => 'Contact Number', 'data' => 'contact_number'],
            ['title' => 'Address', 'data' => 'address'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'suppliers_datatable');

        return view('admin.suppliers.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.suppliers.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "supplier_name" => "required|unique:suppliers",
        ]);

        $supplier = Supplier::create(request()->all());

        activity('Created Supplier: ' . $supplier->supplier_name, request()->all(), $supplier);
        flash(['success', 'Supplier created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.suppliers'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Supplier $supplier)
    {
        return view('admin.suppliers.read', compact('supplier'));
    }

    public function updateForm(Supplier $supplier)
    {
        return view('admin.suppliers.update', compact('supplier'));
    }

    public function update(Supplier $supplier)
    {
        $this->validate(request(), [
            "supplier_name" => "required|unique:suppliers,supplier_name,{$supplier->id}",
        ]);

        $supplier->update(request()->all());

        activity('Updated Supplier: ' . $supplier->supplier_name, request()->all(), $supplier);
        flash(['success', 'Supplier updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.suppliers'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Supplier $supplier)
    {
        $supplier->delete();

        activity('Deleted Supplier: ' . $supplier->supplier_name, $supplier->toArray());
        $flash = ['success', 'Supplier deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.suppliers');
        }
    }
}