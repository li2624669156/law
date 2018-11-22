<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//-------------------------------------------------------------------李壮
//后台admin
Route::any('/index',"admin@admin");
Route::any('/console',"admin@console");
Route::any('/user',"admin@user");
//登录
Route::any('/login',"admin@login");
//退出
Route::any('/out',"admin@out");
Route::any('/logindo',"admin@logindo");
//评论列表
Route::any('/plist',"admin@plist");
Route::any('/pl_up',"admin@pl_up");
Route::any('/form',"admin@form");
//前台首页
Route::any('/show',"index@index");
Route::any('/p_list',"index@p_list");
Route::any('/postinfo',"index@info");
Route::any('/geninfo',"index@geninfo");
Route::any('/xs',"index@xs");
//添加
Route::any('/addpost',"index@addpost");
Route::any('/addpost_do',"index@addpost_do");
Route::any('/com_add',"index@com_add");
Route::any('/com_adddo',"index@com_adddo");
Route::any('/genadd',"index@genadd");
Route::any('/gen_adddo',"index@gen_adddo");
//热点
Route::any('/hot_list',"red@hot_list");
//-------------------------------------------------------------------------------------------赵震
Route::any('/','Index\IndexController@index');//首页
Route::any('personal','Index\IndexController@personal');//个人中心
Route::any('isUser','Index\CommonController@isUser');//获取用户信息
Route::any('islv','Index\CommonController@lv');//判断用户信息
Route::any('registerIv','Index\CommonController@registerIv');//添加律师
Route::any('Submission_isUser','Index\IndexController@Submission_isUser');//投稿 --- 判断是不是律师
Route::any('tougao','Index\IndexController@tougao');//投稿 --- 律师投稿
Route::any('gaozi_add','Index\IndexController@gaozi_add');//投稿 --- 律师投稿 --手机投稿
Route::any('pc_tougao','Index\IndexController@pc_tougao');//投稿 --- 律师投稿 --律师电脑投稿 直接生成二维码 
Route::any('pc_gaozi_add','Index\IndexController@pc_gaozi_add');//投稿 --- 律师投稿 --扫二维码投稿
Route::get('userAdd',function () {return view('Index.userAdd');});//选择角色
Route::get('lv',function () {return view('Index.lv');});//律师填写
Route::get('personalVawe',function () {return view('Index.personal');});//个人中心
Route::get('list',function () {return view('Index.list');});//list
Route::get('article',function () {return view('Index.article');});//article
//------------------------------------------------------------------------------------------   李瑞
########## CommonController@控制器 ##########
//微信获取access_token 入数据库
Route::get('/access_token', 'CommonController@access_token');
########## MedalController@控制器 ##########
//添加勋章
Route::get('/add_medal', 'MedalController@add_medal');
########## MedalController@控制器 ##########
//充值
Route::get('/chongzhi', 'MoneyController@chongzhi');
//执行充值
Route::get('/chongzhi_do','MoneyController@chongzhi_do');
//
Route::get('/notify','MoneyController@notify');
//
Route::get('/chongzhi_status','MoneyController@chongzhi_status');
//悬赏
Route::get('/person','MoneyController@person');
//提现
Route::get('/tixian','MoneyController@tixian');
//执行体现
Route::get('/tixian_do','MoneyController@tixian_do');
//提现到零钱
Route::get('/lingqian','MoneyController@lingqian');
//提现到银行
Route::get('/bankCard','MoneyController@bankCard');
//提现到支付宝
Route::get('/alipay','MoneyController@alipay');













