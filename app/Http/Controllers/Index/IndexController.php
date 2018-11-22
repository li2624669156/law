<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Index\CommonController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class IndexController extends CommonController
{
    //获取用户信息   --首页
    public function index(Request $request){
        $code = $request ->input('code');//获取code
        $keyword = $this ->isUser($code , $request);
        if($keyword == '系统错误！请联系客服'){
           echo '系统错误！请联系客服';
        }else if(is_array($keyword)){
//            print_r($keyword);exit;
            if($keyword['status'] == 3) {
                echo "<script>alert('请等待管理员的审核！')</script>";
            }else if($keyword['status'] == 2){
                echo "<script>alert('此账号有异常')</script>";
            }else{
                if(empty($keyword['realname'])){
                    $request->session()->put('user', $keyword);
                }else{
                    $keyword['nickname'] ='律师：' . $keyword['realname'];
                    $request->session()->put('user', $keyword);
                }
                return view('Index.index');
            }
        }else if($keyword == '跳页面'){
            return view('Index.userAdd', ['isGe'=>0]);
        }else{
            echo '系统错误！请联系客服';
        }

    }

    /** 个人中心 */
    public function personal(Request $request){
//        echo 111;exit;
        $code = $request ->input('code');//获取code
        $keyword = $this ->isUser($code , $request);
        if($keyword == '系统错误！请联系客服'){
            echo '系统错误！请联系客服';
        }else if(is_array($keyword)){
            if($keyword['status'] == 3) {
                echo "<script>alert('请等待管理员的审核！')</script>";
            }else if($keyword['status'] == 2){
                echo "<script>alert('此账号有异常')</script>";
            }else{
                 if(empty($keyword['realname'])){
                    $request->session()->put('user', $keyword);
                }else{
                    $keyword['nickname'] ='律师：' . $keyword['realname'];
                    $request->session()->put('user', $keyword);
                }
                return view('Index.personal');
            }
        }else if($keyword == '跳页面'){
            return view('Index.userAdd' ,['isGe'=>1]);
        }else{
            echo '系统错误！请联系客服';
        }

    }

    /** 投稿--- 判断是不是律师 */
    public function Submission_isUser(){
       $session =  new Session();
       $session_user =  $session ::get('user');
        $user =  (array)DB::table('user')->where(['uid'=>$session_user['uid'] , 'open_id' =>$session_user['open_id']])->first();
       if($user){
           if($user['job'] == 2){
               return json_encode(['status'=>200 , 'msg'=>'ok']);
           }else{
                return json_encode(['status'=>404 , 'msg'=>'尊敬的用户此功能仅限律师可以使用！']);
           }
       }else{
            return json_encode(['status'=>404 , 'msg'=>'未检测到用户！请从新登录']);
       }
    }

    /** 律师投稿 */
    public function tougao(){
        //查询分类表数据
        $cate_data = DB::table('law_category')->get();
        $cate_data =  json_decode(json_encode($cate_data),true);
//        print_r($cate_data);exit;
        return view('Index.tougao')->with('cate_data',$cate_data);
    }

    /** 添加稿子 */
    public function gaozi_add(Request $request){
        # 接数据
        $data = $request ->input();
        # 判断是手机投稿还是PC投稿 $type
        $server_data = $_SERVER['HTTP_USER_AGENT'];
//        print_r($a);
        $strpos_res = strpos($server_data,'Windows');
//        print_r($b);die;
        if($strpos_res){
            # 电脑投稿
            $type = 2;
            # 获取用户id $uid
            session_start();
            $sessionid = session_id();
//        print_r($sessionid);exit;
            # 根据sessionid查询数据库此用户
            $session_openid_res = (array)DB::table('session_openid')->where(['sessionid'=>$sessionid])->first();
//        print_r($session_openid_res);
            # 根据openid查询数据库user
            $user_res = (array)DB::table('user')->where(['openid'=>$session_openid_res['openid']])->first();
//        print_r($user_res);
            $u_id = $user_res['id'];
        }else{
            # 手机投稿
            $type = 1;
            $session = new Session;
            $user = $session::get('user');
//        print_r($openid);exit;
            # 根据openid查询此用户是否存在
            $user_id = (array)DB::table('user')->where(['open_id'=>$user['openid']])->first();
//        print_r($user_id);exit;
            $u_id = $user_id['id'];
        }

//exit;
        $insert_data = [
            'uid' => $u_id,
            'title' => $data['title'],
            'type' => $type,
            'content' => $data['content'],
            'ctime' => time(),
            'utime' => time(),
            'cate_id' => $data['cate_id'],
        ];
//        print_r($insert_data);exit;
        # 执行添加稿子
        $res = DB::table('law_article')->insert($insert_data);
//        print_r($res);
        if($res){
            # 判断是PC端投稿还是手机端投稿
            # PC端的话要把 session_openid 里的数据删掉
            if($insert_data['type'] == 2){
                $where = [
                    'uid' => $insert_data['uid']
                ];
                $user_info = (array)DB::table('user')->where($where)->first();
//                print_r($user_info);
                $where2 = [
                    'open_id'=>$user_info['open_id']
                ];
                $del_sessionid = DB::table('session_openid')->where($where2)->delete();
//                print_r($del_sessionid);exit;
            }
            return ['msg'=>'投稿成功' , 'code'=>'1' , 'status'=>'true'];
        }else{
            return ['msg'=>'投稿失败' , 'code'=>'2' , 'status'=>'false'];
        }
    }

    /** 律师电脑投稿 直接生成二维码 */
    public function pc_tougao(){
        $qrcode=new QR_CodeController();
        $data=json_decode($qrcode->send(),true);
        print_r($data);exit;
        //echo '<pre/>';
        //print_r($data);
        $ticket=$data['ticket'];
        $url='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
//        echo $url;die;
//        return view('qrcode')->with('url',$url);
        return view('pc_tougao')->with('url',$url);
    }

    /** 扫二维码投稿 */
    public function pc_gaozi_add(){
        session_start();
        $sessionid = session_id();
//        print_r($sessionid);exit;
        # 根据sessionid查询数据库此用户是否存在
        $res = (array)DB::table('session_openid')->where(['sessionid'=>$sessionid])->first();
//        print_r($res);exit;
        $data = [];
        # 用户存在
        if($res){
            # 根据openid查询用户表 用户的角色
            $openid = $res['openid'];
            $user = (array)DB::table('user')->where(['openid'=>$openid])->first();
//            print_r($user);exit;
            if(empty($user)) {
                return $data = ['msg'=>'此用户不存在','code'=>2];
            }else{
                if($user['role_type'] == 2){
//                    header("location:http://ruirui.jinxiaofei.xyz/tougao");
                    //删除成功数据,session_openid
//                    $result2=Db::table('session_openid')->where(['sessionid'=>$sessionid])->delete();
//                    print_r($result2);exit;
                    return $data = ['msg'=>'进入律师投稿页面','code'=>1];
                }else{
//                    echo "<script>alert('此用户不是律师')</script>";
                    return $data=['msg'=>'此用户不是律师','code'=>2];
                }
            }
        }else{
//            echo "<script>alert('此用户不存在')</script>";
            return $data=['msg'=>'未扫码','code'=>2];
            exit;
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }







}
