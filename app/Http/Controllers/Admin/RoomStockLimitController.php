<?php

namespace App\Http\Controllers\Admin;

use App\RoomStockLimit;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class RoomStockLimitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Room Stock Limits')->only(['createForm', 'create']);
        $this->middleware('can:Read Room Stock Limits')->only(['index', 'read']);
        $this->middleware('can:Update Room Stock Limits')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Room Stock Limits'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $room_stock_limits = RoomStockLimit::query()->with('room', 'item');
            $datatable = datatables($room_stock_limits)
                ->editColumn('actions', function ($room_stock_limit) {
                    return view('admin.room_stock_limits.datatable.actions', compact('room_stock_limit'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room', 'data' => 'room.room_name'],
            ['title' => 'Item Category', 'data' => 'item_category.id'],
            ['title' => 'Stock Max', 'data' => 'stock_max'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'room_stock_limits_datatable');

        return view('admin.room_stock_limits.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.room_stock_limits.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
            "stock_max" => "required|integer",
        ]);

        $room_stock_limit = RoomStockLimit::create(request()->all());

        activity('Created Room Stock Limit: ' . $room_stock_limit->id, request()->all(), $room_stock_limit);
        flash(['success', 'Room Stock Limit created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_stock_limits'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(RoomStockLimit $room_stock_limit)
    {
        return view('admin.room_stock_limits.read', compact('room_stock_limit'));
    }

    public function updateForm(RoomStockLimit $room_stock_limit)
    {
        return view('admin.room_stock_limits.update', compact('room_stock_limit'));
    }

    public function update(RoomStockLimit $room_stock_limit)
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_category_id" => "required|exists:item_categories,id",
            "stock_max" => "required|",
        ]);

        $room_stock_limit->update(request()->all());

        activity('Updated Room Stock Limit: ' . $room_stock_limit->id, request()->all(), $room_stock_limit);
        flash(['success', 'Room Stock Limit updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_stock_limits'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(RoomStockLimit $room_stock_limit)
    {
        $room_stock_limit->delete();

        activity('Deleted Room Stock Limit: ' . $room_stock_limit->id, $room_stock_limit->toArray());
        $flash = ['success', 'Room Stock Limit deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.room_stock_limits');
        }
    }
}