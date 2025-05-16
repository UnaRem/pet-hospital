<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class PetController extends Controller
{

    public function getPet($id)
    {
        $pet = Pet::find($id);
        if ($pet) {
            return response()->json($pet);
        } else {
            return response()->json(['error' => '宠物不存在'], 404);
        }
    }

    public function updatePet(Request $request)
    {
        $data = $request->only(['name', 'species', 'breed', 'birth_date']);
        $pet = Pet::find($request->petId);
        if ($pet) {
            $pet->fill($data);

            if ($request->hasFile('photo')) {
                $avatarName = Str::uuid()->toString() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->storeAs('images/pets', $avatarName, 'public');

                $pet->photo = $avatarName;
            }
            $pet->save();
            return response()->json(['success' => '1']);
        } else {
            return response()->json(['error' =>'宠物不存在'], 404);
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
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }

}
