<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AccidentController extends Controller
{

    public function getAccident($id)
    {
        $accident = Accident::find($id);
        if ($accident){
            return response()->json([
                'success' => true,
                'accident' => $accident
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Accident not found'
            ],200);
        }
    }

    public function updateAccident(Request $request)
    {
        $accident = Accident::find($request->id);
        if ($accident){
            $accident->status = '处理结束';
            $accident->save();
            return response()->json([
                'success' => true,
                'accident' => $accident
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Accident not found'
        ],200);
    }

    public function AddAccident(Request $request)
    {
        $accident = new Accident();
        $accident->pet_id = $request->pet_id;
        $accident->admin_id = $request->admin_id;
        $accident->type = $request->type;
        $accident->description = $request->description;
        $accident->status = '处理中';
        $accident->time = now();
        if ($accident->save()){
            return response()->json([
                'success' => true,
                'accident' => $accident
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => '事故创建失败'
            ],200);
        }
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
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function show(Accident $accident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function edit(Accident $accident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accident $accident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accident $accident)
    {
        //
    }
}
