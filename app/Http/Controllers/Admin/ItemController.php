<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Items')->only(['createForm', 'create']);
        $this->middleware('can:Read Items')->only(['index', 'read']);
        $this->middleware('can:Update Items')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Items'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $items = Item::query();
            $datatable = datatables($items)
                ->editColumn('actions', function ($item) {
                    return view('admin.items.datatable.actions', compact('item'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Item Name', 'data' => 'item_name'],
            ['title' => 'SKU', 'data' => 'sku'],
            ['title' => 'Amount', 'data' => 'amount'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'items_datatable');

        return view('admin.items.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.items.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "item_name" => "required|unique:items",
            "sku" => "required|unique:items",
            "photo" => "nullable|image",
            "amount" => "integer",
        ]);

        $item = Item::create(request()->all());

        activity('Created Item: ' . $item->item_name, request()->all(), $item);
        flash(['success', 'Item created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.items'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Item $item)
    {
        return view('admin.items.read', compact('item'));
    }

    public function updateForm(Item $item)
    {
        return view('admin.items.update', compact('item'));
    }

    public function update(Item $item)
    {
        $this->validate(request(), [
            "item_name" => "required|unique:items,item_name,{$item->id}",
            "sku" => "required|unique:items,sku,{$item->sku}",
            "photo" => "nullable|image",
            "amount" => "integer",
        ]);

        $item->update(request()->all());

        activity('Updated Item: ' . $item->item_name, request()->all(), $item);
        flash(['success', 'Item updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.items'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Item $item)
    {
        $item->delete();

        activity('Deleted Item: ' . $item->item_name, $item->toArray());
        $flash = ['success', 'Item deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.items');
        }
    }
}