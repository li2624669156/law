<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
class CommonController extends Controller{
	/** 微信获取access_token 入数据库 */
    public function access_token(){
        //获取微信access_token
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx8dace98e9b799000&secret=40b9d8949a8ae965637316fbb888a50e';
        $data= file_get_contents($url);
        $arr = json_decode($data,true);

        //存入数据库shop_access_token
        $add=[
            'access_token'=>$arr['access_token'],
            'ctime'=>time()
        ];

        //数据库access_token 查询
        $access=Db::table('access_token')->first();
        // print_r($access);exit;
        $access2 = json_encode($access);
        $access_token = json_decode($access2);
        // print_r($access_token);exit;
        if($access_token == '' || $access_token == null){
            // echo "添加";exit;
            $add_id=DB::table('access_token')->insertGetId($add); 
        }else{
            // echo "修改";exit;
            $id=$access_token->id;
            $add_id=DB::table('access_token')->where(['id'=>$id])->update($add);
        }
        
    }
}