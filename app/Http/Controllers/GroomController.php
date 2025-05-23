<?php

namespace App\Http\Controllers;

use App\Models\Groom;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GroomController extends Controller
{
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
     * @param  \App\Models\Groom  $groom
     * @return \Illuminate\Http\Response
     */
    public function show(Groom $groom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Groom  $groom
     * @return \Illuminate\Http\Response
     */
    public function edit(Groom $groom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Groom  $groom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Groom $groom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Groom  $groom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Groom $groom)
    {
        //
    }


    public function updateStatus(Request $request)
    {
        $post = $request->all();
        if (isset($post['id']) && isset($post['status'])) {
            $groom = Groom::find($post['id']);
            $groom->status = $post['status'];
            $groom->save();
            return response()->json(['success' => 1]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

}
