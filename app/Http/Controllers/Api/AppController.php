<?php

namespace App\Http\Controllers\Api;

use App\Status;
use App\RoomStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoomStatus as RoomStatusRepo;
use Auth;
use PDF;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $room_status_repo;

    public function __construct()
    {
        $this->room_status_repo = new RoomStatusRepo(new RoomStatus());
        //$this->middleware('api');
    }

    public function getAllthedata()
    {
        return response()->json(['rooms_data' => $this->room_status_repo->getAllTheData()]);        
    }

    public function getRoomStatus()
    {
        return response()->json($this->room_status_repo->getRoomStatus());        
    }

    public function getRoomsStocks()
    {
        return response()->json($this->room_status->getRoomStocks());
    }

    public function postASale()
    {
        $sale_data = request()->post();
        $this->room_status_repo->postASale($sale_data);
        return response()->json(['room_stocks' => $this->room_status_repo->getRoomStocks()]);
    }

    public function postNoSale()
    {
        $status_id = Status::where('status_key', 'no_sale')->pluck('id')->first();
        $room_id = request('selected_room');

        $this->room_status_repo->postRoomStatus($room_id, $status_id);
        return response()->json([]);
    }

    public function postDNDDueOut()
    {
        $status_id = Status::where('status_key', 'dnd_due_out')->pluck('id')->first();
        $room_id = request('selected_room');

        $this->room_status_repo->postRoomStatus($room_id, $status_id);
        return response()->json([]);
    }

    public function postDNDStayover()
    {
        $status_id = Status::where('status_key', 'dnd_stayover')->pluck('id')->first();
        $room_id = request('selected_room');

        $this->room_status_repo->postRoomStatus($room_id, $status_id);
        return response()->json([]);;

    }

    public function postAnItemReject()
    {
        $data = request()->post();
        $this->room_status_repo->postAnItemReject($data);
        return response()->json(['room_stocks' => $this->room_status_repo->getRoomStocks()]);
    }

    public function postAnExtraSale()
    {
        $data = request()->post();
        $this->room_status_repo->postAnExtraSale($data);
        return response()->json(['room_stocks' => $this->room_status_repo->getRoomStocks()]);
    }

    public function postARestock()
    {
        $data = request()->post();
        $this->room_status_repo->postARestock($data);
        return response()->json([
            'room_stocks' => $this->room_status_repo->getRoomStocks(),
            'item_stocks' => $this->room_status_repo->getItemStocks()
        ]);     
    }

    public function itemsForRestockReport()
    {
        $date = date("d/m/Y");
        $pdf = PDF::loadView('restock_report', ['data' => request()->all(), 'date' => $date]);
        
        return $pdf->output();
    }
}
