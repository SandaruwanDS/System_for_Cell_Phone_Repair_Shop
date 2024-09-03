<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karatage;

class KaratagerateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karatageData = karatage::latest()->paginate(5);
        return view('Karatagerate')->with("karatageData", $karatageData);
    }


    function add_karatage(Request $request){

        $request->validate([
            'descrption'=>'required | max:50 ',
            'pawningrate'=>'required | max:7 ',
            'assesrate'=>'required | max:7',
            'marketrate'=>'required | max:7',
        ]);

        $karatage = new karatage;
        $karatage->descrption = $request->descrption;
        $karatage->pawningrate = $request->pawningrate;
        $karatage->assesrate = $request->assesrate;
        $karatage->marketrate = $request->marketrate;
        $karatage->save();
        return redirect()->back()->with("karatage" , $karatage)->with("added", "Karatage Added");
    }

    // ------------- Create karatage using Ajex-------------
    public function create(Request $request){
        $request->validate([
            'descrption'=>'required | max:50 ',
            'pawningrate'=>'required | max:7 ',
            'assesrate'=>'required | max:7',
            'marketrate'=>'required | max:7',
        ]);

        $karatage = new karatage;
        $karatage->descrption = $request->descrption;
        $karatage->pawningrate = $request->pawningrate;
        $karatage->assesrate = $request->assesrate;
        $karatage->marketrate = $request->marketrate;
        $karatage->save();

        return response()->json([
            'status'=>'success',
        ]);
    }

    // ------------- delete karatage using Ajex-------------
    public function delete(Request $request)
    {
        karatage::find($request->karatage_id)->delete();
        return response()->json([
            'status'=>'success',
        ]);
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


    public function update(Request $request)
    {
        $request->validate([
            'up_descrption'=>'required | max:50 ',
            'up_pawningrate'=>'required | max:7 ',
            'up_assesrate'=>'required | max:7',
            'up_marketrate'=>'required | max:7',
        ]);

        karatage::where('id',$request->up_id)->update([
            'descrption'=>$request->up_descrption,
            'pawningrate'=>$request->up_pawningrate,
            'assesrate'=>$request->up_assesrate,
            'marketrate'=>$request->up_marketrate,
        ]);

        return response()->json([
            'status'=>'success',
        ]);
    }


    public function destroy($id)
    {
        $data = karatage::find($id);
        $data->delete();
        return redirect()->back()->with("delete", "Receipt deleted");
    }
}
