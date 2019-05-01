<?php

namespace App\Http\Controllers\Admin;

use App\ItemStock;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class ItemStockController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Item Stocks')->only(['createForm', 'create']);
        $this->middleware('can:Read Item Stocks')->only(['index', 'read']);
        $this->middleware('can:Update Item Stocks')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Item Stocks'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $item_stocks = ItemStock::query()->with('item');
            $datatable = datatables($item_stocks)
                ->editColumn('actions', function ($item_stock) {
                    return view('admin.item_stocks.datatable.actions', compact('item_stock'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Item', 'data' => 'item.id'],
            ['title' => 'Stock Quantity', 'data' => 'stock_quantity'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'item_stocks_datatable');

        return view('admin.item_stocks.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.item_stocks.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "item_id" => "required|exists:items,id",
            "stock_quantity" => "required|integer",
        ]);

        $item_stock = ItemStock::create(request()->all());

        activity('Created Item Stock: ' . $item_stock->id, request()->all(), $item_stock);
        flash(['success', 'Item Stock created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.item_stocks'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(ItemStock $item_stock)
    {
        return view('admin.item_stocks.read', compact('item_stock'));
    }

    public function updateForm(ItemStock $item_stock)
    {
        return view('admin.item_stocks.update', compact('item_stock'));
    }

    public function update(ItemStock $item_stock)
    {
        $this->validate(request(), [
            "item_id" => "required|exists:items,id",
            "stock_quantity" => "required|",
        ]);

        $item_stock->update(request()->all());

        activity('Updated Item Stock: ' . $item_stock->id, request()->all(), $item_stock);
        flash(['success', 'Item Stock updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.item_stocks'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(ItemStock $item_stock)
    {
        $item_stock->delete();

        activity('Deleted Item Stock: ' . $item_stock->id, $item_stock->toArray());
        $flash = ['success', 'Item Stock deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.item_stocks');
        }
    }
}