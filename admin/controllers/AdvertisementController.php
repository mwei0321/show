<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  售票情况相关
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月20日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace admin\controllers;
    use Yii;
    use yii\web\Controller;
    use common\models\Ticket;
    use yii\helpers\Url;
    use common\models\CommonModel;

    class AdvertisementController extends SiteController{

        function actionManager(){
            return $this->render('manager');
        }
		
		
        function actionAdvlist(){
            return $this->render('advlist');
        }
		
        function actionEdit(){
            return $this->render('edit');
        }

    }
