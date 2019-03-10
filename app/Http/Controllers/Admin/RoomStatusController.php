<?php

namespace App\Http\Controllers\Admin;

use App\RoomStatus;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class RoomStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Room Statuses')->only(['createForm', 'create']);
        $this->middleware('can:Read Room Statuses')->only(['index', 'read']);
        $this->middleware('can:Update Room Statuses')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Room Statuses'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $room_statuses = RoomStatus::query()->with('room', 'status');
            $datatable = datatables($room_statuses)
                ->editColumn('actions', function ($room_status) {
                    return view('admin.room_statuses.datatable.actions', compact('room_status'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room Number', 'data' => 'room.room_number'],
            ['title' => 'Room Status', 'data' => 'status.status_name'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'room_statuses_datatable');

        return view('admin.room_statuses.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.room_statuses.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id|unique:room_statuses",
            "status_id" => "required|exists:statuses,id",
        ]);

        $room_status = RoomStatus::create(request()->all());

        activity('Created Room Status: ' . $room_status->room_id, request()->all(), $room_status);
        flash(['success', 'Room Status created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_statuses'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(RoomStatus $room_status)
    {
        return view('admin.room_statuses.read', compact('room_status'));
    }

    public function updateForm(RoomStatus $room_status)
    {
        return view('admin.room_statuses.update', compact('room_status'));
    }

    public function update(RoomStatus $room_status)
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id|unique:room_statuses,room_id,{$room_status->id}",
            "status_id" => "required|exists:statuses,id",
        ]);

        $room_status->update(request()->all());

        activity('Updated Room Status: ' . $room_status->room_id, request()->all(), $room_status);
        flash(['success', 'Room Status updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.room_statuses'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(RoomStatus $room_status)
    {
        $room_status->delete();

        activity('Deleted Room Status: ' . $room_status->room_id, $room_status->toArray());
        $flash = ['success', 'Room Status deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.room_statuses');
        }
    }
}