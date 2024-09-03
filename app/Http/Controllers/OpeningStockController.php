<?php

namespace App\Http\Controllers;
use PDF;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\JobSheet;
use App\Models\Item;
use App\Models\Category;
use App\Models\TOpeningSum;
use App\Models\TOpeningDetails;
use App\Models\TItemMovement;


class OpeningStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // get max invoice number max
        $maxInvoiceNo = TOpeningSum::orderBy('Invoice_no', 'desc')->value('Invoice_no');
        $maxInvoice = str_pad($maxInvoiceNo, 4, '0', STR_PAD_LEFT);

        $companyCode = Company::all();
        $itemCode = Item::all();
        $itemCategory = Category::all();

        return view('openingStock')
        ->with("itemCategory" , $itemCategory)
        ->with("itemCode" , $itemCode)
        ->with("companyData" , $companyCode)
        ->with("maxInvoiceNo", $maxInvoice);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $request->validate([

            'inputs.*.invoice_no' => ' required',
            'inputs.*.invoice_date' => ' required',
            'inputs.*.item_category' => ' required',
            'inputs.*.item_code' => ' required',
            'inputs.*.item_description' => ' required',
            'inputs.*.qty' => ' required',
            'inputs.*.unit_price' => ' required',
            'inputs.*.net_value' => ' required'
        ],[
            'inputs.*.invoice_no' => ' The Invoice No field is required',
            'inputs.*.invoice_date' => ' The Invoice Date field is required',
            'inputs.*.item_category' => ' The Item Category field is required',
            'inputs.*.item_code' => ' The Item Code field is required',
            'inputs.*.item_description' => ' The Item Description field is required',
            'inputs.*.qty' => ' The QTY field is required',
            'inputs.*.unit_price' => ' The Unit Price field is required',
            'inputs.*.net_value' => ' The Net Value field is required'
        ]);

        $InvoiceSum = new TOpeningSum;
        // $InvoiceSum->Job_no = $request->job_no;
        $InvoiceSum->Invoice_no = $request->invoice_no;
        $InvoiceSum->Invoice_date = $request->invoice_date;
        // $InvoiceSum->Delivery_date = $request->completed_on;
        // $InvoiceSum->Reported_date = $request->receipt_date;
        // $InvoiceSum->Technician = $request->technician;
        // $InvoiceSum->Customer_NIC = $request->customer_nic;
        // $InvoiceSum->Customer_Name = $request->customer_name;
        // $InvoiceSum->Customer_Phone = $request->customer_phone;
        // $InvoiceSum->Brand = $request->brand;
        // $InvoiceSum->Device_Model = $request->device_model;
        // $InvoiceSum->IMEI_Number = $request->imei_number;
        // $InvoiceSum->Status = $request->status;
        $InvoiceSum->Amount = $request->total_amount;
        // $InvoiceSum->Advance = $request->paid_amount;
        // $InvoiceSum->Balance = $InvoiceSum->Amount - $InvoiceSum->Advance;
        $InvoiceSum->OC = $request->operator;

        // $InvoiceSum->Item = $request->bc;
        // $InvoiceSum->Problem = $request->oc;
        // $InvoiceSum->Serial_Number = $request->oc;
        // $InvoiceSum->Password = $request->bc;
        // $InvoiceSum->Product_Configuration = $request->oc;
        // $InvoiceSum->Problem_Reported = $request->oc;
        // $InvoiceSum->Product_Condition = $request->bc;

        $InvoiceSum->BC = $request->bc;
        $InvoiceSum->save();

        foreach ($request -> inputs as $key=>$value){
        $InvoiceDetails = new TOpeningDetails;
        $ItemMovementDetails = new TItemMovement;
        // $InvoiceDetails->Job_no=$value['job_no'];
        $InvoiceDetails->Invoice_no=$value['invoice_no'];
        $InvoiceDetails->Invoice_date=$value['invoice_date'];
        $InvoiceDetails->Item_category=$value['item_category'];
        $InvoiceDetails->Item_code=$value['item_code'];
        $InvoiceDetails->Item_description=$value['item_description'];
        $InvoiceDetails->QTY=$value['qty'];
        $InvoiceDetails->Unit_price=$value['unit_price'];
        $InvoiceDetails->Net_value=$value['net_value'];
        $InvoiceDetails->OC=$value['operator'];
        $InvoiceDetails->save();

        $ItemMovementDetails->trans_no=$value['invoice_no'];
        $ItemMovementDetails->dDate=$value['invoice_date'];
        $ItemMovementDetails->trans_code="OP_STOCK";
        $ItemMovementDetails->item_code=$value['item_code'];
        $ItemMovementDetails->qun_in=$value['qty'];
        $ItemMovementDetails->bc=$value['bc'];
        $ItemMovementDetails->save();
        }

        $companyData = Company::latest()->paginate(1);

        $invoiceInput_no = $request->invoice_no;
        $T_detailsdata = TOpeningDetails::where('Invoice_no', $invoiceInput_no)->get();
        $T_sumdata = TOpeningSum::where('Invoice_no', $invoiceInput_no)->get();

        // Generate the PDF content using a view
        // $pdf = PDF::loadView('repairInvoicePrint', ['pawnSumData' => $T_sumdata , 'pawnDetailsData' => $T_detailsdata, 'companyData' => $companyData]);

        // Save the PDF to a temporary file
        // $pdfPath = storage_path('../public/assets/pdf/Repair_Invoice.pdf');
        // $pdfPath = storage_path('../pdf/Repair_Invoice.pdf');
        // $pdf->save($pdfPath);

        // $pdfUrl = attach('pdf/Repair_Invoice.pdf');
        // $pdfUrl = asset('assets/pdf/Repair_Invoice.pdf');

        return back()
        ->with('done','The Stock has been added');
        // ->with("pdfLink", $pdfUrl);

    }

    // get and show items according to category
    public function setItemsCode(Request $request){
        $Item_category = $request->category;
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


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
