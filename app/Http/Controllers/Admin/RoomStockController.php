<?php

namespace App\Http\Controllers\Admin;

use App\RoomStock;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class RoomStockController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Room Stocks')->only(['createForm', 'create']);
        $this->middleware('can:Read Room Stocks')->only(['index', 'read']);
        $this->middleware('can:Update Room Stocks')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Room Stocks'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $room_stocks = RoomStock::query()->with('room', 'item');
            $datatable = datatables($room_stocks)
                ->editColumn('actions', function ($room_stock) {
                    return view('admin.room_stocks.datatable.actions', compact('room_stock'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room', 'data' => 'room.room_name'],
            ['title' => 'Item Category', 'data' => 'item_category.id'],
            ['title' => 'Stock Quantity', 'data' => 'stock_quantity'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'room_stocks_datatable');

        return view('admin.room_stocks.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.room_stocks.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
            "stock_quantity" => "required|integer",
        ]);

        $room_stock = RoomStock::create(request()->all());

        activity('Created Room Stock: ' . $room_stock->id, request()->all(), $room_stock);
        flash(['success', 'Room Stock created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_stocks'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(RoomStock $room_stock)
    {
        return view('admin.room_stocks.read', compact('room_stock'));
    }

    public function updateForm(RoomStock $room_stock)
    {
        return view('admin.room_stocks.update', compact('room_stock'));
    }

    public function update(RoomStock $room_stock)
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
            "stock_quantity" => "required|",
        ]);

        $room_stock->update(request()->all());

        activity('Updated Room Stock: ' . $room_stock->id, request()->all(), $room_stock);
        flash(['success', 'Room Stock updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_stocks'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(RoomStock $room_stock)
    {
        $room_stock->delete();

        activity('Deleted Room Stock: ' . $room_stock->id, $room_stock->toArray());
        $flash = ['success', 'Room Stock deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.room_stocks');
        }
    }
}