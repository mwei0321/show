<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  演员数据操作模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月12日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class Actor extends ActiveRecord{
        public $_pageSize = 20;

        static function tableName(){
            return 'actor';
        }

        /**
         * 演员列表
         * @param  array $_where
         * @param  string $_offset
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月16日 下午3:54:15
        **/
        function getActorList($_where = 1,$_offset = 'count'){
            $ActorM = self::find()->where($_where);
            if((string)$_offset == 'count'){
                return $ActorM->count();
            }

            $data = $ActorM->offset($_offset)->limit($this->_pageSize)->orderBy('id DESC')->asArray()->all();
            return $data;
        }

        /**
         * 获取演员详情
         * @param  int $_id
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 下午4:30:48
        **/
        function getActorInfoById($_id){
            return self::find()->where(['id'=>$_id])->asArray()->one();
        }

        /**
         * 获取多个演员详情
         * @param  array $_ids
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月12日 下午4:35:11
        **/
        function getActorInfoByIds($_ids){
            return self::find()->where(['id'=>$_ids])->asArray()->all();
        }

        /**
         * 获取所有的演员
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午5:32:18
        **/
        function getActorInfoAll(){
            $actorLists = self::find()->asArray()->all();
            return fieldtokey($actorLists);
        }

        /**
         * 节目演员详情
         * @param  int $_showId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月19日 下午3:17:30
        **/
        function getShowActorInfo($_showId){
            $datas = self::find()
                    ->select('a.*,sa.duty,sa.act')
                    ->from('actor a')
                    ->rightJoin('show_actor sa','a.id = sa.actor_id')
                    ->where(['sa.show_id'=>$_showId])
                    ->asArray()
                    ->all();
            //处理数据
            $dutyNameList = $this->getActorDutyLists();
            foreach ($datas as $k => $v){
                $datas[$k]['dutyName'] = $dutyNameList[$v['duty']];
                $datas[$k]['actor_id'] = $v['id'];

                unset($datas[$k]['ctime']);
                unset($datas[$k]['id']);
            }

            return $datas;
        }

        /**
         * 获取演员演的节目
         * @param  int $_actorId
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 上午11:09:08
        **/
        function getActorShowList($_actorId){
            //获取演员演过的节目ID
            $showIds = self::find()
                        ->select('show_id')
                        ->from('show_actor')
                        ->where([
                            'actor_id'=>$_actorId,
                        ])
                        ->orderBy('ctime DESC')
                        ->asArray()
                        ->all();
            //获取节目详情
            $showlist = self::find()
                        ->from('show')
                        ->where([
                            'id' => arr2to1($showIds,'show_id'),
                        ])
//                         ->createCommand()->getRawSql();
                        ->asArray()
                        ->all();
           return $showlist;
        }

        /**
         * 返回职务列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午5:43:02
        **/
        function getActorDutyLists(){
            return [
                '导演',
                '演员',
                '编剧',
                '灯光',
                '音响',
                '舞美',
                '道具',
                '剧务',
                '后勤',
            ];
        }
    }