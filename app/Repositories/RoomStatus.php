<?php

namespace App\Repositories;

use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;
use App\RoomStatus as RoomStatusModel;
use App\Floor as FloorModel;
use App\Room as RoomModel; 
use App\Status as StatusModel;
use App\Purchase as PurchaseModel;
use App\Supplier as SupplierModel;
use App\Item as ItemModel;
use App\Category as CategoryModel;
use App\ItemCategory as ItemCategoryModel;
use App\Sale as SaleModel;
use App\StocksTransaction as StocksTransactionModel;
use App\StocksComputation as StocksComputationModel;
use App\RoomStock as RoomStockModel;
use App\ItemStock as ItemStockModel;
use App\RoomStockLimit as RoomStockLimitModel;
use App\ItemReject;
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
            'suppliers' => SupplierModel::all()->toArray(),
            'purchases' => PurchaseModel::all()->toArray(),
            'rooms' => RoomModel::all()->toArray(),
            'statuses' => StatusModel::all()->toArray(),
            'items' => ItemModel::all()->toArray(),
            'categories' => CategoryModel::all()->toArray(),
            'item_categories' => ItemCategoryModel::all()->toArray(),
            'floors' => FloorModel::all()->toArray(),
            'room_stocks' => RoomStockModel::all()->toArray(),
            'item_stocks' => ItemStockModel::all()->toArray(),
            'room_stocks_limit' => RoomStockLimitModel::all()->toArray()
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

            $this->deductRoomStock($ic['room_id'], $ic['item_category_id'], $ic['quantity']);
        }
    }

    public function postAnItemReject($data)
    {
        foreach ($data['item_categories'] as $ic) {
            $item_reject = ItemReject::firstOrCreate([
                'room_id' => $ic['room_id'],
                'item_category_id' => $ic['item_category_id'],
                'quantity' => $ic['quantity'],
            ]);
            $item_reject->save();

            $this->deductRoomStock($ic['room_id'], $ic['item_category_id'], $ic['quantity']);
        }
    }

    public function postAnExtraSale($data)
    {
        $restock_status_id = StatusModel::where('status_key', 'restock')->pluck('id')->first();
        $this->postRoomStatus($data['room_id'], $restock_status_id);

        foreach ($data['item_categories'] as $ic) {
            $ic['room_id'] = $data['room_id'];

            $item_cat = ItemCategoryModel::where('item_id', $ic['item_category_id'])->first();
            $this->deductItemStock($ic['room_id'], $item_cat->item_id, $ic['quantity']);

            $sale = SaleModel::firstOrCreate($ic);
            $sale->save();
        }

        $sale_status_id = StatusModel::where('status_key', 'sale')->pluck('id')->first();
        $this->postRoomStatus($data['room_id'], $sale_status_id);
    }

    public function postARestock($data)
    {
        $restock_status_id = StatusModel::where('status_key', 'restock')->pluck('id')->first();

        foreach ($data as $ic) {
            $item = ItemCategoryModel::where('item_id', $ic['item_category_id'])->first();
            $this->deductItemStock($ic['room_id'], $item->item_id, $ic['quantity']);
            $this->addRoomStock($ic['room_id'], $ic['item_category_id'], $ic['quantity']);

            $this->postRoomStatus($ic['room_id'], $restock_status_id);
        }
    }

    public function deductRoomStock($room_id, $item_category_id, $qty)
    {
        $room_stock = RoomStockModel::where('room_id', $room_id)
            ->where('item_category_id', $item_category_id)
            ->first();
        $room_stock->stock_quantity = $room_stock->stock_quantity - $qty;
        $room_stock->save();

    }

    public function addRoomStock($room_id, $item_category_id, $qty)
    {
        $room_stock = RoomStockModel::where('room_id', $room_id)
            ->where('item_category_id', $item_category_id)
            ->first();
        $room_stock->stock_quantity = $room_stock->stock_quantity + $qty;
        $room_stock->save();

    }

    public function deductItemStock($room_id, $item_id, $qty)
    {
        $item = ItemStockModel::where('item_id', $item_id)->first();
        $item->stock_quantity = $item->stock_quantity - $qty;
        $item->save();
    }

    public function addItemStock($purchase_id, $item_id, $qty)
    {
        $purchase = PurchaseModel::find($purchase_id);
        $purchase->status = 'Stocked';
        $purchase->save();
        
        $item = ItemStockModel::where('item_id', $item_id)->first();
        $item->stock_quantity = $item->stock_quantity + $qty;
        $item->save();
    }

    public function getRoomStocks()
    {
        return RoomStockModel::all()->toArray();
    }

    public function getItemStocks()
    {
        return ItemStockModel::all()->toArray();
    }

    public function getPurchases()
    {
        return PurchaseModel::all()->toArray();
    }

    public function getRoomStatus()
    {
        return [
            //'room_statuses' => RoomStatusModel::whereDate('created_at', Carbon::today())->get()->toArray(),
            //'sales' => SaleModel::whereDate('created_at', Carbon::today())->get()->toArray(),
            'room_statuses' => RoomStatusModel::all()->toArray(),
            'sales' => SaleModel::all()->toArray(),
            'purchases' => PurchaseModel::all()->toArray(),
            'suppliers' => SupplierModel::all()->toArray(),
            'rooms' => RoomModel::all()->toArray(),
            'statuses' => StatusModel::all()->toArray(),
            'items' => ItemModel::all()->toArray(),
            'categories' => CategoryModel::all()->toArray(),
            'item_categories' => ItemCategoryModel::all()->toArray()
        ];
    }

}
