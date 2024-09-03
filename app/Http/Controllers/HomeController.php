<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\TItemMovement;
use App\Models\TInvoiceSum;
use App\Models\TInvoiceDeils;
use App\Models\JobSheet;
use App\Models\TOpeningSum;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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


        $totalSales = TInvoiceSum::sum('Amount');
        $jobsCount = JobSheet::count();
        $totalAdvance = JobSheet::sum('Advance');
        $totalPurchases = TOpeningSum::sum('Amount');

        return view('home')
        -> with("totalSales", $totalSales)
        -> with("jobsCount", $jobsCount)
        -> with("totalAdvance", $totalAdvance)
        -> with("totalPurchases", $totalPurchases)
        -> with("stockDetails", $stockDetails);
    }


}
