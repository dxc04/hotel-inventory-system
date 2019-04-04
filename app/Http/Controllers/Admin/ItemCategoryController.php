<?php

namespace App\Http\Controllers\Admin;

use App\ItemCategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class ItemCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Item Categories')->only(['createForm', 'create']);
        $this->middleware('can:Read Item Categories')->only(['index', 'read']);
        $this->middleware('can:Update Item Categories')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Item Categories'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $item_categories = ItemCategory::query()->with('item', 'category');
            $datatable = datatables($item_categories)
                ->editColumn('actions', function ($item_category) {
                    return view('admin.item_categories.datatable.actions', compact('item_category'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Item', 'data' => 'item.item_name'],
            ['title' => 'Category', 'data' => 'category.category_name'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'item_categories_datatable');

        return view('admin.item_categories.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.item_categories.create');
    }

    public function create()
    {
        $this->validate(request(), [
            
        ]);

        $item_category = ItemCategory::create(request()->all());

        activity('Created Item Category: ' . $item_category->category_id, request()->all(), $item_category);
        flash(['success', 'Item Category created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.item_categories'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(ItemCategory $item_category)
    {
        return view('admin.item_categories.read', compact('item_category'));
    }

    public function updateForm(ItemCategory $item_category)
    {
        return view('admin.item_categories.update', compact('item_category'));
    }

    public function update(ItemCategory $item_category)
    {
        $this->validate(request(), [
            
        ]);

        $item_category->update(request()->all());

        activity('Updated Item Category: ' . $item_category->category_id, request()->all(), $item_category);
        flash(['success', 'Item Category updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.item_categories'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(ItemCategory $item_category)
    {
        $item_category->delete();

        activity('Deleted Item Category: ' . $item_category->category_id, $item_category->toArray());
        $flash = ['success', 'Item Category deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.item_categories');
        }
    }
}