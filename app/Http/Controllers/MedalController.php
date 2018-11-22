<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class MedalController extends CommonController{
	/** 添加勋章 */
	public function add_medal(){
		# 有效期
		$over_time = 3600*24*7;
		# 当前时间
		$now_time = time();
		$new_time = $now_time + $over_time;

		# 用户id
		$uid = 1;
		$user_consumer_where = [
			'uid' => $uid,
			'status' => 1,
			'c_type' => 1
		];
		# 用户消费记录表数据
		$user_consumer = DB::table('consumer_log')->where($user_consumer_where)->get();
//        print_r($user_consumer);exit;
		# 用户数据
        $user_where = [
            'uid'=>$uid
        ];
		$user_info = DB::table('user')->where($user_where)->first();
//        print_r($user_info);exit;

		# 如果消费日期在7天之内 判断勋章属性
		$user_money = 0;
		# 勋章id
		$mid = $user_info->m_id;
		$user_consumer_id = '';
		$consumer_id = '';
		foreach($user_consumer as $v){
			if($v->ctime-$now_time<$over_time){
				$user_consumer_id .= $v->id.',';
				$user_money += $v->c_money;
			}
		}
//        print_r($user_consumer_id);exit;
		$consumer_id = rtrim($user_consumer_id,',');
//        print_r($consumer_id);exit;
//        print_r($user_money);exit;

		$number = 50;
		$sum = $this->check_zero($number);
		if($user_money > 0 && $user_money <= 10){# 如果用户消费金额大于0小于10勋章是铜
			# 如果用户有勋章，并且没有过期，就续费7天，否则颁发勋章
			if($mid == 1 && $now_time < $user_info->last_time){
				$save = $now_time+$over_time;
				# 修改数据
				$update_save = [
					'last_time'=>$save
				];
				# 修改条件
				$update_where = [
					'uid'=>$uid
				];
				DB::table('user')->where($update_where)->update($update_save);
			}else{
				$install = [
					'last_time'=>$now_time+$over_time,
					'm_id'=>1
				];
				$install_where = [
					'uid'=>$uid
				];
				DB::table('user')->where($install_where)->update($install);
			}
		}elseif($user_money > 10 && $user_money <= 20){# 大于10小于20勋章是银
            if($user_info->m_id == 2){
                $save = $now_time+$over_time;

                # 修改数据
                $update_save = [
                    'last_time'=>$save
                ];

                # 修改条件
                $update_where = [
                    'uid'=>$uid
                ];
                DB::table('user')->where($update_where)->update($update_save);
            }else{
                $install = [
                    'last_time'=>$now_time+$over_time,
                    'm_id'=>1
                ];
                $install_where = [
                    'uid'=>$uid
                ];
                DB::table('user')->where($install_where)->update($install);
            }
        }elseif($user_money > 20 && $user_money <= 30){# 大于20小于30勋章是金
            if($user_info->m_id == 3){
                $save = $now_time+$over_time;

                # 修改数据
                $update_save = [
                    'last_time'=>$save
                ];
                #修改条件
                $update_where = [
                    'uid'=>$uid
                ];
                DB::table('user')->where($update_where)->update($update_save);
            }else{
                $install = [
                    'last_time'=>$now_time+$over_time,
                    'm_id'=>1
                ];
                $install_where = [
                    'uid'=>$uid
                ];
                DB::table('user')->where($install_where)->update($install);
            }
        }elseif($user_money > 30 && $user_money <= 50){# 大于30小于50勋章是钻石
            if($user_info->m_id == 4){
                $save = $now_time+$over_time;

                # 修改数据
                $update_save = [
                    'last_time'=>$save
                ];
                #修改条件
                $update_where = [
                    'uid'=>$uid
                ];
                DB::table('user')->where($update_where)->update($update_save);
            }else{
                $install = [
                    'last_time'=>$now_time+$over_time,
                    'm_id'=>1
                ];
                $install_where = [
                    'uid'=>$uid
                ];
                DB::table('user')->where($install_where)->update($install);
            }
        }
	}

	/**
	 * 判断是否是10的倍数
	 * @param $number
	 * @return bool
	 */
	protected  function check_zero($number){
		return $number % 10 == 0;
	}
}