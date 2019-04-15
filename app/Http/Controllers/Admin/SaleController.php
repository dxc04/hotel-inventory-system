<?php

namespace App\Http\Controllers\Admin;

use App\Sale;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Sales')->only(['createForm', 'create']);
        $this->middleware('can:Read Sales')->only(['index', 'read']);
        $this->middleware('can:Update Sales')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Sales'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $sales = Sale::query()->with('room', 'item');
            $datatable = datatables($sales)
                ->editColumn('actions', function ($sale) {
                    return view('admin.sales.datatable.actions', compact('sale'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room', 'data' => 'room.room_name'],
            ['title' => 'Item Category', 'data' => 'item_category.id'],
            ['title' => 'Quantity', 'data' => 'quantity'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'sales_datatable');

        return view('admin.sales.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.sales.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
            "quantity" => "required|integer",
        ]);

        $sale = Sale::create(request()->all());

        activity('Created Sale: ' . $sale->id, request()->all(), $sale);
        flash(['success', 'Sale created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.sales'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Sale $sale)
    {
        return view('admin.sales.read', compact('sale'));
    }

    public function updateForm(Sale $sale)
    {
        return view('admin.sales.update', compact('sale'));
    }

    public function update(Sale $sale)
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
            "quantity" => "required|",
        ]);

        $sale->update(request()->all());

        activity('Updated Sale: ' . $sale->id, request()->all(), $sale);
        flash(['success', 'Sale updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.sales'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Sale $sale)
    {
        $sale->delete();

        activity('Deleted Sale: ' . $sale->id, $sale->toArray());
        $flash = ['success', 'Sale deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.sales');
        }
    }
}