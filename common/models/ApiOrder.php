<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  订单接口处理
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月15日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;
    use common\models\Order;

    class ApiOrder extends ActiveRecord{

        static function tableName(){
            return 'ticket_order';
        }

        /**
         * 获取我的订单列表
         * @param  int $_memberId
         * @param  string $_offset
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月15日 下午2:39:48
        **/
        function getMyOrder($_memberId,$_offset = 'count'){
            $where = [];
            $where['member_id'] = $_memberId;
            //总数
            $lists = (new Order())->getOrderList($where,$_offset);

            //处理列表
            if((string)$_offset != 'count'){
                //节目信息
                $showInfos = (new \common\models\Show())->getShowInfoByIds(arr2to1($lists,'show_id'));
                //节目场次信息
                $times = (new \common\models\Ticket())->getTimesByIds(arr2to1($lists,'times_id'));
                foreach ($lists as $k => $v){
                    $lists[$k]['order_id'] = $v['id'];
                    $lists[$k]['ctime'] = date('Y-m-d H:i',$v['ctime']);
                    $lists[$k]['title'] = $showInfos[$v['show_id']]['title'];
                    $lists[$k]['cover'] = ImageUrl.$showInfos[$v['show_id']]['cover'];
                    $tmpStime = isset($times[$v['times_id']]) ? $times[$v['times_id']]['stime'] : 0;
                    $lists[$k]['stime'] = date('Y-m-d H:i',$tmpStime);

                    //判断节目开始
                    $time = time();
                    $showt = $tmpStime + $showInfos[$v['show_id']]['duration'] * 60;
                    if($v['status'] == 7){
                        $lists[$k]['status'] = 7; //退票
                    }elseif($time < $tmpStime){
//                         $lists[$k]['status'] = ($time < ($times[$v['times_id']]['stime'] - 3600)) ? 0 : 1; //即将开始
                        $lists[$k]['status'] = 1; //即将开始
                    }elseif (($time > $tmpStime) && $time < $showt){
                        $lists[$k]['status'] = 2; //已开始
                    }elseif($time > $showt){
                        $lists[$k]['status'] = 3; //已结束
                    }
                    //处理座位
                    $seat = '';
                    foreach ($v['ticket'] as $val){
                        $seat .= $val['row']."排".$val['column']."座 ";
                    }
                    $lists[$k]['seat'] = $seat;

                    unset($lists[$k]['id']);
                    unset($lists[$k]['member_id']);
                    unset($lists[$k]['ticket']);
                }
            }

            return $lists;
        }

        /**
         * 获取订单ID
         * @param  int $_orderId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年8月2日 下午3:28:20
        **/
        static function getOrderInfoById($_orderId){
            $data = [];
            //订单信息
            $orderInfo = self::findOne($_orderId);
            $data['code'] = $orderInfo->code;
            $data['show_id'] = $orderInfo->show_id;
            $data['times_id'] = $orderInfo->times_id;
            $data['order_id'] = $_orderId;
            //演出信息
            $showInfo = self::find()->from('show')->select('title,cover')->where(['id'=>$orderInfo->show_id])->asArray()->one();
            $data['title'] = $showInfo['title'];
            $data['cover'] = ImageUrl.$showInfo['cover'];
            //订单座位
            $orderSeats = self::find()->from('ticket')->where(['order_id'=>$_orderId])->asArray()->all();
            $seats = '';
            foreach ($orderSeats as $val){
                $seats .= $val['row']."排".$val['column']."座 ";
            }
            $data['seats'] = $seats;
            //场次时间
            $times = self::find()->from('show_times')->where(['id'=>$orderInfo->times_id])->asArray()->one();
            $data['times'] = date('Y-m-d H:i',$times['stime']);

            return $data;
        }
    }
