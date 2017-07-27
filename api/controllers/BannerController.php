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