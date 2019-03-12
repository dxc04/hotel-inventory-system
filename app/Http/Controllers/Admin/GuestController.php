<?php

namespace App\Http\Controllers\Admin;

use App\Guest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Guests')->only(['createForm', 'create']);
        $this->middleware('can:Read Guests')->only(['index', 'read']);
        $this->middleware('can:Update Guests')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Guests'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $guests = Guest::query();
            $datatable = datatables($guests)
                ->editColumn('actions', function ($guest) {
                    return view('admin.guests.datatable.actions', compact('guest'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'First Name', 'data' => 'first_name'],
            ['title' => 'Last Name', 'data' => 'last_name'],
            ['title' => 'Contact Number', 'data' => 'contact_number'],
            ['title' => 'Address', 'data' => 'address'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'guests_datatable');

        return view('admin.guests.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.guests.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "first_name" => "required",
            "last_name" => "required",
        ]);

        $guest = Guest::create(request()->all());

        activity('Created Guest: ' . $guest->last_name, request()->all(), $guest);
        flash(['success', 'Guest created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.guests'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Guest $guest)
    {
        return view('admin.guests.read', compact('guest'));
    }

    public function updateForm(Guest $guest)
    {
        return view('admin.guests.update', compact('guest'));
    }

    public function update(Guest $guest)
    {
        $this->validate(request(), [
            "first_name" => "required",
            "last_name" => "required",
        ]);

        $guest->update(request()->all());

        activity('Updated Guest: ' . $guest->last_name, request()->all(), $guest);
        flash(['success', 'Guest updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.guests'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Guest $guest)
    {
        $guest->delete();

        activity('Deleted Guest: ' . $guest->last_name, $guest->toArray());
        $flash = ['success', 'Guest deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.guests');
        }
    }
}