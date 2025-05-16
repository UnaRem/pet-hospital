<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Cases;
use App\Models\Complaints;
use App\Models\Equipment;
use App\Models\Foster;
use App\Models\Groom;
use App\Models\Medicine;
use App\Models\Neutered;
use App\Models\Order;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Admin $admin)
    {
        //
    }


    public function edit(Admin $admin)
    {
        //
    }


    public function update(Request $request, Admin $admin)
    {
        //
    }


    public function destroy(Admin $admin)
    {
        //
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function appointments(Request $request)
    {
        $request->session()->put('side_tag', "appointments");
        // 查询并按时间排序获取预约数据，并关联pets和users表
        $appointments = Appointment::orderBy('updated_at', 'desc')
            ->with(['pet.user']) // 使用 with 方法关联 pets 和 users 表
            ->paginate(12);
        return view('admin.appointments', ['appointments' => $appointments]);
    }

    public function cases(Request $request)
    {
        $request->session()->put('side_tag', "cases");
        $cases = Cases::orderBy('created_at', 'desc')
            ->with(['pet.user'])
            ->paginate(12);
        $pets = Pet::with('user')->get();
        return view('admin.cases', ['cases' => $cases, 'pets' => $pets]);
    }

    public function fosters(Request $request)
    {
        $request->session()->put('side_tag', "fosters");
        $fosters = Foster::orderBy('created_at', 'desc')
            ->with(['pet.user'])
            ->paginate(15);
        return view('admin.fosters', ['fosters' => $fosters]);
    }

    public function medicines(Request $request, $searchKey = null)
    {
        $request->session()->put('side_tag', "medicines");

        if ($searchKey && $searchKey != "") {
            $medicines = Medicine::where('name', 'like', '%' . $searchKey . '%')
                ->orderBy('updated_at', 'desc')
                ->paginate(12);
        } else {
            $medicines = Medicine::orderBy('updated_at', 'desc')
                ->paginate(12);
        }

        return view('admin.medicines', ['medicines' => $medicines]);
    }

    public function equipments(Request $request, $searchKey = null)
    {
        $request->session()->put('side_tag', "equipments");

        if ($searchKey && $searchKey != "") {
            $equipments = Equipment::where('name', 'like', '%' . $searchKey . '%')
                ->orderBy('updated_at', 'desc')
                ->paginate(12);
        } else {
            $equipments = Equipment::orderBy('updated_at', 'desc')
                ->paginate(12);
        }
        return view('admin.equipments', ['equipments' => $equipments]);
    }

    public function orders(Request $request, $searchKey = null)
    {
        $request->session()->put('side_tag', "orders");

        if ($searchKey && $searchKey != "") {
            $orders = Order::where('name', 'like', '%' . $searchKey . '%')
                ->orderBy('updated_at', 'desc')
                ->paginate(12);
        } else {
            $orders = Order::orderBy('created_at', 'desc')
                ->paginate(12);
        }
        $users = User::all();
        return view('admin.orders', ['orders' => $orders, 'users' => $users]);
    }

    public function admins(Request $request)
    {
        $request->session()->put('side_tag', "admins");
        $admins = Admin::orderBy('name')
            ->paginate(12);
        return view('admin.admins', ['admins' => $admins]);
    }

    public function pets(Request $request)
    {
        $request->session()->put('side_tag', "pets");
        $pets = Pet::orderBy('name')
            ->with('user')
            ->paginate(14);
        return view('admin.pets', ['pets' => $pets]);
    }

    public function users(Request $request)
    {
        $request->session()->put('side_tag', "users");
        $users = User::orderBy('name')
            ->paginate(10);
        return view('admin.users', ['users' => $users]);
    }

    public function grooms(Request $request)
    {
        $request->session()->put('side_tag', "grooms");
        $grooms = Groom::orderBy('created_at', 'desc')
            ->paginate(12);
        return view('admin.grooms', ['grooms' => $grooms]);
    }

    public function neutered(Request $request)
    {
        $request->session()->put('side_tag', "neutered");
        $neutered = Neutered::orderBy('created_at', 'desc')
            ->paginate(12);
        return view('admin.neutered', ['neutereds' => $neutered]);
    }

    public function accidents(Request $request)
    {
        $request->session()->put('side_tag', "accidents");
        $accidents = Accident::orderBy('created_at', 'desc')
            ->paginate(12);
        $admins = Admin::all();
        $pets = Pet::with('user')
        ->get();
        return view('admin.accidents', ['accidents' => $accidents, 'admins' => $admins, 'pets' => $pets]);
    }

    public function complaints(Request $request)
    {
        $request->session()->put('side_tag', "complaints");
        $complaints = Complaints::orderBy('created_at', 'desc')
            ->paginate(12);
        return view('admin.complaints', ['complaints' => $complaints]);
    }

    public function login(Request $request)
    {
        $user = DB::table('admins')->where('email', $request->email)->first();
        if ($user && $request->password == $user->password) {
            session()->put('admin', $user);
            return redirect()->route('AdminDashboard');
        } else {
            return back()->withInput()->withErrors(['loginError' => '登录失败']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('AdminLoginForm');
    }

    public function dashboard(Request $request)
    {
        $data = $this->adminDashboard($request);
//        switch (session('admin')->role){
//            case '0':
//                $data = $this->adminDashboard($request);
//                break;
//            case '1':
//                $data = $this->adminDashboard($request);
//                break;
//            case '2':
//                $data = $this->adminDashboard($request);
//                break;
//            case '3':
//                $data = $this->adminDashboard($request);
//                break;
//            default:
//                $data = $this->logout($request);
//                break;
//        }
        $request->session()->put('side_tag', "dashboard");
        return view('admin.dashboard', $data);
    }

    public function adminDashboard(Request $request)
    {
        // 日期
        $previousDay = now()->subDay()->toDateString();
        $today = now()->toDateString();

        // 前一天的订单
        $pre_orders = Order::whereDate('created_at', $previousDay)
            ->where('status', '已支付')
            ->get();

        // 当天的订单
        $today_orders = Order::whereDate('created_at', $today)
            ->where('status', '已支付')
            ->get();

        // 当天的预约
        $today_appointments = Appointment::whereDate('time', $today)
            ->get();

        // 当天的美容服务
        $today_grooms = Groom::whereDate('created_at', $today)
            ->get();

        // 正在进行的寄养
        $fosters = Foster::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->where('status', '!=', '已完成')
            ->get();

        return ['today_orders_amount' => $today_orders->sum('amount'),
            'pre_orders_amount' => $pre_orders->sum('amount'),
            'pre_orders_count' => $pre_orders->count(),
            'today_appointments_count' => $today_appointments->count(),
            'today_appointments' => $today_appointments,
            'fosters' => $fosters,
            'fosters_count' => $fosters->count(),
            'grooms' => $today_grooms,
            'grooms_count' => $today_grooms->count()];
    }

    public function getAdmin($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            return response()->json($admin);
        } else {
            return response()->json(['error' => '员工不存在'], 404);
        }
    }

    public function updateAdmin(Request $request)
    {
        $admin = Admin::find($request->adminId);
        if ($admin) {
            $admin->name = $request->name;
            $admin->password = $request->password;
            $admin->role = $request->role;
            $admin->save();
            return response()->json(['success' => '更新成功']);
        } else {
            return response()->json(['error' => '员工不存在'], 404);
        }
    }

}
