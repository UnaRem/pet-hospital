<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ComplaintsController extends Controller
{

    public function getComplaint($id)
    {
        $complaint = Complaints::find($id);
        if ($complaint){
            return response()->json([
                'success' => true,
                'complaint' => $complaint
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Complaint not found'
            ],200);
        }
    }

    public function updateComplaint(Request $request)
    {
        $complaint = Complaints::find($request->id);
        if ($complaint){
            $complaint->status = '处理结束';
            $complaint->save();
            return response()->json([
                'success' => true,
                'complaint' => $complaint
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Complaint not found'
        ],200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function show(Complaints $complaints)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaints $complaints)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaints $complaints)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaints  $complaints
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaints $complaints)
    {
        //
    }
}
