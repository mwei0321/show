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


        function actionGetbanner(){
            $banner = Banner::find()->where(['status'=>1])->orderBy('sort DESC')->asArray()->all();
            //数据处理
            foreach ($banner as $k => $v){
                $banner[$k]['imgUrl']       = ImageUrl.$v['imgUrl'];
                $banner[$k]['banner_id']    = $v['id'];
                unset($banner[$k]['ctime']);
                unset($banner[$k]['id']);
            }

            $this->_returnJson($banner);
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