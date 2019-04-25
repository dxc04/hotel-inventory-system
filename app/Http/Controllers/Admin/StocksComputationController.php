<?php

namespace App\Http\Controllers\Admin;

use App\StocksComputation;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class StocksComputationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Stocks Computations')->only(['createForm', 'create']);
        $this->middleware('can:Read Stocks Computations')->only(['index', 'read']);
        $this->middleware('can:Update Stocks Computations')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Stocks Computations'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $stocks_computations = StocksComputation::query()->with('room', 'item');
            $datatable = datatables($stocks_computations)
                ->editColumn('actions', function ($stocks_computation) {
                    return view('admin.stocks_computations.datatable.actions', compact('stocks_computation'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room', 'data' => 'room.room_name'],
            ['title' => 'Item Category', 'data' => 'item_category.id'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'stocks_computations_datatable');

        return view('admin.stocks_computations.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.stocks_computations.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
        ]);

        $stocks_computation = StocksComputation::create(request()->all());

        activity('Created Stocks Computation: ' . $stocks_computation->id, request()->all(), $stocks_computation);
        flash(['success', 'Stocks Computation created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.stocks_computations'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(StocksComputation $stocks_computation)
    {
        return view('admin.stocks_computations.read', compact('stocks_computation'));
    }

    public function updateForm(StocksComputation $stocks_computation)
    {
        return view('admin.stocks_computations.update', compact('stocks_computation'));
    }

    public function update(StocksComputation $stocks_computation)
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
        ]);

        $stocks_computation->update(request()->all());

        activity('Updated Stocks Computation: ' . $stocks_computation->id, request()->all(), $stocks_computation);
        flash(['success', 'Stocks Computation updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.stocks_computations'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(StocksComputation $stocks_computation)
    {
        $stocks_computation->delete();

        activity('Deleted Stocks Computation: ' . $stocks_computation->id, $stocks_computation->toArray());
        $flash = ['success', 'Stocks Computation deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.stocks_computations');
        }
    }
}