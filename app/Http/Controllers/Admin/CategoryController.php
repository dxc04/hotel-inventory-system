<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Categories')->only(['createForm', 'create']);
        $this->middleware('can:Read Categories')->only(['index', 'read']);
        $this->middleware('can:Update Categories')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Categories'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $categories = Category::query();
            $datatable = datatables($categories)
                ->editColumn('actions', function ($category) {
                    return view('admin.categories.datatable.actions', compact('category'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Category Name', 'data' => 'category_name'],
            ['title' => 'Key', 'data' => 'key'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'categories_datatable');

        return view('admin.categories.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.categories.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "category_name" => "required",
            "key" => "required",
        ]);

        $category = Category::create(request()->all());

        activity('Created Category: ' . $category->category_name, request()->all(), $category);
        flash(['success', 'Category created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.categories'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Category $category)
    {
        return view('admin.categories.read', compact('category'));
    }

    public function updateForm(Category $category)
    {
        return view('admin.categories.update', compact('category'));
    }

    public function update(Category $category)
    {
        $this->validate(request(), [
            "category_name" => "required",
            "key" => "required",
        ]);

        $category->update(request()->all());

        activity('Updated Category: ' . $category->category_name, request()->all(), $category);
        flash(['success', 'Category updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.categories'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Category $category)
    {
        $category->delete();

        activity('Deleted Category: ' . $category->category_name, $category->toArray());
        $flash = ['success', 'Category deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.categories');
        }
    }
}