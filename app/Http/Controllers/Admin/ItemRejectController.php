<?php

namespace App\Http\Controllers\Admin;

use App\ItemReject;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class ItemRejectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Item Rejects')->only(['createForm', 'create']);
        $this->middleware('can:Read Item Rejects')->only(['index', 'read']);
        $this->middleware('can:Update Item Rejects')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Item Rejects'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $item_rejects = ItemReject::query()->with('room', 'item', 'item');
            $datatable = datatables($item_rejects)
                ->editColumn('actions', function ($item_reject) {
                    return view('admin.item_rejects.datatable.actions', compact('item_reject'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room', 'data' => 'room.room_name'],
            ['title' => 'Item Category', 'data' => 'item_category.id'],
            ['title' => 'Item', 'data' => 'item.item_name'],
            ['title' => 'Quantity', 'data' => 'quantity'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'item_rejects_datatable');

        return view('admin.item_rejects.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.item_rejects.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "exists:rooms,id",
            "item_category_id" => "exists:item_categories,id",
            "item_id" => "exists:items,id",
            "quantity" => "required|integer",
        ]);

        $item_reject = ItemReject::create(request()->all());

        activity('Created Item Reject: ' . $item_reject->id, request()->all(), $item_reject);
        flash(['success', 'Item Reject created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.item_rejects'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(ItemReject $item_reject)
    {
        return view('admin.item_rejects.read', compact('item_reject'));
    }

    public function updateForm(ItemReject $item_reject)
    {
        return view('admin.item_rejects.update', compact('item_reject'));
    }

    public function update(ItemReject $item_reject)
    {
        $this->validate(request(), [
            "room_id" => "exists:rooms,id",
            "item_category_id" => "exists:item_categories,id",
            "item_id" => "exists:items,id",
            "quantity" => "required|",
        ]);

        $item_reject->update(request()->all());

        activity('Updated Item Reject: ' . $item_reject->id, request()->all(), $item_reject);
        flash(['success', 'Item Reject updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.item_rejects'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(ItemReject $item_reject)
    {
        $item_reject->delete();

        activity('Deleted Item Reject: ' . $item_reject->id, $item_reject->toArray());
        $flash = ['success', 'Item Reject deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.item_rejects');
        }
    }
}