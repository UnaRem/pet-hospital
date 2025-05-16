<?php

namespace App\Http\Controllers;

use App\Models\Foster;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FosterController extends Controller
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
     * @param  \App\Models\Foster  $foster
     * @return \Illuminate\Http\Response
     */
    public function show(Foster $foster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foster  $foster
     * @return \Illuminate\Http\Response
     */
    public function edit(Foster $foster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foster  $foster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foster $foster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foster  $foster
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foster $foster)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        $post = $request->all();
        if (isset($post['id']) && isset($post['status'])) {
            $foster = Foster::find($post['id']);
            $foster->status = $post['status'];
            $foster->end_date = now();
            $foster->save();
            return response()->json(['success' => 1]);
        } else {
            return response()->json(['success' => 0]);
        }
    }
}
