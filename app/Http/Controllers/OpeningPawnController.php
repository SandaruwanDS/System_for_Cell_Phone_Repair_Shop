<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\itemCondition;
use App\Models\karatage;
use App\Models\Recei_Add;
use App\Models\Category;
use App\Models\Customer;
use App\Models\TPawnDetails;
use App\Models\TPawnSum;
use App\Models\itemSetup;
use App\Models\TOpeningPawnSum;
use App\Models\TOpeningPawnDetails;

class OpeningPawnController extends Controller
{

    public function index()
    {
        $itemCondition = itemCondition::all();
        $itemSetup = itemSetup::all();
        $karatageData = karatage::all();
        $receiptType = Recei_Add::all();
        $itemCategory = Category::all();
        $maxReceiptNo = TOpeningPawnSum::orderBy('Receipt_Number', 'desc')->value('Receipt_Number');
        $maxReceiptNos = str_pad($maxReceiptNo, 4, '0', STR_PAD_LEFT);

        // get customer code max
        $maxCustomerCode = Customer::orderBy('Code', 'desc')->value('Code');
        $maxCustomerCodes = str_pad($maxCustomerCode, 4, '0', STR_PAD_LEFT);

        // $maxReceiptNo = Receipt::max('Receipt_Number');
        return view('OpeningPawnReceipt')
        ->with("itemCondition" , $itemCondition)
        ->with("itemSetup" , $itemSetup)
        ->with("receiptType" , $receiptType)
        ->with("itemCategory" , $itemCategory)
        ->with("itemKaratage", $karatageData)
        ->with("maxCustomer", $maxCustomerCodes)
        ->with("maxReceipt", $maxReceiptNos);
    }


    public function storePawnSum(Request $request){
        $request->validate([
            'customer_nic' => ' required',
            //'customer_name' => ' required',
            //'customer_address' => ' required',
           // 'customer_contact_1' => ' required',
            'receipt_type' => ' required',
            'receipt_no' => ' required',
            'receipt_date' => ' required',
            'amount' => ' required',
            'total_amount' => ' required',
            // 'oc' => ' required',
            // 'bc' => ' required'
            'inputs.*.category' => ' required',
            'inputs.*.articles' => ' required',
            'inputs.*.condition' => ' required',
            'inputs.*.karatage' => ' required',
            'inputs.*.weight' => ' required',
            'inputs.*.qty' => ' required',
            'inputs.*.value' => ' required'
        ],[
            'customer_nic' => ' The NIC field is required',
           // 'customer_name' => ' The Name field is required',
            //'customer_address' => ' The Address field is required',
            //'customer_contact_1' => ' The Contact field is required',
            'receipt_type' => ' The Receipt type field is required',
            'receipt_no' => ' The Receipt No field is required',
            'receipt_date' => ' The Date field is required',
            'amount' => ' The Amount field is required',
            'total_amount' => 'The Total Amount field is required',
            // 'oc' => ' The Operator field is required',
            // 'bc' => ' The Branch field is required'
        ]);

        $PawnSum = new TOpeningPawnSum;
        $PawnSum->Customer_NIC = $request->customer_nic;
        $PawnSum->Customer_Name = $request->customer_name;
        $PawnSum->Customer_Address = $request->customer_address;
        $PawnSum->Customer_Phone = $request->customer_contact_1;
        $PawnSum->Receipt_Type = $request->receipt_type;
        $PawnSum->Receipt_Number = $request->receipt_no;
        $PawnSum->Invoice_Number = $request->invoice_no;
        $PawnSum->Receipt_Date = $request->receipt_date;
        $PawnSum->Amount = $request->amount;
        $PawnSum->Total_Amount = $request->total_amount;
        $PawnSum->Interest = $request->interest;
        $PawnSum->IsRedeemed = 0;
        $PawnSum->OC = $request->oc;
        $PawnSum->BC = $request->bc;
        $PawnSum->save();

        foreach ($request -> inputs as $key=>$value){
        $PawnDetails = new TOpeningPawnDetails;
        $PawnDetails->Receipt_Number=$value['receipt_no'];
        $PawnDetails->Receipt_Type=$value['receipt_type'];
        $PawnDetails->Date=$value['receipt_date'];
        $PawnDetails->Category=$value['category'];
        $PawnDetails->Articles=$value['articles'];
        $PawnDetails->Condition=$value['condition'];
        $PawnDetails->Karatage=$value['karatage'];
        $PawnDetails->Weight=$value['weight'];
        $PawnDetails->Total_Weight=$value['total_weight'];
        $PawnDetails->QTY=$value['qty'];
        $PawnDetails->Value=$value['value'];
        $PawnDetails->save();
        }

        $receiptInput_no = $request->receipt_no;
        $T_detailsdata = TOpeningPawnDetails::where('Receipt_Number', $receiptInput_no)->get();
        $T_sumdata = TOpeningPawnSum::where('Receipt_Number', $receiptInput_no)->get();


        // Generate the PDF content using a view
        $pdf = PDF::loadView('pawnReceiptPrint', ['pawnSumData' => $T_sumdata , 'pawnDetailsData' => $T_detailsdata]);

        // Save the PDF to a temporary file
        $pdfPath = storage_path('../public/assets/pdf/pawn_receipt.pdf');
        $pdf->save($pdfPath);

        $pdfUrl = asset('assets/pdf/pawn_receipt.pdf');

        // Return the PDF as a download
        // return $pdf->stream();

        return back()
        ->with('done','The receipt has been added')
        ->with("pdfLink", $pdfUrl);

        // return $pdf->download('report.pdf');

    }


