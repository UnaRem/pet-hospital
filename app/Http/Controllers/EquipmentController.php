<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EquipmentController extends Controller
{

    public function AddEquipment(Request $request)
    {
        $equipment = new Equipment();
        $equipment->name = $request->name;
        $equipment->price = $request->price;
        $equipment->stock = $request->stock;
        $equipment->description = $request->description;
        if ($equipment->save()) {
            return response()->json([
                'success' => true,
                'equipment' => $equipment
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add equipment'
            ], 400);
        }
    }

    public function UpdateEquipment(Request $request)
    {
        $equipment = Equipment::find($request->equipmentId);
        if ($equipment){
            $equipment->name = $request->name;
            $equipment->price = $request->price;
            $equipment->stock = $request->stock;
            $equipment->description = $request->description;
            $equipment->save();
            return response()->json([
                'success' => true,
                'equipment' => $equipment
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Equipment not found'
        ],200);
    }

    public function getEquipment($id)
    {
        $equipment = Equipment::find($id);
        if ($equipment){
            return response()->json([
                'success' => true,
                'equipment' => $equipment
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Equipment not found'
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
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}
