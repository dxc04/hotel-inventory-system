<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth_admin', 'can:Access Admin Panel']);
        $this->middleware('intend_url')->only(['index', 'read']);
        $this->middleware('can:Create Bookings')->only(['createForm', 'create']);
        $this->middleware('can:Read Bookings')->only(['index', 'read']);
        $this->middleware('can:Update Bookings')->only(['updateForm', 'update']);
        $this->middleware(['can:Delete Bookings'])->only('delete');
    }

    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            $bookings = Booking::query()->with('room', 'guest');
            $datatable = datatables($bookings)
                ->editColumn('actions', function ($booking) {
                    return view('admin.bookings.datatable.actions', compact('booking'));
                })
                ->rawColumns(['actions']);

            return $datatable->toJson();
        }

        $html = $builder->columns([
            ['title' => 'Room', 'data' => 'room.room_name'],
            ['title' => 'Guest', 'data' => 'guest.last_name'],
            ['title' => 'Number of Guests', 'data' => 'number_of_guests'],
            ['title' => 'Checkout At', 'data' => 'checkout_at'],
            ['title' => '', 'data' => 'actions', 'searchable' => false, 'orderable' => false],
        ]);
        $html->setTableAttribute('id', 'bookings_datatable');

        return view('admin.bookings.index', compact('html'));
    }

    public function createForm()
    {
        return view('admin.bookings.create');
    }

    public function create()
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "guest_id" => "required|exists:guests,id",
            "number_of_guests" => "required",
            "notes" => "required|min:10",
        ]);

        $booking = Booking::create(request()->all());

        activity('Created Booking: ' . $booking->number_of_guests, request()->all(), $booking);
        flash(['success', 'Booking created!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.bookings'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function read(Booking $booking)
    {
        return view('admin.bookings.read', compact('booking'));
    }

    public function updateForm(Booking $booking)
    {
        return view('admin.bookings.update', compact('booking'));
    }

    public function update(Booking $booking)
    {
        $this->validate(request(), [
            "room_id" => "required|exists:rooms,id",
            "guest_id" => "required|exists:guests,id",
            "number_of_guests" => "required",
            "notes" => "required|min:10",
        ]);

        $booking->update(request()->all());

        activity('Updated Booking: ' . $booking->number_of_guests, request()->all(), $booking);
        flash(['success', 'Booking updated!']);

        if (request()->input('_submit') == 'redirect') {
            return response()->json(['redirect' => session()->pull('url.intended', route('admin.bookings'))]);
        }
        else {
            return response()->json(['reload_page' => true]);
        }
    }

    public function delete(Booking $booking)
    {
        $booking->delete();

        activity('Deleted Booking: ' . $booking->number_of_guests, $booking->toArray());
        $flash = ['success', 'Booking deleted!'];

        if (request()->input('_submit') == 'reload_datatables') {
            return response()->json([
                'flash' => $flash,
                'reload_datatables' => true,
            ]);
        }
        else {
            flash($flash);

            return redirect()->route('admin.bookings');
        }
    }
}
