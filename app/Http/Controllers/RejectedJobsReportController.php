<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobSheet;

class RejectedJobsReportController extends Controller
{

    public function index(Request $request){
        // Get search criteria from the form input
        $fromDate  = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = JobSheet::whereBetween('Date', [$fromDate, $toDate])->get();

        // Construct a query to filter records based on search criteria
        $query = JobSheet::query();

        if ($fromDate && $toDate) {
            $query = JobSheet::whereBetween('Date', [$fromDate, $toDate])
            ->where('Status', 'Reject')
            ->get();
        }

        return view('rejectedJobReport')
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
