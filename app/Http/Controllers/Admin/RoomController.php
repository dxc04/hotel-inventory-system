<?php

namespace App\Http\Controllers\Admin;

use App\Room;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Rooms')->only(['createForm', 'create']);
        $this->middleware('can:Read Rooms')->only(['index', 'read']);
        $this->middleware('can:Update Rooms')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Rooms'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $rooms = Room::query()->with('room_type');
            $datatable = datatables($rooms)
                ->editColumn('actions', function ($room) {
                    return view('admin.rooms.datatable.actions', compact('room'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room Number', 'data' => 'room_number'],
            ['title' => 'Room Type', 'data' => 'room_type.room_type'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'rooms_datatable');

        return view('admin.rooms.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.rooms.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_number" => "required|unique:rooms",
            "room_type_id" => "required|exists:room_types,id",
            "description" => "required|min:10",
        ]);

        $room = Room::create(request()->all());

        activity('Created Room: ' . $room->room_type_id, request()->all(), $room);
        flash(['success', 'Room created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.rooms'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Room $room)
    {
        return view('admin.rooms.read', compact('room'));
    }

    public function updateForm(Room $room)
    {
        return view('admin.rooms.update', compact('room'));
    }

    public function update(Room $room)
    {
        $this->validate(request(), [
            "room_number" => "required|unique:rooms,room_number,{$room->id}",
            "room_type_id" => "required|exists:room_types,id",
            "description" => "required|min:10",
        ]);

        $room->update(request()->all());

        activity('Updated Room: ' . $room->room_type_id, request()->all(), $room);
        flash(['success', 'Room updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.rooms'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Room $room)
    {
        $room->delete();

        activity('Deleted Room: ' . $room->room_type_id, $room->toArray());
        $flash = ['success', 'Room deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.rooms');
        }
    }
}