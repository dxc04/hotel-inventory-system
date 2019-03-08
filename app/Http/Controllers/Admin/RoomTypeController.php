<?php

namespace App\Http\Controllers\Admin;

use App\RoomType;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class RoomTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Room Types')->only(['createForm', 'create']);
        $this->middleware('can:Read Room Types')->only(['index', 'read']);
        $this->middleware('can:Update Room Types')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Room Types'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $room_types = RoomType::query();
            $datatable = datatables($room_types)
                ->editColumn('actions', function ($room_type) {
                    return view('admin.room_types.datatable.actions', compact('room_type'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room Type', 'data' => 'room_type'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'room_types_datatable');

        return view('admin.room_types.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.room_types.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_type" => "required|unique:room_types",
        ]);

        $room_type = RoomType::create(request()->all());

        activity('Created Room Type: ' . $room_type->room_type, request()->all(), $room_type);
        flash(['success', 'Room Type created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_types'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(RoomType $room_type)
    {
        return view('admin.room_types.read', compact('room_type'));
    }

    public function updateForm(RoomType $room_type)
    {
        return view('admin.room_types.update', compact('room_type'));
    }

    public function update(RoomType $room_type)
    {
        $this->validate(request(), [
            "room_type" => "required|unique:room_types,{room_type_id}",
        ]);

        $room_type->update(request()->all());

        activity('Updated Room Type: ' . $room_type->room_type, request()->all(), $room_type);
        flash(['success', 'Room Type updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_types'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(RoomType $room_type)
    {
        $room_type->delete();

        activity('Deleted Room Type: ' . $room_type->room_type, $room_type->toArray());
        $flash = ['success', 'Room Type deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.room_types');
        }
    }
}