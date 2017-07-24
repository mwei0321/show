<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  点赞
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月13日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use Yii;
    use common\models\Praise;

    class PraiseController extends CommonController{

        function init(){
            parent::init();
            $this->_showMsg = '';
        }

        /**
         * 动态点赞
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午7:59:23
        **/
        function actionShowpraise(){
            $showId = Yii::$app->request->get('show_id',0);

            //判断是否点过
            Praise::$_tableName = 'show_praise';
            $praiseObj = Praise::find()->where([
                'show_id'    => $showId,
                'member_id'     => $this->mid,
            ])->one();
            //写入更新点赞
            if($praiseObj){
                $praiseObj->status = !($praiseObj->status);
            }else{
                $praiseObj = (new Praise());
                $praiseObj->show_id  = $showId;
                $praiseObj->member_id   = $this->mid;
                $praiseObj->status      = 1;
            }
            if(!$praiseObj->save(false)){
                $this->_reCode = 400;
                $this->_returnJson();
            }
            //更新点赞数
            $count = Praise::find()->where(['show_id'=>$showId])->sum('status');
            $showObj = \common\models\Show::findOne($showId);
            $showObj->praise = $count;
            if($showObj->save(false)){
                return $this->_returnJson(['praiseNum'=>$count]);
            }
            $this->_reCode = 400;
            $this->_returnJson();
        }

        /**
         * 演员点赞
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午7:59:23
        **/
        function actionActorpraise(){
            $actorId = Yii::$app->request->get('actor_id',0);

            //判断是否点过
            Praise::$_tableName = 'actor_praise';
            $praiseObj = Praise::find()->where([
                'actor_id'    => $actorId,
                'member_id'     => $this->mid,
            ])->one();
            //写入更新点赞
            if($praiseObj){
                $praiseObj->status = !($praiseObj->status);
            }else{
                $praiseObj = (new Praise());
                $praiseObj->actor_id  = $actorId;
                $praiseObj->member_id   = $this->mid;
                $praiseObj->status      = 1;
            }
            if(!$praiseObj->save(false)){
                $this->_reCode = 400;
                $this->_returnJson();
            }
            //更新点赞数
            $count = Praise::find()->where(['actor_id'=>$actorId])->sum('status');
            $actorObj = \common\models\Actor::findOne($actorId);
            $actorObj->praise = $count;
            if($actorObj->save(false)){
                return $this->_returnJson(['praiseNum'=>$count]);
            }
            $this->_reCode = 400;
            $this->_returnJson();
        }

        /**
         * 动态点赞
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月13日 下午7:59:23
        **/
        function actionDynamicpraise(){
            $dynamicId = Yii::$app->request->get('dyid',0);

            //判断是否点过
            Praise::setTableName('dynamic_praise');
            $praiseObj = Praise::find()->where([
                'dynamic_id'    => $dynamicId,
                'member_id'     => $this->mid,
            ])->one();
//             ->createCommand()->getRawSql();
            //写入更新点赞
            if($praiseObj){
                $praiseObj->status = !($praiseObj->status);
            }else{
                $praiseObj = (new Praise());
                $praiseObj->dynamic_id  = $dynamicId;
                $praiseObj->member_id   = $this->mid;
                $praiseObj->status      = 1;
            }

            if(!$praiseObj->save(false)){
                $this->_reCode = 400;
                $this->_returnJson();
            }
            //更新点赞数
            $count = Praise::find()->where(['dynamic_id'=>$dynamicId])->sum('status');
            $dynamicObj = \common\models\Dynamic::findOne($dynamicId);
            $dynamicObj->praise = $count;
            if($dynamicObj->save(false)){
                return $this->_returnJson(['praiseNum'=>$count]);
            }
            $this->_reCode = 400;
            $this->_returnJson();
        }
    }