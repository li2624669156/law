<?php

namespace App\Http\Controllers;
use DB;
use Session;
class admin extends Controller
{
	//登录
	public function admin(){
		$res=Session::get('data');
		if(empty($res)){
			return view('admin/index');
		}else{
			return view('admin/index',compact('res'));
		}
	}
	//登录
	public function logindo(){
		$arr=$_POST;
		$res=(array)DB::table('admin')->where(['account'=>$arr['username'],'pwd'=>$arr['password']])->first();
		if(empty($res)){
			echo '登录失败';
		}else{
			$data=Session::put('data',$res);
			//echo "<script>alert('登录成功')</script>";
			header("refresh:1;url='/index' ");
		}
	}
	//退出
	public function out(){
		Session::forget('data');
		header("refresh:1;url='/index' ");
	}
	//评论列表
	public function plist(){
		$data=DB::table('com_p')->orderby('com_time','asc')->paginate(1);
		return view('admin/plist',compact('data'));
	}
	public function pl_up(){
		$data=$_GET;
		$array=(array)DB::table('t_u')->where(['u_id'=>$data['uid']])->first();
		$array2=json_decode(DB::table('t_u')->where(['t_id'=>$data['tid'],'job'=>$array['job']])->get(),true);
		$array3=json_decode(DB::table('t_u')->where(['t_id'=>$data['tid'],'status'=>'1'])->count(),true);
		print_r($array3);exit;
		foreach($array2 as $k=>$v){
			if($v['job']==$array['job']&&$v['status']=='1'){
				echo '标杆职业重复';
			}else{
				$res=DB::table('com_p')->where(['com_uid'=>$data['uid'],'com_tid'=>$data['tid']])->update(['com_stat'=>'2']);
				$res2=DB::table('t_u')->where(['u_id'=>$data['uid']])->update(['status'=>'1']);
					if($res&&$res2){
					header("refresh:1;url='/plist'");
					}else{
					echo '修改失败';exit;
					header("refresh:3;url='/plist'");
					}
				}
		}
	}
}

?>