<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\AdminUsers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    /*登录*/
    public function login(){
        if($input=Input::all()){

            $rules = [
                "user_name" => 'required',
                "user_pass" => 'required',
                "cpt" => 'required|captcha',
            ];
            $messages = [
                'user_name.required' => '用户名不能为空',
                'user_pass.required' => '密码不能为空',
                'cpt.required' => '请输入验证码',
                'cpt.captcha' => '验证码错误，请重试'
            ];

            $validator = Validator::make(Input::all(), $rules, $messages);
            if($validator->fails()) {
                return back()->withErrors($validator);
            } else {

                $adminUser=AdminUsers::where(['user_name'=>$input['user_name']])->first();
                if(Crypt::decrypt($adminUser->user_pass)==$input['user_pass']){
                    session(['user_name'=>$input['user_name']]);
                    return redirect('admin/index');
                }else{
                    return redirect("admin/login");
                }

            }
        }

        return view("admin/login/login");
    }

    public function logout(){
        session(['user_name'=>null]);
        return redirect("admin/login");
    }
}
