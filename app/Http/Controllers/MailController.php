<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Mail;
use rav;
class MailController extends Controller
{
    public function index()
    {
        $email="1124802717@qq.com";
        $this->send($email);
    }
    

    /**
     * Show the form for creating a new resource.
     * 
     *发送邮件方法
     *
     * @return \Illuminate\Http\Response
     */
    // public function send($email)
    // {
    //     // $email="1124802717@qq.com";
    //     \Mail::send('mail',['name'=>"开来鑫"],$msg,function($message)use($email){
    //         //设置主题
    //         $message->subject('欢迎来到本公司注册注册账号');
    //         //设置接收方
    //         $message->to($email);
    //     });
    // }
     public function send($email)
    {
        // $email="1124802717@qq.com";
        $msg = '欢迎前来注册账号...您的验证码是'.rand(10000,99999);
        \Mail::raw($msg,function($message)use($email){
            //设置主题
            $message->subject('欢迎来到本公司注册注册账号');
            //设置接收方
            $message->to($email);
        });
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
