<?php
namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\JobSheet;
use App\Models\Item;
use App\Models\Category;
use App\Models\TInvoiceSum;
use App\Models\TInvoiceDeils;
use App\Models\TItemMovement;


class InvoiceController extends Controller
{

    public function index()
    {
        // $data = Invoice::latest()->paginate(7);
        $TInvoiceSumData = TInvoiceSum::latest()->paginate(7);
        $TInvoiceDetailsData = TInvoiceDeils::latest()->paginate(7);

        // get max invoice number max
        $maxInvoiceNo = Invoice::orderBy('Invoice_no', 'desc')->value('Invoice_no');
        $maxInvoice = str_pad($maxInvoiceNo, 4, '0', STR_PAD_LEFT);

        return view('repairInvoice')

        ->with("TInvoiceSum", $TInvoiceSumData)
        ->with("TInvoiceDetail", $TInvoiceDetailsData)
        ->with("maxInvoiceNo", $maxInvoice);
    }

    public function get(Request $request)
    {
        $jobNo =$request->search_string;
        $data = JobSheet::where('Job_no', $jobNo)->get();
        if($data->count() != 0){
            // dd($data );
            return response()->json([
                'status'=>'success',
                'jobNo'=> $data,
            ]);
        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }

    public function create(Request $request){
        $request->validate([
            'invoice_no'=>'required | max:10 | unique:invoices',
            'job_no'=>'max:20 ',
            'invoice_date'=>'required',
            'customer_name'=>'max:80 ',
            'customer_phone'=>['required','max:10', 'regex:/^0\d{9,}$/'] ,
            'brand'=>'max:40',
            'device_model'=>'max:40 ',
            // 'imei_number'=>'max:40',
            'status'=>'max:40 ',
        ]);
        $invoice = new Invoice();
        $invoice->Job_no=$request->job_no;
        $invoice->Invoice_no=$request->invoice_no;
        $invoice->Invoice_date=$request->invoice_date;
        $invoice->Delivery_date=$request->completed_on;
        $invoice->Reported_date=$request->receipt_date;
        $invoice->Technician="";
        $invoice->Customer_NIC="";
        $invoice->Customer_Name=$request->customer_name;
        $invoice->Customer_Phone=$request->customer_phone;
        $invoice->Brand=$request->brand;
        $invoice->Device_Model=$request->device_model;
        $invoice->IMEI_Number=$request->imei_number;
        $invoice->Status='Complete';
        $invoice->Item="";
        $invoice->Problem="";
        $invoice->Amount=$request->amount;
        $invoice->Advance=$request->advance;
        $invoice->Balance=$request->balance;
        $invoice->Serial_Number="";
        $invoice->Password="";
        $invoice->Product_Configuration="";
        $invoice->Problem_Reported="";
        $invoice->Product_Condition="";
        $invoice->OC=$request->operator;
        $invoice->BC="";
        $invoice->save();

        $job_no = $request->job_no;
        JobSheet::where('Job_no', $job_no)->update([
            'Status'=>"Complete",
        ]);

        return response()->json([
            'status'=>'success',
            // 'telNo'=> $CusData,
        ]);
    }


    public function createInvoice(Request $request){
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

        $jobNo = $request->job_no;
        $jobsheetdata = JobSheet::where('Job_no', $jobNo)->first();
        if ($jobsheetdata) {
        $Problem = $jobsheetdata->Problem;
        $Technician = $jobsheetdata->Technician;

        $InvoiceSum = new TInvoiceSum;
        $InvoiceSum->Job_no = $request->job_no;
        $InvoiceSum->Invoice_no = $request->invoice_no;
        $InvoiceSum->Invoice_date = $request->invoice_date;
        $InvoiceSum->Delivery_date = $request->completed_on;
        $InvoiceSum->Reported_date = $request->receipt_date;
        $InvoiceSum->Technician = $request->technician;
        $InvoiceSum->Customer_NIC = $request->customer_nic;
        $InvoiceSum->Customer_Name = $request->customer_name;
        $InvoiceSum->Customer_Phone = $request->customer_phone;
        $InvoiceSum->Brand = $request->brand;
        $InvoiceSum->Device_Model = $request->device_model;
        $InvoiceSum->IMEI_Number = $request->imei_number;
        $InvoiceSum->Status = $request->status;
        $InvoiceSum->Amount = $request->total_amount;
        $InvoiceSum->Advance = $request->paid_advance;
        $InvoiceSum->Balance = $InvoiceSum->Amount - $InvoiceSum->Advance;
        $InvoiceSum->OC = $request->operator;
        $InvoiceSum->Problem = $Problem;
        $InvoiceSum->Technician = $Technician;
        $InvoiceSum->save();
        }
        foreach ($request -> inputs as $key=>$value){
        $InvoiceDetails = new TInvoiceDeils;
        $ItemMovementDetails = new TItemMovement;

        $InvoiceDetails->Job_no=$value['job_no'];
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
        $ItemMovementDetails->trans_code="SALES";
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
        $T_detailsdata = TInvoiceDeils::where('Invoice_no', $invoiceInput_no)->get();
        $T_sumdata = TInvoiceSum::where('Invoice_no', $invoiceInput_no)->get();

        // Generate the PDF content using a view
        $pdf = PDF::loadView('repairInvoicePrint', ['pawnSumData' => $T_sumdata , 'pawnDetailsData' => $T_detailsdata, 'companyData' => $companyData]);

        // Save the PDF to a temporary file
        $pdfPath = storage_path('../public/assets/pdf/Repair_Invoice.pdf');
        $pdf->save($pdfPath);
        $pdfUrl = asset('public/assets/pdf/Repair_Invoice.pdf');

        return back()
        ->with('done','The Invoice has been added')
        ->with("pdfLink", $pdfUrl);

    }



    public function indexInvoice(Request $request)
    {
        // get max invoice number max
        $maxInvoiceNo = TInvoiceSum::orderBy('Invoice_no', 'desc')->value('Invoice_no');
        $maxInvoice = str_pad($maxInvoiceNo, 4, '0', STR_PAD_LEFT);
        $companyData = Company::latest()->paginate(1);
        $itemCode = Item::all();
        $itemCategory = Category::all();

        return view('repairCreateInvoice')
        ->with("itemCategory" , $itemCategory)
        ->with("itemCode" , $itemCode)
        ->with("companyData" , $companyData)
        ->with("maxInvoiceNo", $maxInvoice);
    }



    // get and show items according to category
    public function setItemsCode(Request $request){
        $Item_category = $request->item_category;
        $data = Item::where('category',$Item_category)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }


     // get and show items according to category
     public function setItemDescription(Request $request){
        $Item_code = $request->Item_code;
        $data = Item::where('Item_code',$Item_code)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }


    public function show($id)
    {
        //
    }


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


    public function destroy(Request $request)
    {
        Invoice::find($request->invoice_id)->delete();
        return response()->json([
            'status'=>'success',
        ]);
    }
}
