<?php

namespace App\Http\Controllers\Admin;

use App\Status;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Statuses')->only(['createForm', 'create']);
        $this->middleware('can:Read Statuses')->only(['index', 'read']);
        $this->middleware('can:Update Statuses')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Statuses'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $statuses = Status::query();
            $datatable = datatables($statuses)
                ->editColumn('actions', function ($status) {
                    return view('admin.statuses.datatable.actions', compact('status'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Status Name', 'data' => 'status_name'],
            ['title' => 'Status Key', 'data' => 'status_key'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'statuses_datatable');

        return view('admin.statuses.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.statuses.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "status_name" => "required|unique:statuses",
            "status_key" => "required|unique:statuses",
        ]);

        $status = Status::create(request()->all());

        activity('Created Status: ' . $status->status_name, request()->all(), $status);
        flash(['success', 'Status created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.statuses'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Status $status)
    {
        return view('admin.statuses.read', compact('status'));
    }

    public function updateForm(Status $status)
    {
        return view('admin.statuses.update', compact('status'));
    }

    public function update(Status $status)
    {
        $this->validate(request(), [
            "status_name" => "required|unique:statuses,status_name,{$status->id}",
            "status_key" => "required|unique:statuses,status_key,{$status->id}",
        ]);

        $status->update(request()->all());

        activity('Updated Status: ' . $status->status_name, request()->all(), $status);
        flash(['success', 'Status updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.statuses'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Status $status)
    {
        $status->delete();

        activity('Deleted Status: ' . $status->status_name, $status->toArray());
        $flash = ['success', 'Status deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.statuses');
        }
    }
}