<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  banner接口API
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月12日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use common\models\Banner;

    class BannerController extends CommonController{

        /**
         * 获取banner
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月24日 上午9:54:30
        **/
        function actionGetbanner(){
            $banner = Banner::getBannerList();

            $this->_returnJson($banner);
        }

        /**
         * 广告详情
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月27日 下午5:11:01
        **/
        function actionGetadvertinfo(){
            $advertId = \Yii::$app->request->get('advert_id',0);

            $advertInfo = [];
            if($advertId > 0){
                //节目详情
                $advertInfo = \common\models\Advert::find()->where(['id'=>$advertId])->asArray()->one();
                $advertInfo['advert_id'] = $advertInfo['id'];
                $advertInfo['cover'] = ImageUrl.$advertInfo['cover'];
                $advertInfo['ctime'] = date('Y-m-d H:i',$advertInfo['ctime']);
                unset($advertInfo['id']);
            }else{
                $this->_reCode = 440;
                $this->_reMsg = 'id errors->'.$advertId;
            }

            return $this->_returnJson($advertInfo);
        }

        /**
         * 获取启动图片logo
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月20日 上午10:11:18
        **/
        function actionGetstartlogo(){
            \common\models\CommonM::setTabelName('start_logo');
            $startlogo = \common\models\CommonM::find()->where(['id'=>1])->asArray()->one();

            $this->_returnJson(['startlogo'=>ImageUrl.$startlogo['path']]);
        }
    }