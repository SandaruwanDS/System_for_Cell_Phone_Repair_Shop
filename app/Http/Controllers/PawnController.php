<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use PDF;
// use Barryvdh\DomPDF\Facade as PDF;
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

class PawnController extends Controller
{

    public function showPawnReceipt(){
        $itemCondition = itemCondition::all();
        $itemSetup = itemSetup::all();
        $karatageData = karatage::all();
        $receiptType = Recei_Add::all();
        $itemCategory = Category::all();
        $maxReceiptNo = TPawnSum::orderBy('Receipt_Number', 'desc')->value('Receipt_Number');
        $maxReceiptNos = str_pad($maxReceiptNo, 4, '0', STR_PAD_LEFT);

        // get customer code max
        $maxCustomerCode = Customer::orderBy('Code', 'desc')->value('Code');
        $maxCustomerCodes = str_pad($maxCustomerCode, 4, '0', STR_PAD_LEFT);

// $maxReceiptNo = Receipt::max('Receipt_Number');
        return view('pawnReceipt')
        ->with("itemCondition" , $itemCondition)
        ->with("itemSetup" , $itemSetup)
        ->with("receiptType" , $receiptType)
        ->with("itemCategory" , $itemCategory)
        ->with("itemKaratage", $karatageData)
        ->with("maxCustomer", $maxCustomerCodes)
        ->with("maxReceipt", $maxReceiptNos);
       }

    public function showRedeemReceipt(){
        return view('RedeemReceipt');
    }




    public function storePawnSum(Request $request){
        $request->validate([
            'customer_nic' => ' required',
            'customer_name' => ' required',
            'customer_address' => ' required',
            'customer_contact_1' => ' required',
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
            'customer_name' => ' The Name field is required',
            'customer_address' => ' The Address field is required',
            'customer_contact_1' => ' The Contact field is required',
            'receipt_type' => ' The Receipt type field is required',
            'receipt_no' => ' The Receipt No field is required',
            'receipt_date' => ' The Date field is required',
            'amount' => ' The Amount field is required',
            'total_amount' => 'The Total Amount field is required',
            // 'oc' => ' The Operator field is required',
            // 'bc' => ' The Branch field is required'
        ]);

        $PawnSum = new TPawnSum;
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
        $PawnDetails = new TPawnDetails;
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
        $T_detailsdata = TPawnDetails::where('Receipt_Number', $receiptInput_no)->get();
        $T_sumdata = TPawnSum::where('Receipt_Number', $receiptInput_no)->get();

        // Generate the PDF content using a view
        $pdf = PDF::loadView('pawnReceiptPrint', ['pawnSumData' => $T_sumdata , 'pawnDetailsData' => $T_detailsdata]);

        // Save the PDF to a temporary file
        // $pdfPath = storage_path('../public/assets/pdf/Pawn_receipt.pdf');
        $pdfPath = storage_path('../pdf/Pawn_receipt.pdf');
        $pdf->save($pdfPath);

        // $pdfUrl = asset('../pdf/Pawn_receipt.pdf');

        $pdfUrl = attach('pdf/Pawn_receipt.pdf');


        // Return the PDF as a download
        // return $pdf->stream();

        return back()
        ->with('done','The receipt has been added')
        ->with("pdfLink", $pdfUrl);

    }

    public function printReceipt(Request $request){
        $receiptInput_no = $request->receipt_no;
        $T_detailsdata = TPawnDetails::where('Receipt_Number', $receiptInput_no)->get();
        $T_sumdata = TPawnSum::where('Receipt_Number', $receiptInput_no)->get();

        // Generate the PDF content using a view
        $pdf = PDF::loadView('pawnReceiptPrint', ['pawnSumData' => $T_sumdata , 'pawnDetailsData' => $T_detailsdata]);

        // Save the PDF to a temporary file
        $pdfPath = storage_path('../public/assets/pdf/Pawn_receipt.pdf');
        $pdf->save($pdfPath);

        $pdfUrl = asset('assets/pdf/Pawn_receipt.pdf');

        return response()->json([
            'status' => 'success',
            'pdf_url' => $pdfUrl
        ]);
    }


    // get customer Using NIC
    public function get(Request $request){
        $nic =$request->search_string;
        $data = Customer::where('NIC', $nic)->get();
        // $data = Customer::where('NIC', 'like', $request->search_string.'%');
        if($data->count()!=null){
            // dd($data );
            return view('pawning_search_customer')->with("customer_get", $data)->render();
        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }

    // get customer using receipt number
    public function getCustomerReceiptNo(Request $request){
        $receiptNo = $request->search_receipt_no;
        $data = TPawnSum::where('Receipt_Number',$receiptNo)->get();

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
        $data = TPawnDetails::where('Receipt_Number',$receiptNo)->get();

        $itemCondition = itemCondition::all();
        $itemSetup = itemSetup::all();
        $karatageData = karatage::all();
        $receiptType = Recei_Add::all();
        $itemCategory = Category::all();
        // dd($data);
        if($data->count() != null){
            // $cus_nic = $data->first()->Customer_NIC;
            // $cus_data = Customer::where('NIC', $cus_nic)->get();

            // $receipt_typ = $data->first()->Receipt_Type;
            // $receipt_data = Recei_Add::where('receiptname', $receipt_typ)->get();


            return view('pawning_get_receipt')
            // ->with('customerData', $cus_data)
            // ->with('receiptTypeData', $receipt_data)
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
        $data = TPawnDetails::where('Receipt_Number',$receiptNo)->get();
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


    public function  deleteReceipt(Request $request){
        $receiptNo = $request->receipt_no;
        $userName = $request->user_name;

        if($userName == "admin"){
            TPawnDetails::where('Receipt_Number',$receiptNo)->delete();
            TPawnSum::where('Receipt_Number',$receiptNo)->delete();
            // TPawnDetails::find($receiptNo)->delete();
            // TPawnSum::find($receiptNo)->delete();
            return response()->json([
                'status'=>'success',
            ]);

        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }


    public function customerHistoryDetails(Request $request){
        $customerNic = $request->search_string;
        $data = TPawnSum::where('Customer_NIC',$customerNic)->get();
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


}
