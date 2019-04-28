<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;
use App\RoomStatus as RoomStatusModel;
use App\Floor as FloorModel;
use App\Room as RoomModel; 
use App\Status as StatusModel;
use App\Purchase as PurchaseModel;
use App\Item as ItemModel;
use App\Category as CategoryModel;
use App\ItemCategory as ItemCategoryModel;
use App\Sale as SaleModel;
use App\StocksTransaction as StocksTransactionModel;
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
            //'room_statuses' => RoomStatusModel::whereDate('created_at', Carbon::today())->get()->toArray(),
            //'sales' => SaleModel::whereDate('created_at', Carbon::today())->get()->toArray(),
            'room_statuses' => RoomStatusModel::all()->toArray(),
            'sales' => SaleModel::all()->toArray(),
            'rooms' => RoomModel::all()->toArray(),
            'statuses' => StatusModel::all()->toArray(),
            'items' => ItemModel::all()->toArray(),
            'categories' => CategoryModel::all()->toArray(),
            'item_categories' => ItemCategoryModel::all()->toArray(),
            'floors' => FloorModel::all()->toArray(),
            'restock_item_categories' => $this->roomStocks()
        ];
    }

    public function postRoomStatus($room_id, $status_id)
    {
        $room_status = RoomStatusModel::firstOrCreate(['room_id' => $room_id]);

        $statuses = $room_status->status ? $room_status->status : [];
        if (!in_array($status_id, $statuses)) {
            $statuses[] = $status_id;
        }

        $room_status->status = $statuses;
        $room_status->save();
    }

    public function postASale($data)
    {
        $status_id = StatusModel::where('status_key', 'sale')->pluck('id')->first();
        $this->postRoomStatus($data['room_id'], $status_id);

        foreach ($data['item_categories'] as $ic) {
            $ic['room_id'] = $data['room_id'];
            $sale = SaleModel::firstOrCreate($ic);
            $sale->save();
            $stock_transaction = StocksTransactionModel::firstOrCreate([
                'remote_id' => $sale->id,
                'quantity' => $ic['quantity'],
                'transaction_key' => 'sale',
                'notes' => ''
            ]);
            $stock_transaction->save();
        }

    }

    public function postAnItemReject($data)
    {
        foreach ($data['item_categories'] as $ic) {
            $stock_transaction = StocksTransactionModel::firstOrCreate([
                'remote_id' => $ic['item_category_id'],
                'quantity' => $ic['quantity'],
                'transaction_key' => 'item-stock-reject',
                'notes' => ''
            ]);
            $stock_transaction->save();
        }
    }

    public function postAnExtraSale($data)
    {

        $restock_status_id = StatusModel::where('status_key', 'restock')->pluck('id')->first();
        $this->postRoomStatus($data['room_id'], $restock_status_id);

        foreach ($data['item_categories'] as $ic) {
            $stock_transaction_1 = StocksTransactionModel::firstOrCreate([
                'remote_id' => $ic['item_category_id'],
                'quantity' => $ic['quantity'],
                'transaction_key' => 'restock',
                'notes' => 'extra sale'
            ]);
            $stock_transaction_1->save();

            $stock_transaction_2 = StocksTransactionModel::firstOrCreate([
                'remote_id' => $ic['item_category_id'],
                'quantity' => $ic['quantity'],
                'transaction_key' => 'sale',
                'notes' => 'extra sale'
            ]);
            $stock_transaction_2->save();
  
        }

        $sale_status_id = StatusModel::where('status_key', 'sale')->pluck('id')->first();
        $this->postRoomStatus($data['room_id'], $sale_status_id);
    }

    public function postARestock($data)
    {
        $restock_status_id = StatusModel::where('status_key', 'restock')->pluck('id')->first();

        foreach ($data['item_categories'] as $ic) {
            $stock_transaction = StocksTransactionModel::firstOrCreate([
                'remote_id' => $ic['item_category_id'],
                'quantity' => $ic['quantity'],
                'transaction_key' => 'restock',
                'notes' => ''
            ]);
            $stock_transaction->save();
            $this->postRoomStatus($data['room_id'], $restock_status_id);
        }
    }

    public function roomStocks()
    {
        // dummy
        
        return [


        ];
    }

}
