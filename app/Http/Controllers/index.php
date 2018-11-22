<?php

namespace App\Http\Controllers;
use DB;
use Session;
class index extends Controller
{
	public function index(){
		return view('index/index');
	}
	public function p_list(){
		$data=DB::table('post')->orderby('p_time','asc')->join('user','post.p_uid','=','user.uid')->paginate(10);
		return view('index/p_list',compact('data'));
	}
	public function info(){
		$pid=$_GET;
		$keyword=$pid['p_id'].'-';
		$res=DB::table('com_p')->orderby('com_time','asc')->join('user','com_p.com_uid','=','user.uid')->where('com_pid','like',"$keyword%")->where(['com_tid'=>$pid['p_id'],'com_stat'=>'2'])->paginate(5);
			if($res){
				$data=DB::table('com_p')->orderby('com_stat','desc')->join('user','com_p.com_uid','=','user.uid')->where('com_pid','like',"$keyword%")->where(['com_tid'=>$pid['p_id']])->paginate(5);
				return view('index/info',compact('data','pid'));
			}else{
				$data=DB::table('com_p')->orderby('com_time','asc')->join('user','com_p.com_uid','=','user.uid')->where('com_pid','like',"$keyword%")->where(['com_tid'=>$pid['p_id']])->paginate(5);
				return view('index/info',compact('data','pid'));
		}
	}
	public function geninfo(){
		$data=$_GET;
		$keyword=$data['pid'];
		//echo $keyword;exit;
		$data2=DB::table('gen')->orderby('g_time','asc')->join('user','gen.g_uid','=','user.uid')->where('g_pid','like',"$keyword-%")->paginate(5);
		return view('index/geninfo',compact('data2','data'));
	}
	public function addpost(){
		return view('index/addpost');
	}

	public function addpost_do(){
		$data=$_POST;
		$uid='1';
		$array=[
			'p_title'=>$data['title'],
			'p_time'=>time(),
			'p_content'=>$data['content'],
			'p_uid'=>$uid,
			'p_type'=>$data['check']
		];
		$data=DB::table('post')->insert($array);
		if($data){
			echo '添加成功';
		}else{
			echo '添加失败';
		}
	}
	public function com_add(){
		$tid=$_GET['tid'];
		return view('index/comadd',compact('tid'));
	}
	public function com_adddo(){
		$data=$_POST;
		$array=[
			'com_uid'=>'1',
			'com_content'=>$data['title'],
			'com_time'=>time(),
			'com_stat'=>'1',
			'com_tid'=>$data['tid']
		];
		$res=DB::table('com_p')->insertGetId($array);
		$pid=$data['tid'].'-'.$res;
		$res2=DB::table('com_p')->where(['com_id'=>$res])->update(['com_pid'=>$pid]);
		if($res2&&$res){
			echo '发表成功';
		}else{
			echo '发表失败';
		}
	}

	public function genadd(){
		$arr=$_GET;
		return view('index/genadd',compact('arr'));
	}
	public function gen_adddo(){
		$data=$_POST;
		$array=[
			'g_name'=>'1',
			'g_content'=>$data['title'],
			'g_time'=>time(),
			'g_uid'=>$data['uid']
		];
		$data2=DB::table('gen')->insertGetId($array);
		$pid=$data['pid'].'-'.$data2;
		$res2=DB::table('gen')->where(['id'=>$data2])->update(['g_pid'=>$pid]);
		if($res2&&$data2){
			echo '发表成功';
		}else{
			echo '发表失败';
		}
	}
	public function xs(){
		return view('index/xs');
	}
	public function xsadd(){
		$arr=$_POST;
		print_r($arr);exit;
	}



}