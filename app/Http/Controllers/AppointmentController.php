<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Foster;
use App\Models\Groom;
use App\Models\Neutered;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AppointmentController extends Controller
{

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

    public function show(Appointment $appointment)
    {
        //
    }

    public function edit(Appointment $appointment)
    {
        //
    }

    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    public function destroy(Appointment $appointment)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        $post = $request->all();
        if (isset($post['id']) && isset($post['status'])) {
            $appointment = Appointment::find($post['id']);
            $appointment->status = $post['status'];
            $save = false;
            if($post['status'] == '已接待'){

                switch ($appointment->type) {
                    case '寄养':
                        $foster = new Foster();
                        $foster->pet_id = $appointment->pet_id;
                        $foster->start_date = $appointment->time;
                        $foster->status = '未完成';
                        $save = $foster->save();
                        break;
                    case '绝育':
                        $neutered = new Neutered();
                        $neutered->pet_id = $appointment->pet_id;
                        $neutered->time = $appointment->time;
                        $neutered->status = '未完成';
                        $save = $neutered->save();
                        break;
                    case '美容':
                        $groom = new Groom();
                        $groom->pet_id = $appointment->pet_id;
                        $groom->time = $appointment->time;
                        $groom->status = '未完成';
                        $save = $groom->save();
                        break;
                }
            }else{
                $save = true;
            }

            if ($appointment->save() &&  $save){
                return response()->json(['success' => 1]);
            }else{
                return response()->json(['success' => 0]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }
}
