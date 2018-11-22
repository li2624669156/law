<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class red extends Controller{
    /** 热点后台展示 */
    public function hot_list(){
        $hot_data = DB::table('hot')->where(['is_show'=>1])->get();
//        print_r($hot_data);exit;
        $new_data = json_decode($hot_data,true);
        if($new_data){
            foreach($new_data as $k=>$v){
                $new_data[$k]['ctime'] = date('Y-m-s H:i:s',$v['ctime']);
            }
            return view('red/hot_list')->with('new_data',$new_data);
        }else{
            exit("<script>没有可以展示的数据了</script>");
        }

    }

    /** 是否展示 */
    public function is_show(){
        $h_id = $_GET['h_id'];
//        print_r($h_id);exit;
        $h_id = rtrim($h_id,',');
//        print_r($h_id);exit;
        $where = explode(',',$h_id);
//        print_r($where);exit;
        $update_data = [
            'is_show' => 2
        ];
        if($h_id){
            $res = DB::table('hot')->whereIn('h_id',$where)->update($update_data);
//            print_r($res);
            if($res){
                return 1;
            }else{
                return 2;
            }
        }
    }

    /** 跳 */
    public function tiao(){
        # 查询稿子表数据
        $gaozi_data = DB::table('article')->where(['status' => 1])->orderBy('ctime', 'desc')->limit(5)->get();
        # 查询热点表数据
        $hot_data = DB::table('hot')->where(['is_show'=>2])->orderBy('ctime','desc')->limit(5)->get();
//        return 1;
        return view('law_knowledge')->with('gaozi_data',$gaozi_data)->with('hot_data',$hot_data);
    }

    /** 热点详情 */
    public function hot_detail(){
        //热点 id
        $h_id = $_GET['h_id'];
        // 根据 热点 id 查热点信息展示
        $data = DB::table('hot')->where('h_id',$h_id)->first();
        // 根据热点 id 查评论表的所有评论
        $arr = DB::table('comment')->leftjoin('user','comment.uid','=','user.id')->where(['h_id'=>$h_id,'pid'=>0])->get();
        foreach($arr as $k=>$v){
            $v->ctime1 = date("Y-m-d H:i",$v->ctime1);
            if($v->m_id){
                $res = (array)DB::table('medal')->where(['m_id'=>$v->m_id])->first();
                $v->m_id = $res['name'];
            }
            $res2 = DB::table('comment')->leftjoin('user','comment.uid','=','user.id')->where(['pid'=>$v->comment_id])->get();
            if($res2){
                foreach($res2 as $key =>$val){
                    $val->ctime1 = date("Y-m-d H:i",$val->ctime1);
                    if($val->m_id){
                        $res3 = (array)DB::table('medal')->where(['m_id'=>$val->m_id])->first();
                        $val->m_id = $res3['name'];
                    }
                }
                $v->res = $res2;
            }
        }
//        dump($data);
//        dump($arr);exit;
        return view('hot_detail')->with('data',$data)->with('arr',$arr);
    }

    /** 所有热点 */
    public function all_hot(){
        # 查询热点表数据
        $hot_data = DB::table('hot')->where(['is_show'=>2])->orderBy('ctime','desc')->get();

        return view('all_hot')->with('hot_data',$hot_data);
    }
}