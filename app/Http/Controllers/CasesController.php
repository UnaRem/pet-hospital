<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CasesController extends Controller
{

    public function updateStatus(Request $request)
    {
        $post = $request->all();
        if (isset($post['id']) && isset($post['status'])) {
            $case = Cases::find($post['id']);
            $case->status = $post['status'];
            $case->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function signature(Request $request)
    {
        $post = $request->all();
        if (isset($post['case_id']) && isset($post['signature'])) {
            $case = Cases::find($post['case_id']);
            // 从 base64 数据中解码图片
            list($type, $data) = explode(';', $post['signature']);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            // 生成唯一文件名
            $fileName = 'signature_' . time() . '.png';

            // 保存图片到 public/images 目录下
            file_put_contents(public_path('signatures/' . $fileName), $data);

            $case->signature = $fileName;
            $case->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function addCase(Request $request)
    {
        $case = new Cases();
        $case->pet_id = $request->pet_id;
        $case->case = $request->case;
        $case->result = $request->result;
        $case->treatment = $request->treatment;
        $case->amount = $request->amount;
        $case->risk = $request->risk;
        if ($case->save()){
            return response()->json([
                'success' => true,
                'accident' => $case
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => '病例创建失败'
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
     * @param  \App\Models\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function show(Cases $cases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function edit(Cases $cases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cases $cases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cases $cases)
    {
        //
    }
}
