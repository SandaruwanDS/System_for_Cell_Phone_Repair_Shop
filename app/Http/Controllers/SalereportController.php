<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TInvoiceSum;
use App\Models\JobSheet;
use App\Models\TInvoiceDeil;
use App\Models\Item;

class SalereportController extends Controller
{
    public function index(Request $request){
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // $invoice = TInvoiceSum::whereBetween('Invoice_date', [$fromDate, $toDate])->get();

        $salesReportDetails = TInvoiceSum::select(
            'job_sheets.*',
            't_invoice_sums.*',
            't_invoice_deils.*',
            'items.*'
        )
        ->join('t_invoice_deils', 't_invoice_sums.Job_no', '=', 't_invoice_deils.Job_no')
        ->join('items', 't_invoice_deils.Item_code', '=', 'items.Item_code')
        ->join('job_sheets', 't_invoice_sums.Job_no', '=', 'job_sheets.Job_no')
        ->whereBetween('t_invoice_sums.Invoice_date', [$fromDate, $toDate])
        // ->groupBy('t_invoice_sums.Job_no')
        ->get();

        $query = TInvoiceSum::query();

        if ($fromDate && $toDate) {
            $query = TInvoiceSum::whereBetween('Invoice_date', [$fromDate, $toDate])->get();

            $salesReportDetails = TInvoiceSum::select(
                'job_sheets.*',
                't_invoice_sums.*',
                't_invoice_deils.*',
                'items.*'
            )
            ->join('t_invoice_deils', 't_invoice_sums.Job_no', '=', 't_invoice_deils.Job_no')
            ->join('items', 't_invoice_deils.Item_code', '=', 'items.Item_code')
            ->join('job_sheets', 't_invoice_sums.Job_no', '=', 'job_sheets.Job_no')
            ->whereBetween('t_invoice_sums.Invoice_date', [$fromDate, $toDate])
            ->orderBy('t_invoice_sums.Invoice_no')
            // ->groupBy('t_invoice_sums.Job_no')
            ->get();

        }

        $tatal_purchase_price = $salesReportDetails->sum('purchasePrice');
        $totalPurchase = number_format($tatal_purchase_price, 2);

        $tatal_sales_price = $salesReportDetails->sum('saleprice');
        $totalSales = number_format($tatal_sales_price, 2);

        $tatal_net_amount = $salesReportDetails->sum('Net_value');
        $totalNet = number_format($tatal_net_amount, 2);

        $totalProfit = number_format($tatal_net_amount - $tatal_purchase_price, 2);


        $tatal_discount = $salesReportDetails->sum('Discount');
        $totalDiscount = number_format($tatal_discount, 2);

        $total_amount = $query->sum('Amount');
        $totalAmount = number_format($total_amount, 2);

        $total_advance =  $query->sum('Advance');
        $totalAdvance = number_format($total_advance, 2);
        $TotalPawn = TInvoiceSum::count();


        return view('sales_report')
        // ->with("invoice", $invoice)
        -> with("recipts", $query)
        -> with("totalNet", $totalNet)
        -> with("totalDiscount", $totalDiscount)
        -> with("totalPurchase", $totalPurchase)
        -> with("totalSales", $totalSales)
        -> with("totalProfit", $totalProfit)
        -> with("totalAmount", $totalAmount)
        -> with("salesReportDetails", $salesReportDetails)
        -> with("fromDate", $fromDate)
        -> with("toDate", $toDate)
        -> with("totalAdvance", $totalAdvance);

    }

}
