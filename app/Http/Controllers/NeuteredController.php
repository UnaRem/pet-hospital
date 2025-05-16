<?php

namespace App\Http\Controllers;

use App\Models\Neutered;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NeuteredController extends Controller
{

    public function updateStatus(Request $request)
    {
        $post = $request->all();
        if (isset($post['id']) && isset($post['status'])) {
            $neutered = Neutered::find($post['id']);
            $neutered->status = $post['status'];
            $neutered->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
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
     * @param  \App\Models\Neutered  $neutered
     * @return \Illuminate\Http\Response
     */
    public function show(Neutered $neutered)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Neutered  $neutered
     * @return \Illuminate\Http\Response
     */
    public function edit(Neutered $neutered)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Neutered  $neutered
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Neutered $neutered)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Neutered  $neutered
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neutered $neutered)
    {
        //
    }
}
