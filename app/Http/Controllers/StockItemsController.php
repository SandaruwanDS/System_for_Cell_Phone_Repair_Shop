<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\TItemMovement;

class StockItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockDetails = Item::select(
            'items.Item_code',
            'items.category',
            'items.Item_description',
            'items.purchasePrice',
            'items.saleprice',
            'items.alert_quantity',
            \DB::raw('SUM(t_item_movements.qun_in) as total_qun_in'),
            \DB::raw('SUM(t_item_movements.qun_out) as total_qun_out'),
            \DB::raw('MAX(t_item_movements.dDate) as last_movement_date')
            )

        ->leftJoin('t_item_movements', 'items.Item_code', '=', 't_item_movements.item_code')
        ->whereExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('t_opening_details')
                ->whereRaw('t_opening_details.Item_code = items.Item_code');
        })
        ->whereExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('t_item_movements')
                ->whereRaw('t_item_movements.item_code = items.Item_code');
        })
        ->groupBy('items.Item_code', 'items.category', 'items.Item_description', 'items.purchasePrice', 'items.saleprice', 'items.alert_quantity')
        ->get();

        return view('stock_items')
        ->with("stockDetails", $stockDetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
