<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoomStatus as RoomStatusRepo;
use App\RoomStatus;

class HomeController extends Controller
{

    /**
     * @var App\Repositories\RoomStatus
     */
    private $room_status_repo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->room_status_repo = new RoomStatusRepo(new RoomStatus());
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // dd($this->room_status_repo->getRoomStatusesToday()->toArray());
        return view('home', [
            'data' => $this->room_status_repo->getAllTheData()
        ]);
    }

}
