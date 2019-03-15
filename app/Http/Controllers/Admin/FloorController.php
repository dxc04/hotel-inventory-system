<?php

namespace App\Http\Controllers\Admin;

use App\Floor;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class FloorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Floors')->only(['createForm', 'create']);
        $this->middleware('can:Read Floors')->only(['index', 'read']);
        $this->middleware('can:Update Floors')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Floors'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $floors = Floor::query();
            $datatable = datatables($floors)
                ->editColumn('actions', function ($floor) {
                    return view('admin.floors.datatable.actions', compact('floor'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Floor', 'data' => 'floor_name'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'floors_datatable');

        return view('admin.floors.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.floors.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "floor_name" => "required|unique:floors",
        ]);

        $floor = Floor::create(request()->all());

        activity('Created Floor: ' . $floor->floor_name, request()->all(), $floor);
        flash(['success', 'Floor created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.floors'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Floor $floor)
    {
        return view('admin.floors.read', compact('floor'));
    }

    public function updateForm(Floor $floor)
    {
        return view('admin.floors.update', compact('floor'));
    }

    public function update(Floor $floor)
    {
        $this->validate(request(), [
            "floor_name" => "required|unique:floors,floor_name,{$floor->id}",
        ]);

        $floor->update(request()->all());

        activity('Updated Floor: ' . $floor->floor_name, request()->all(), $floor);
        flash(['success', 'Floor updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.floors'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Floor $floor)
    {
        $floor->delete();

        activity('Deleted Floor: ' . $floor->floor_name, $floor->toArray());
        $flash = ['success', 'Floor deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.floors');
        }
    }
}