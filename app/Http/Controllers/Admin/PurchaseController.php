<?php

namespace App\Http\Controllers\Admin;

use App\Purchase;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Purchases')->only(['createForm', 'create']);
        $this->middleware('can:Read Purchases')->only(['index', 'read']);
        $this->middleware('can:Update Purchases')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Purchases'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $purchases = Purchase::query()->with('room', 'item');
            $datatable = datatables($purchases)
                ->editColumn('actions', function ($purchase) {
                    return view('admin.purchases.datatable.actions', compact('purchase'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room', 'data' => 'room.room_name'],
            ['title' => 'Item', 'data' => 'item.item_name'],
            ['title' => 'Quantity', 'data' => 'quantity'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'purchases_datatable');

        return view('admin.purchases.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.purchases.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_id" => "required|exists:items,id",
            "quantity" => "required|integer",
        ]);

        $purchase = Purchase::create(request()->all());

        activity('Created Purchase: ' . $purchase->id, request()->all(), $purchase);
        flash(['success', 'Purchase created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.purchases'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Purchase $purchase)
    {
        return view('admin.purchases.read', compact('purchase'));
    }

    public function updateForm(Purchase $purchase)
    {
        return view('admin.purchases.update', compact('purchase'));
    }

    public function update(Purchase $purchase)
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "item_id" => "required|exists:items,id",
            "quantity" => "required|",
        ]);

        $purchase->update(request()->all());

        activity('Updated Purchase: ' . $purchase->id, request()->all(), $purchase);
        flash(['success', 'Purchase updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.purchases'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Purchase $purchase)
    {
        $purchase->delete();

        activity('Deleted Purchase: ' . $purchase->id, $purchase->toArray());
        $flash = ['success', 'Purchase deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.purchases');
        }
    }
}
