<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Datatables;

class ItemController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Item::select('*'))
            ->addColumn('action', 'Item-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $CategoryDetails = Category::all();
        return view('Item')
        -> with("Category", $CategoryDetails);
    }

    public function mainstore(Request $request)
    {

        $ItemId = $request->id;

        $Item  =   Item::updateOrCreate(
                    [
                     'id' => $ItemId
                    ],
                    [
                    'category' => $request->category,
                    'Item_code' => $request->Item_code,
                    'Item_description' => $request->Item_description,
                    'purchasePrice' => $request->purchasePrice,
                    'saleprice' => $request->saleprice,
                    'alert_quantity' => $request->alert_quantity,

                    ]);
        return Response()->json($Item);
    }

    public function mainedit(Request $request)
    {
        $where = array('id' => $request->id);
        $Item  = Item::where($where)->first();

        return Response()->json($Item);
    }

    public function maindestroy(Request $request)
    {
        $Item = Item::where('id',$request->id)->delete();

        return Response()->json($Item);
    }

    public function get(Request $request)
    {
        $nic =$request->search_string;
        $data = Item::where('Item_code', $Item_code)->get();
        $data = Item::where('Item_code', 'like', $request->search_string.'%');
        if($data->count()!=null){
            dd($data );
            return view('Item_search')->with("Item_get", $data)->render();
        }else{
            return response()->json([
                'status'=>'not_found'
            ]);
        }
    }


}
