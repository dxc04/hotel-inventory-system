<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Products')->only(['createForm', 'create']);
        $this->middleware('can:Read Products')->only(['index', 'read']);
        $this->middleware('can:Update Products')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Products'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $products = Product::query();
            $datatable = datatables($products)
                ->editColumn('actions', function ($product) {
                    return view('admin.products.datatable.actions', compact('product'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Product Name', 'data' => 'product_name'],
            ['title' => 'Quantity', 'data' => 'quantity'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'products_datatable');

        return view('admin.products.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.products.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "product_name" => "required|unique:products",
            "photo" => "nullable|image",
            "quantity" => "integer",
        ]);

        $product = Product::create(request()->all());

        activity('Created Product: ' . $product->quantity, request()->all(), $product);
        flash(['success', 'Product created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.products'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Product $product)
    {
        return view('admin.products.read', compact('product'));
    }

    public function updateForm(Product $product)
    {
        return view('admin.products.update', compact('product'));
    }

    public function update(Product $product)
    {
        $this->validate(request(), [
            "product_name" => "required|unique:products,product_name,{$product->id}",
            "photo" => "nullable|image",
            "quantity" => "integer",
        ]);

        $product->update(request()->all());

        activity('Updated Product: ' . $product->quantity, request()->all(), $product);
        flash(['success', 'Product updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.products'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Product $product)
    {
        $product->delete();

        activity('Deleted Product: ' . $product->quantity, $product->toArray());
        $flash = ['success', 'Product deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.products');
        }
    }
}