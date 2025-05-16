<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MedicineController extends Controller
{

    public function AddMedicine(Request $request)
    {
        $medicine = new Medicine();
        $medicine->name = $request->name;
        $medicine->price = $request->price;
        $medicine->stock = $request->stock;
        $medicine->description = $request->description;
        if ($medicine->save()) {
            return response()->json([
                'success' => true,
                'medicine' => $medicine
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add medicine'
            ], 400);
        }
    }

    public function UpdateMedicine(Request $request)
    {
        $medicine = Medicine::find($request->medicineId);
        if ($medicine){
            $medicine->name = $request->name;
            $medicine->price = $request->price;
            $medicine->stock = $request->stock;
            $medicine->description = $request->description;
            $medicine->save();
            return response()->json([
                'success' => true,
                'medicine' => $medicine
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Medicine not found'
        ],200);
    }

    public function getMedicine($id)
    {
        $medicine = Medicine::find($id);
        if ($medicine){
            return response()->json([
                'success' => true,
                'medicine' => $medicine
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Medicine not found'
            ],200);
        }
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Medicine $medicine)
    {
        //
    }

    public function edit(Medicine $medicine)
    {
        //
    }

    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    public function destroy(Medicine $medicine)
    {
        //
    }
}
