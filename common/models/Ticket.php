<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  节目入场券操作模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月6日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class Ticket extends ActiveRecord{

        static function tableName(){
            return 'ticket';
        }

        /**
         * 获取演出票购买详情
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午2:43:29
        **/
        function getShowTicketSellInfo($_timesId){
            return self::find()->where(['times_id'=>$_timesId])->asArray()->all();
        }

        /**
         * 返回票的详情
         * @param  int|array $_ids
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月13日 下午2:36:07
         **/
        function getTicketInfoByIds($_ids){
            return self::find()->where(['id' => $_ids])->asArray()->all();
        }

        /**
         * 获取节目演出预留的座位
         * @param  int $_timesId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午3:09:51
        **/
        function getShowTimesReserved($_timesId){
            return self::find()->from('reserved_seat')->where(['times_id'=>$_timesId])->asArray()->all();
        }

        /**
         * 获取未开演出演出场次
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月7日 上午11:11:24
         **/
        function getShowTimesById($_showId){
            $times = self::find()->from('show_times')->where([
                        'show_id'   => $_showId
                    ])->orderBy('id ASC')
//                     ->createCommand()->getRawSql();
                    ->asArray()
                    ->all();
            return $times;
        }

        /**
         * 获取未开演出演出场次
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月7日 上午11:11:24
         **/
        function getShowTimesById2($_showId){
            $times = self::find()->from('show_times')->where([
                'and',
                ['show_id'   => $_showId],
                ['>','stime',(time()+60)],
            ])->orderBy('id ASC')
//                     ->createCommand()->getRawSql();
            ->asArray()
            ->all();
            return $times;
        }

        /**
         * 根据场次ID返回场次信息
         * @param  array $_timesIds
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月15日 下午3:13:53
        **/
        function getTimesByIds($_timesIds){
            $times = self::find()->from('show_times')->where(['id'=>$_timesIds])->asArray()->all();
            return fieldtokey($times);
        }

        /**
         * 返回场次座位信息
         * @param  int $_timesId
         * @param  int $_roomId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月20日 上午10:38:56
        **/
        function getSeatInfoByTimesId($_timesId,$_roomId){
            //获取房间座位
            $roomSeat = $this->getRoomInfo($_roomId);
            //获取场次预留座位
            $resseredSeat = $this->getShowTimesReserved($_timesId);
            $resseredSeatIds = $resseredSeat ? arr2to1($resseredSeat,'seat_id') : [];
            //获取已售座位
            $buySeat = $this->getShowTicketSellInfo($_timesId);
            $buySeatIds = $buySeat ? arr2to1($buySeat,'seat_id') : [];
            //处理
            $data = [];
            foreach ($roomSeat as $k => $v){
                $status = 0;
                //判断座位状态
                if(in_array($v['seat_id'],$resseredSeatIds)){
                    $status = 2;
                }elseif(in_array($v['seat_id'], $buySeatIds))
                    $status = 1;
                $data[$v['seat_id']] = $v;
                $data[$v['seat_id']]['status'] = $status;
            }

            return $data;
        }

        /**
         * 返回座位信息
         * @param  int $_seatId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午3:49:46
        **/
        function getSeatInfoById($_seatId){
            return self::find()->from('room_seat')->where(['seat_id'=>$_seatId])->asArray()->one();
        }

        /**
         * 检查座位是否已售、或者预留
         * @param  int $_seatId
         * @return int 0:未售 1:已售 2:已预留
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 下午3:53:27
        **/
        function checkSeatStatus($_timesId,$_seatId){
            $where = [];
            $where['times_id'] = $_timesId;
            $where['seat_id'] = $_seatId;

            //是否已售
            $isBuy = self::find()->where($where)->count();
            //是否预留
            $isReserved = self::find()->from('reserved_seat')->where($where)->asArray()->one();

            //返回
            if($isBuy > 0){
                return 1;
            }elseif($isReserved > 0){
                return 2;
            }
            return 0;
        }

        /**
         * 获取演出房间信息
         * @param  int $_roomId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月9日 下午3:06:55
        **/
        function getRoomInfo($_roomId){
            return self::find()->from('room_seat')->where(['room_id'=>$_roomId])->orderBy('id ASC')->asArray()->all();
        }

        /**
         * 创建房间座位
         * @param  array $_coord 座位数组 [列,列]
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月10日 上午11:00:53
        **/
        function createRoomSeat($_roomId = 1){
            //删除座位
            (new \common\models\CommonModel('room_seat'))->deleteAll(['room_id'=>$_roomId]);
            //写入座位sql
            $sql = "INSERT INTO `room_seat` (`room_id`,`row`,`column`,`seat_id`) VALUES ";
            $seat = $this->_RoomSeatNum($_roomId);
            $seatId = 1;$seatCode = 0;
            foreach ($seat as $k => $v){
                $seatCode += $v;
                $seatId = $seatCode;
                for($i = $v;$i > 0;$i--){
                    $sql .= "($_roomId,".($k+1).",$i,$seatId),";
                    $seatId--;
                }
            }
            $sql = substr($sql, 0,-1);
            //写入数据到数据库
            return \Yii::$app->db->createCommand($sql)->execute();
        }

        /**
         * 生成座位列位图
         * @param  int $_roomId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月20日 下午3:03:35
        **/
        function _RoomSeatNum($_roomId = 1){
            $seatNum = [
                [],
                [27,27,28,28,28,28,23,23,23,23,23,23,28,28,29],
            ];

            return $seatNum[$_roomId];
        }
    }