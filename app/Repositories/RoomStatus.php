<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;
use App\RoomStatus as RoomStatusModel;
use App\Room as RoomModel; 
use App\Status as StatusModel;
use Carbon\Carbon;

/**
 * Class RoomStatus
 */
class RoomStatus extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return RoomStatusModel::class;
    }

    /**
     * Fetch all data for room status for the current day
     */
    public function getAllTheData()
    {
        return [
            'room_statuses' => RoomStatusModel::whereDate('created_at', Carbon::today())->get()->toArray(),
            'rooms' => RoomModel::all()->toArray(),
            'statuses' => StatusModel::all()->toArray(),
        ];
    }
}
