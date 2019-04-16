<?php

namespace App\Http\Controllers\Admin;

use App\StocksTransaction;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class StocksTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Stocks Transactions')->only(['createForm', 'create']);
        $this->middleware('can:Read Stocks Transactions')->only(['index', 'read']);
        $this->middleware('can:Update Stocks Transactions')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Stocks Transactions'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $stocks_transactions = StocksTransaction::query();
            $datatable = datatables($stocks_transactions)
                ->editColumn('actions', function ($stocks_transaction) {
                    return view('admin.stocks_transactions.datatable.actions', compact('stocks_transaction'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Transaction Type', 'data' => 'transaction_key'],
            ['title' => 'Quantity', 'data' => 'quantity'],
            ['title' => 'Remote ID', 'data' => 'remote_id'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'stocks_transactions_datatable');

        return view('admin.stocks_transactions.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.stocks_transactions.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "transaction_key" => "required|in:sale,purchase,replenishment,room-stock-reject,item-stock-reject",
            "quantity" => "required",
            "remote_id" => "required|integer",
            "notes" => "required|min:250",
        ]);

        $stocks_transaction = StocksTransaction::create(request()->all());

        activity('Created Stocks Transaction: ' . $stocks_transaction->remote_id, request()->all(), $stocks_transaction);
        flash(['success', 'Stocks Transaction created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.stocks_transactions'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(StocksTransaction $stocks_transaction)
    {
        return view('admin.stocks_transactions.read', compact('stocks_transaction'));
    }

    public function updateForm(StocksTransaction $stocks_transaction)
    {
        return view('admin.stocks_transactions.update', compact('stocks_transaction'));
    }

    public function update(StocksTransaction $stocks_transaction)
    {
        $this->validate(request(), [
            "transaction_key" => "required|in:sale,purchase,replenishment,room-stock-reject,item-stock-reject",
            "quantity" => "required",
            "remote_id" => "required|integer",
            "notes" => "required|min:250",
        ]);

        $stocks_transaction->update(request()->all());

        activity('Updated Stocks Transaction: ' . $stocks_transaction->remote_id, request()->all(), $stocks_transaction);
        flash(['success', 'Stocks Transaction updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.stocks_transactions'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(StocksTransaction $stocks_transaction)
    {
        $stocks_transaction->delete();

        activity('Deleted Stocks Transaction: ' . $stocks_transaction->remote_id, $stocks_transaction->toArray());
        $flash = ['success', 'Stocks Transaction deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.stocks_transactions');
        }
    }
}