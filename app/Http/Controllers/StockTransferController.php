<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\branchDel;
use App\Models\Item;
use App\Models\JobSheet;
use App\Models\Category;
use App\Models\TStockTransferSum;
use App\Models\TStockTransferDetails;
use App\Models\TItemMovement;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get max invoice number max
        $maxInvoiceNo = TStockTransferSum::orderBy('Invoice_no', 'desc')->value('Invoice_no');
        $maxInvoice = str_pad($maxInvoiceNo, 4, '0', STR_PAD_LEFT);
        $companyData = Company::latest()->paginate(1);
        $itemCode = Item::all();
        $itemCategory = Category::all();

        return view('Stock_transfer')
        ->with("itemCategory" , $itemCategory)
        ->with("itemCode" , $itemCode)
        ->with("companyData" , $companyData)
        ->with("maxInvoiceNo", $maxInvoice);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStockTransfer(Request $request){
        $request->validate([
           'inputs.*.job_no' => ' required',
           'inputs.*.invoice_no' => ' required',
           'inputs.*.invoice_date' => ' required',
           'inputs.*.item_category' => ' required',
           'inputs.*.item_code' => ' required',
           'inputs.*.item_description' => ' required',
           'inputs.*.qty' => ' required',
           'inputs.*.unit_price' => ' required',
           'inputs.*.net_value' => ' required'
       ],[
           'inputs.*.job_no' => ' The Job No field is required',
           'inputs.*.invoice_no' => ' The Invoice No field is required',
           'inputs.*.invoice_date' => ' The Invoice Date field is required',
           'inputs.*.item_category' => ' The Item Category field is required',
           'inputs.*.item_code' => ' The Item Code field is required',
           'inputs.*.item_description' => ' The Item Description field is required',
           'inputs.*.qty' => ' The QTY field is required',
           'inputs.*.unit_price' => ' The Unit Price field is required',
           'inputs.*.net_value' => ' The Net Value field is required'
       ]);

    //    $jobNo = $request->job_no;
    //    $jobsheetdata = JobSheet::where('Job_no', $jobNo)->first();
    //    if ($jobsheetdata) {
    //    $Problem = $jobsheetdata->Problem;
    //    $Technician = $jobsheetdata->Technician;

       $InvoiceSum = new TStockTransferSum;
       $InvoiceSum->Job_no = $request->bccode;
       $InvoiceSum->Invoice_no = $request->invoice_no;
       $InvoiceSum->Invoice_date = $request->invoice_date;
       $InvoiceSum->Branch_Name = $request->branch_name;
       $InvoiceSum->Branch_Phone = $request->branch_phone;
       $InvoiceSum->Branch_Address = $request->branch_address;
       $InvoiceSum->Amount = $request->paid_amount;
       $InvoiceSum->Net_Amount = $request->total_amount;
       $InvoiceSum->OC = $request->operator;
       $InvoiceSum->save();
   
       foreach ($request -> inputs as $key=>$value){
       $InvoiceDetails = new TStockTransferDetails;
       $ItemMovementDetails = new TItemMovement;

       $InvoiceDetails->Job_no = $request->bccode;
       $InvoiceDetails->Invoice_no=$value['invoice_no'];
       $InvoiceDetails->Invoice_date=$value['invoice_date'];
       $InvoiceDetails->Item_category=$value['item_category'];
       $InvoiceDetails->Item_code=$value['item_code'];
       $InvoiceDetails->Item_description=$value['item_description'];
       $InvoiceDetails->QTY=$value['qty'];
       $InvoiceDetails->Unit_price=$value['unit_price'];
       $InvoiceDetails->Discount=$value['discount'];
       $InvoiceDetails->Net_value=$value['net_value'];
       $InvoiceDetails->OC=$value['operator'];
       $InvoiceDetails->save();

       $ItemMovementDetails->trans_no=$value['invoice_no'];
       $ItemMovementDetails->dDate=$value['invoice_date'];
       $ItemMovementDetails->trans_code="STOCK_TRANSFER";
       //strock_tranfer
       $ItemMovementDetails->item_code=$value['item_code'];
       $ItemMovementDetails->qun_out=$value['qty'];
       $ItemMovementDetails->bc=$value['bc'];
       $ItemMovementDetails->save();
       }

       $job_no = $request->job_no;
       JobSheet::where('Job_no', $job_no)->update([
           'Status'=>"Delivered",
       ]);

       $companyData = Company::latest()->paginate(1);


       $invoiceInput_no = $request->invoice_no;
       $T_detailsdata = TStockTransferDetails::where('Invoice_no', $invoiceInput_no)->get();
       $T_sumdata = TStockTransferSum::where('Invoice_no', $invoiceInput_no)->get();

       // Generate the PDF content using a view
       $pdf = PDF::loadView('repairInvoicePrint', ['pawnSumData' => $T_sumdata , 'pawnDetailsData' => $T_detailsdata, 'companyData' => $companyData]);

       // Save the PDF to a temporary file
       $pdfPath = storage_path('../public/assets/pdf/Repair_Invoice.pdf');
       $pdf->save($pdfPath);
       $pdfUrl = asset('public/assets/pdf/Repair_Invoice.pdf');

       return back()
       ->with('done','The Stock Transfer has been added')
       ->with("pdfLink", $pdfUrl);

   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBranch(Request $request)
    {
        $BranchNo =$request->search_string;
        $data = branchDel::where('bccode', $BranchNo)->get();
        if($data->count() != 0){
            // dd($data );
            return response()->json([
                'status'=>'success',
                'BranchNo'=> $data,
            ]);
        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
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
