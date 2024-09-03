<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\TItemMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Item;

class StockReportController extends Controller
{
    public function index(Request $request){

        $branch_code = auth()->user()->BC;

        $stockDetails = Item::select(
            // 'items.Item_code', 'items.category', 'items.Item_description', 'items.purchasePrice', 'items.saleprice'

            'items.Item_code',
            'items.category',
            'items.Item_description',
            'items.purchasePrice',
            'items.saleprice',
            \DB::raw('SUM(t_item_movements.qun_in) as total_qun_in'),
            \DB::raw('SUM(t_item_movements.qun_out) as total_qun_out'),
            \DB::raw('MAX(t_item_movements.dDate) as last_movement_date')
            )
        // ->selectRaw('SUM(t_item_movements.qun_in) as total_qun_in')
        // ->selectRaw('SUM(t_item_movements.qun_out) as total_qun_out')
        // ->selectRaw('MAX(t_item_movements.dDate) as last_movement_date')
        // ->join('t_opening_details', 'items.Item_code', '=', 't_opening_details.Item_code')
        // ->leftJoin('t_item_movements', 'items.Item_code', '=', 't_item_movements.item_code')
        // ->groupBy('items.Item_code', 'items.category', 'items.Item_description', 'items.purchasePrice', 'items.saleprice')
        // ->get();

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
        ->groupBy('items.Item_code', 'items.category', 'items.Item_description', 'items.purchasePrice', 'items.saleprice')
        ->get();

        $query = TItemMovement::query();

        $quain = $stockDetails->sum('total_qun_in');
        $quaout =  $stockDetails->sum('total_qun_out');
        $balance =  $quain-$quaout;

        return view('stockReport')
            -> with("stockDetails", $stockDetails)
            -> with("quain", $quaout)
            -> with("quaout", $quaout)
            -> with("balance", $balance);
    }


    public function filter(Request $request){
            $branch_code = auth()->user()->BC;

            $request->validate([
                'date'=>'required',
            ]);

            $fromDate = "2023-01-01";
            $toDate = $request->date;

                    // $stockDetails = Item::select('items.Item_code', 'items.category', 'items.Item_description', 'items.purchasePrice', 'items.saleprice')
                    //         ->selectRaw('SUM(t_item_movements.qun_in) as total_qun_in')
                    //         ->selectRaw('SUM(t_item_movements.qun_out) as total_qun_out')
                    //         ->selectRaw('MAX(t_item_movements.dDate) as last_movement_date')
                    //         ->leftJoin('t_item_movements', 'items.Item_code', '=', 't_item_movements.item_code')
                    //         ->groupBy('items.Item_code', 'items.category', 'items.Item_description', 'items.purchasePrice', 'items.saleprice')
                    //         ->whereBetween('t_item_movements.dDate', [$fromDate, $toDate])
                    //         ->get();

                    $stockDetails = Item::select(
                        'items.Item_code',
                        'items.category',
                        'items.Item_description',
                        'items.purchasePrice',
                        'items.saleprice',
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
                        ->groupBy('items.Item_code', 'items.category', 'items.Item_description', 'items.purchasePrice', 'items.saleprice')
                        ->whereBetween('t_item_movements.dDate', [$fromDate, $toDate])
                        ->get();



                    $quain = $stockDetails->sum('total_qun_in');
                    $quaout =  $stockDetails->sum('total_qun_out');
                    $balance =  $quain-$quaout;

            return view('stockReport')
                -> with("stockDetails", $stockDetails)
                -> with("balance", $balance);
    }

}
