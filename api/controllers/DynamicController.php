<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  动态接口控制器
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月6日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use api\controllers\CommonController;
    use Yii;
    use common\models\ApiDynamic;

    class DynamicController extends CommonController{

        /**
         * 获取动态列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:34:31
        **/
        function actionGetdynamiclist(){
            $where = [];
            $where['status'] = 1;

            //返回节目列表
            $dynamicM = new ApiDynamic();
            $this->_count = $dynamicM->getDynamicList($where);
            if($this->_count < 1){
                $this->_reCode = 204;
                return $this->_returnJson();
            }
            $pages = page($this->_count,20);
            $lists = $dynamicM->getDynamicList($where,$pages['offset']);

            return $this->_returnJson($lists);
        }

        /**
         * 获取动态详情
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月6日 下午3:05:28
        **/
        function actionGetdynamicinfo(){
            $dynamicId = Yii::$app->request->get('dyid',0);

            $info = [];
            if($dynamicId > 0){
                $info = (new ApiDynamic())->getDynamicInfoById($dynamicId);
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'id errors->'.$dynamicId;
            }

            //增加阅读数
            (new ApiDynamic())->IncDynamicReadNum($dynamicId);

            return $this->_returnJson($info);
        }
    }