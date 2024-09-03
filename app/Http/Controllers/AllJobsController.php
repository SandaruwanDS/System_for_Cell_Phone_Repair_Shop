<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Http\Request;
use App\Models\JobSheet;
use App\Models\Customer;
use App\Models\Technician;
use App\Models\Company;

class AllJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $jobsDetails = JobSheet::all();
        $jobsDetails = JobSheet::latest()->paginate(8);
        $techniciansData = Technician::all();
        return view('RepairAllJobs')
        ->with("technicians", $techniciansData)
        ->with("alljobs" , $jobsDetails);
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



     // ............update job ajax.................
     public function update(Request $request){

        JobSheet::where('id',$request->up_id)->update([
            'Customer_Name'=>$request->up_customer_name,
            'Customer_Phone'=>$request->up_customer_phone,
            'Job_no'=>$request->up_job_no,
            'Date'=>$request->up_receipt_date,
            'Brand'=>$request->up_brand,
            'Device_Model'=>$request->up_device_model,
            'IMEI_Number'=>$request->up_imei_number,
            'Amount'=>$request->up_amount,
            'Advance'=>$request->up_advance,
            'Balance'=>$request->up_balance,
            'Password'=>$request->up_password,
            'Product_Configuration'=>$request->up_product_configuration,
            'Problem_Reported'=>$request->up_problem_reported,
            'Technician'=>$request->up_technician,
            'Status'=>$request->up_status,
            'OC'=>$request->up_oc,
            'BC'=>$request->up_bc,
            'Item' => $request->itemValues, // Directly set the comma-separated string
            'Problem' => $request->problemValues, // Directly set the comma-separated string

            // $jobSheet->Item = implode(', ', $request->input('items')),
            // $jobSheet->Problem = implode(', ', $request->input('problems'))

        ]);

        return response()->json([
            'status'=>'success',
        ]);
    }

 // delete job ajax
    public function destroy(Request $request)
    {
        JobSheet::find($request->job_id)->delete();
        return response()->json([
            'status'=>'success',
        ]);
    }


    // print job ajax
    public function print(Request $request)
    {
        $jobNo = $request->job_no;
        $jobSheetData = JobSheet::where('Job_no',$jobNo)->get();
        $companyData = Company::latest()->paginate(1);

        // Generate the PDF content using a view
        $pdf = PDF::loadView('jobSheetPrint', ['jobSheetData' => $jobSheetData, 'companyData' => $companyData]);

        // Save the PDF to a temporary file
        $pdfPath = storage_path('../public/assets/pdf/jobSheet.pdf');
        $pdf->save($pdfPath);

        $pdfUrl = asset('public/assets/pdf/jobSheet.pdf');

        return response()->json(['status' => 'success', 'pdfUrl' => $pdfUrl]);
    }


     // ............ job pagination using ajax.................
     public function pagination(Request $request){
        $data = JobSheet::latest()->paginate(7);
        return view('jobs_pagination')->with("jobSheets",$data)->render();
    }

    // ............search using ajax.................
    public function search(Request $request){
        $data = JobSheet::where('Job_no', 'like', '%'.$request->search_string.'%')
        ->orWhere('Customer_Name','like','%'.$request->search_string.'%')
        ->orWhere('Customer_Phone','like','%'.$request->search_string.'%')
        ->orWhere('Date','like','%'.$request->search_string.'%')
        ->orWhere('Brand','like','%'.$request->search_string.'%')
        ->orWhere('Device_Model','like','%'.$request->search_string.'%')
        ->orWhere('IMEI_Number','like','%'.$request->search_string.'%')
        ->orWhere('Amount','like','%'.$request->search_string.'%')
        ->orWhere('Advance','like','%'.$request->search_string.'%')
        ->orWhere('Balance','like','%'.$request->search_string.'%')
        ->orWhere('Password','like','%'.$request->search_string.'%')
        ->orWhere('Product_Configuration','like','%'.$request->search_string.'%')
        ->orWhere('Problem_Reported','like','%'.$request->search_string.'%')
        ->orWhere('Technician','like','%'.$request->search_string.'%')
        ->orderBy('Job_no','desc')
        ->paginate(5);

        if($data->count() >= 1){
            return view('jobs_pagination')->with("jobSheets",$data)->render();
        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }
}