    public function printReceipt(Request $request){
        $receiptInput_no = $request->receipt_no;
        $T_detailsdata = TOpeningPawnDetails::where('Receipt_Number', $receiptInput_no)->get();
        $T_sumdata = TOpeningPawnSum::where('Receipt_Number', $receiptInput_no)->get();


        // Generate the PDF content using a view
        $pdf = PDF::loadView('pawnReceiptPrint', ['pawnSumData' => $T_sumdata , 'pawnDetailsData' => $T_detailsdata]);

        // Save the PDF to a temporary file
        // $pdfPath = storage_path('app/temp/pawn_receipt.pdf');
        $pdfPath = storage_path('../public/assets/pdf/pawn_receipt.pdf');
        $pdf->save($pdfPath);

        // $pdfUrl = Storage::url('app/temp/pawn_receipt.pdf');
        $pdfUrl = asset('assets/pdf/pawn_receipt.pdf');
        // return $pdf->stream();

        // return $pdfPath;

        return response()->json([
            'status' => 'success',
            'pdf_url' => $pdfUrl
        ]);
    }


    // get customer using receipt number
    public function getCustomerReceiptNo(Request $request){
        $receiptNo = $request->search_receipt_no;
        $data = TOpeningPawnSum::where('Receipt_Number',$receiptNo)->get();

        if($data->count() != null){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
            return view('pawning_search_customer_using_receipt_no')->with("customer_get", $data)->render();
        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }


    public function search(Request $request){
        $receiptNo = $request->search_receipt_no;
        $data = TOpeningPawnDetails::where('Receipt_Number',$receiptNo)->get();
        $itemCondition = itemCondition::all();
        $itemSetup = itemSetup::all();
        $karatageData = karatage::all();
        $receiptType = Recei_Add::all();
        $itemCategory = Category::all();

        if($data->count() != null){
            return view('pawning_get_receipt')
            ->with("itemCondition" , $itemCondition)
            ->with("itemSetup" , $itemSetup)
            ->with("itemKaratage", $karatageData)
            ->with("receiptType" , $receiptType)
            ->with("itemCategory" , $itemCategory)
            ->with('receiptData', $data);
        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }

    public function getArticleDetails(Request $request){
        $receiptNo = $request->search_receipt_no;
        $data = TOpeningPawnDetails::where('Receipt_Number',$receiptNo)->get();
        if($data->count() != null){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);

        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

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
