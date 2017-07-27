<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  广告栏操作模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年7月5日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.mawei.live
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class Banner extends ActiveRecord{

        static function tableName(){
            return 'banner';
        }

        /**
         * 获取banner列表
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年7月26日 下午6:29:24
        **/
        static function getBannerList(){
            $bannerList = self::find()->orderBy('sort DESC')->asArray()->all();
            if($bannerList){
                foreach ($bannerList as $k => $v){
                    switch ($v['type']){
                        case 1:  //广告
                            $advert = \common\models\Advert::find()->select('title,cover')->where(['id'=>$v['obj_id']])->one();
                            $bannerList[$k]['title'] = $advert->title ?? '';
                            $bannerList[$k]['cover'] = $advert->cover ?? '';
                            break;
                        case 2:  //动态
                            $dynamic = \common\models\Dynamic::find()->select('title,cover')->where(['id'=>$v['obj_id']])->one();
                            $bannerList[$k]['title'] = $dynamic->title ?? '';
                            $bannerList[$k]['cover'] = $dynamic->cover ?? '';
                            break;
                        case 3:  //演出
                            $show = \common\models\Show::find()->select('title,cover')->where(['id'=>$v['obj_id']])->one();
                            $bannerList[$k]['title'] = $show->title ?? '';
                            $bannerList[$k]['cover'] = $show->cover ?? '';
                            break;
                    }
                    $bannerList[$k]['banner_id'] = $v['id'];
                    unset($bannerList[$k]['id']);
                }
            }

            return $bannerList;
        }
    }