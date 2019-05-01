<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoomStatus as RoomStatusRepo;
use App\RoomStatus;
use Auth;
use Illuminate\Support\Facades\Cache;

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

        //Cache::put('stock_computations', $this->room_status_repo->getStockComputations());
        return view('layouts.app', [
            'allthedata' => [
                'user' => Auth::user(),
                'app_name' => config('app.name', 'HSG Portal'),
                'rooms_data' => $this->room_status_repo->getAllTheData(),
            ]
        ]);
    }

}
