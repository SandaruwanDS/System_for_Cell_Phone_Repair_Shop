<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\JobSheet;
use App\Models\Technician;
use App\Models\TInvoiceSum;
use App\Models\TInvoiceDeil;

class TechnicianReportController extends Controller
{

    public function index(Request $request)
    {
    // Get search criteria from the form input
    $fromDate  = $request->input('from_date');
    $toDate = $request->input('to_date');
    $technician = $request->input('technician');

    $query = JobSheet::whereBetween('Date', [$fromDate, $toDate])->get();

    // Construct a query to filter records based on search criteria
    $query = JobSheet::query();
    $techniciansData = Technician::all();

    if ($fromDate && $toDate && $technician) {
         $query = TInvoiceSum::select(
                'job_sheets.Job_no','job_sheets.IMEI_Number','job_sheets.Device_Model','job_sheets.Brand','job_sheets.Problem',
                't_invoice_sums.*',
                't_invoice_deils.Item_description'
            )

            ->join('t_invoice_deils', 't_invoice_sums.Job_no', '=', 't_invoice_deils.Job_no')
            ->join('job_sheets', 't_invoice_sums.Job_no', '=', 'job_sheets.Job_no')
            ->whereBetween('t_invoice_sums.Invoice_date', [$fromDate, $toDate])
            //->groupBy('t_invoice_sums.Job_no', 't_invoice_deils.Invoice_no')
            ->orderBy('t_invoice_sums.Job_no')
            ->where('job_sheets.Technician',$technician)
            ->get();
    }

        $total_amount = $query->sum('Amount');
        $totalAmount = number_format($total_amount, 2);

        $jobCount = $query->count();


    return view('reportByTechnician')
    -> with("technicians", $techniciansData)
    -> with("totalAmount", $totalAmount)
    -> with("fromDate", $fromDate)
    -> with("toDate", $toDate)
    -> with("jobCount", $jobCount)
    -> with("recipts", $query);

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
