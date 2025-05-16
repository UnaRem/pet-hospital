<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Cases;
use App\Models\Complaints;
use App\Models\Foster;
use App\Models\Groom;
use App\Models\Neutered;
use App\Models\Order;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class IndexController extends Controller
{

    public function index(){
        return view('index');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('index');
    }

    public function loginForm()
    {
        return view('loginForm');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user){
            return back()->withInput()->withErrors(['message' => '用户名不存在！']);
        }

        if ($request->password == $user->password) {
            session()->put('user', $user);
            return redirect()->route('index', ['tab'=>'profile']);
        } else {
            return back()->withInput()->withErrors(['message' => '用户名或密码错误！']);
        }
    }

    public function registerForm()
    {
        return view('registerForm');
    }

    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user){
            return back()->withInput()->withErrors(['message' => '用户名已存在！']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('UserLoginForm')->with('message', '注册成功！');
    }

    public function appointment(Request $request)
    {
        $pets = Pet::where('user_id', session('user')->id)->get();
        if ($pets){
            return view('appointment', ['pets' => $pets]);
        }
        return view('appointment', ['message' => '没有宠物，请先添加宠物！']);
    }

    public function appointmentAdd(Request $request)
    {
        $appointment = new Appointment();
        $appointment->pet_id = $request->pet_id;
        $appointment->type = $request->type;
        $appointment->time = $request->time;
        $appointment->status = '未接待';
        if ($appointment->save()){
            return redirect()->route('UserAllAppointment');
        }
        return redirect()->route('UserAppointment');
    }

    public function appointmentAll()
    {
        $appointments = Appointment::with('pet.user')
            ->whereHas('pet.user', function ($query) {
                $query->where('id', session('user')->id);
            })
            ->orderBy('time', 'desc')
            ->get();

        return view('appointments', ['appointments' => $appointments]);
    }

    public function groom(Request $request)
    {
        $pets = Pet::where('user_id', session('user')->id)->get();
        if ($pets){
            return view('groom', ['pets' => $pets]);
        }
        return view('groom', ['message' => '没有宠物，请先添加宠物！']);
    }

    public function groomAdd(Request $request)
    {
        $appointment = new Appointment();
        $appointment->pet_id = $request->pet_id;
        $appointment->type = '美容';
        $appointment->time = $request->time;
        $appointment->status = '未接待';

        if ($appointment->save()){
            return redirect()->route('UserAllAppointment');
        }
        return redirect()->route('UserGroom');
    }

    public function groomAll(Request $request)
    {
        $grooms = Groom::with('pet.user')
            ->whereHas('pet.user', function ($query) {
                $query->where('id', session('user')->id);
            })
            ->get();
        return view('grooms', ['grooms' => $grooms]);
    }

    public function neutered(Request $request)
    {
        $pets = Pet::where('user_id', session('user')->id)->get();
        if ($pets){
            return view('neutered', ['pets' => $pets]);
        }
        return view('neutered', ['message' => '没有宠物，请先添加宠物！']);
    }

    public function neuteredAdd(Request $request)
    {
        $appointment = new Appointment();
        $appointment->pet_id = $request->pet_id;
        $appointment->type = '绝育';
        $appointment->time = $request->time;
        $appointment->status = '未接待';

        if ($appointment->save()){
            return redirect()->route('UserAllAppointment');
        }
        return redirect()->route('UserNeutered');
    }

    public function neuteredAll(Request $request)
    {
        return view('neutereds');
    }

    public function foster(Request $request)
    {
        $pets = Pet::where('user_id', session('user')->id)->get();
        if ($pets){
            return view('foster', ['pets' => $pets]);
        }
        return view('foster', ['message' => '没有宠物，请先添加宠物！']);
    }

    public function fosterAdd(Request $request)
    {

        $appointment = new Appointment();
        $appointment->pet_id = $request->pet_id;
        $appointment->type = '寄养';
        $appointment->time = now();
        $appointment->status = '未接待';

        if ($appointment->save()){
            return redirect()->route('UserAllAppointment');
        }
        return redirect()->route('UserFoster');
    }

    public function fosterAll(Request $request)
    {
        return view('fosters');
    }

    public function orderAll(Request $request)
    {
        $orders = Order::with('user')
            ->whereHas('user', function ($query) {
                $query->where('id', session('user')->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('orders', ['orders' => $orders]);
    }

    public function petAll(Request $request)
    {
        $pets = Pet::with('user')
            ->whereHas('user', function ($query) {
                $query->where('id', session('user')->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pets', ['pets' => $pets]);
    }

    public function petAdd(Request $request)
    {
        $pet = new Pet();
        $pet->user_id = session('user')->id;
        $pet->name = $request->name;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->birth_date = $request->birth_date;
        if ($request->hasFile('avatar')) {
            $avatarName = Str::uuid()->toString() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('images/avatars', $avatarName, 'public');

            $pet->photo = $avatarName;
        }

        if ($pet->save()){
            return redirect()->route('UserAllPet');
        }
        return redirect()->route('UserPet');
    }

    public function pet(Request $request)
    {
        return view('pet');
    }

    public function petDelete(Request $request)
    {
        $pet = Pet::find($request->pet_id);
        if ($pet && $pet->user_id == session('user')->id && $pet->delete()){
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function caseAll(Request $request)
    {
        $cases = Cases::with('pet.user')
            ->whereHas('pet.user', function ($query) {
                $query->where('id', session('user')->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('cases', ['cases' => $cases]);
    }

    public function complaintAll(Request $request)
    {
        $complaints = Complaints::with('user')
            ->with('admin')
            ->whereHas('user', function ($query) {
                $query->where('id', session('user')->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('complaints', ['complaints' => $complaints]);
    }

    public function complaint()
    {
        $admins = Admin::all();
        return view('complaint', ['admins' => $admins]);
    }

    public function complaintAdd(Request $request)
    {
        $complaint = new Complaints();
        $complaint->user_id = session('user')->id;
        $complaint->admin_id = $request->admin_id;
        $complaint->type = $request->type;
        $complaint->content = $request->content;
        $complaint->time = $request->time;
        if ($complaint->save()){
            return redirect()->route('UserAllComplaint');
        }
        return redirect()->route('UserComplaint');
    }



}
