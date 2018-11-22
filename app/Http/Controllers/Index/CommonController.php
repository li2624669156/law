<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\DB;
class CommonController extends Controller
{
    //判断是否有这个用户
    public function isUser($code , Request $request){
        $appid = 'wxed02f14e4352769a'; //	公众号的唯一标识
        $secret = '03dcc8268f3d8f0c2db4ad3e8fadb16f';//公众号的appsecret
        $openid =  $request->session()->get('openid');
        $access_token = $request->session()->get('access_token');
        if(empty($access_token) || empty($openid)){
            $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
            $token = json_decode($this ->curlRequest($token_url),true);
            $request->session()->put('openid', $token['openid']);
            $request->session()->put('access_token', $token['access_token']);
            $openid =  $request->session()->get('openid');
            $access_token = $request->session()->get('access_token');
        }
        //获取用户信息
        $user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $user = json_decode($this ->curlRequest($user_url),true);
           if(empty($user['openid'])){
               $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
               $token = json_decode($this ->curlRequest($token_url),true);
               $request->session()->put('openid', $token['openid']);
               $request->session()->put('access_token', $token['access_token']);
               $openid =  $request->session()->get('openid');
               $access_token = $request->session()->get('access_token');
               $user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
               $user = json_decode($this ->curlRequest($user_url),true);
            }
        $isuser = (array)DB::table('user')->where(['open_id'=>$user['openid']])->first();
        if(empty($isuser)){
                //入库 跳选择页面
                $userAdd = [
                  'open_id'=>$user['openid'],
                  'nickname'=>$user['nickname'],
                  'job'=>1,
                  'reg_time'=>time()
                ];
              $user_id = DB::table('user')->insertGetId($userAdd);
              $user_details = [
                  'uid'=>$user_id,
                  'img_url'=>$user['headimgurl'],
                  'province'=>$user['province'],
                  'status'=>1,
                  'user_time'=>time()
              ];
            $request->session()->put('uid', $user_id);
            $user_details_id =DB::table('user_details')->insert($user_details);
            if($user_details_id && $user_id){
                return '跳页面';
            }else{
                 return '系统错误！请联系客服';
            }
        }else{
           $user =  (array)DB::table('user')
                ->join('user_details','user.uid','=','user_details.uid')
                ->where(['open_id'=>$user['openid']])
                ->first();
            return $user;
        }
    }
    //判断是否用户
    public function lv(Request $request){
        if($request->ajax()){
            $isuser = $request ->input('isuser');
            $isGe = $request ->input('isGe');
            if($isuser == 1){
                if($isGe == 0){
                    return json_encode(['status'=>200,'url'=>'http://law.xiaoyaos.cn/']);
                }else{
                    return json_encode(['status'=>200,'url'=>'http://law.xiaoyaos.cn/personalVawe']);
                }
            }else{
                if($isGe == 0){
                    $request->session()->put('isGe', 1);
                    return json_encode(['status'=>200,'url'=>'http://law.xiaoyaos.cn/lv']);
                }else{
                    $request->session()->put('isGe', 2);
                    return json_encode(['status'=>200,'url'=>'http://law.xiaoyaos.cn/lv']);
                }
            }
        }
    }

    /**
    使用curl方式实现get或post请求
    @param $url 请求的url地址
    @param $data 发送的post数据 如果为空则为get方式请求
    return 请求后获取到的数据
     */
    public function curlRequest($url,$data = ''){
        $ch = curl_init();
        $params[CURLOPT_URL] = $url;    //请求url地址
        $params[CURLOPT_HEADER] = false; //是否返回响应头信息
        $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
        $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
        $params[CURLOPT_TIMEOUT] = 30; //超时时间
        if(!empty($data)){
            $params[CURLOPT_POST] = true;
            $params[CURLOPT_POSTFIELDS] = $data;
        }
        $params[CURLOPT_SSL_VERIFYPEER] = false;//请求https时设置,还有其他解决方案
        $params[CURLOPT_SSL_VERIFYHOST] = false;//请求https时,其他方案查看其他博文
        curl_setopt_array($ch, $params); //传入curl参数
        $content = curl_exec($ch); //执行
        curl_close($ch); //关闭连接
        return $content;
    }
    /** 以选择律师 该表 */
    public function registerIv(Request $request){
       $lv= $request->input();
       if(empty($lv['phoe'])){
           return json_encode(['status'=>404,'msg'=>'手机号不能为空']);
       }
       if(empty($lv['realname'])){
           return json_encode(['status'=>404,'msg'=>'真实姓名不能为空']);
       }
       if(empty($lv['uid'])){
           return json_encode(['status'=>404,'msg'=>'系统有误!']);
       }
        $user =  (array)DB::table('user_details')
            ->where(['uid'=>$lv['uid']])
            ->first();
       if(!empty($user['tel'])){
               if($user['status'] == 3){
                   return json_encode(['status'=>200,'msg'=>'请等待管理员的认证！']);
               }else{
                   $isGe =  $request->session()->get('isGe');
                   if($isGe == 1){
                       return json_encode(['status'=>200,'msg'=>'ok','url'=>'http://law.xiaoyaos.cn/']);
                   }else{
                       return json_encode(['status'=>200,'msg'=>'ok','url'=>'http://law.xiaoyaos.cn/personalVawe']);
                   }
               }
       }else{
           $Isupdata= (array)DB::table('user')
               ->where(['uid'=>$lv['uid']])
               ->update(['realname'=>$lv['realname'] , 'job'=>2,'reg_time'=>time()]);
           $Is_details_updata= (array)DB::table('user_details')
               ->where(['uid'=>$lv['uid']])
               ->update(['tel'=>$lv['phoe'] , 'status'=>3,'user_time'=>time()]);
           if($Isupdata && $Is_details_updata){
               $xin_user =  (array)DB::table('user_details')
                   ->where(['uid'=>$lv['uid']])
                   ->first();
               if($xin_user['status'] == 3){
                   return json_encode(['status'=>200,'msg'=>'请等待管理员的认证！']);
               }else{
                   $isGe =  $request->session()->get('isGe');
                   $lv_user =  (array)DB::table('user')
                       ->where(['uid'=>$lv['uid']])
                       ->first();
                   if($isGe == 1){
                       $lv_user['nickname'] ='律师：' . $lv_user['realname'];
                       $request->session()->put('user', $lv_user);
                       return json_encode(['status'=>200,'msg'=>'ok','url'=>'http://law.xiaoyaos.cn/']);
                   }else{
                       $lv_user['nickname'] ='律师：' . $lv_user['realname'];
                       $request->session()->put('user', $lv_user);
                       return json_encode(['status'=>200,'msg'=>'ok','url'=>'http://law.xiaoyaos.cn/personalVawe']);
                   }
               }
           }else{
               return json_encode(['status'=>404,'msg'=>'数据填写有误！']);
           }
       }




    }

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
