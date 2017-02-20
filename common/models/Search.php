<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  搜索处理
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年2月17日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use yii\db\ActiveRecord;

    class Search extends ActiveRecord{

        static function tableName(){
            return 'show';
        }

        /**
         * 搜索演出
         * @param  string $_keyword
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月17日 上午10:42:13
        **/
        function searchShow($_keyword){
            $showlist = self::find()->select('id show_id,title,cover')->where(['like','title',$_keyword])->orderBy('id DESC')->asArray()->all();
            if($showlist){
                $showM = new \common\models\Show();
                foreach ($showlist as $k => $v){
                    //写入演出时间范围
                    $times = $showM->getShowExpire($v['show_id']);
                    $showlist[$k]['stime'] = date('Y-m-d',$times['stime']);
                    $showlist[$k]['etime'] = date('Y-m-d',$times['etime']);
                    //头像
                    $showlist[$k]['cover'] = ImageUrl.$v['cover'];
                }
            }else
                return [];
            return $showlist;
        }

        /**
         * 搜索演员
         * @param  string $_keyword
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月17日 上午10:43:58
        **/
        function searchActor($_keyword){
            $actorlist = self::find()->select('id actor_id,name,avatar')
                        ->from('actor')
                        ->where(['like','name',$_keyword])
                        ->orderBy('id DESC')
                        ->asArray()->all();

            if($actorlist){
                foreach ($actorlist as $k => $v){
                    //头像
                    $actorlist[$k]['avatar'] = ImageUrl.$v['avatar'];
                }
            }else
                return [];
            return $actorlist;
        }

        /**
         * 动态
         * @param  string $_keyword
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年2月17日 上午10:52:35
        **/
        function searchDynamic($_keyword){
            $dynamiclist = self::find()->select('id dynamic_id,title,cover')
                        ->from('dynamic')
                        ->where(['like','title',$_keyword])
                        ->orderBy('id DESC')
                        ->asArray()->all();

            if($dynamiclist){
                foreach ($dynamiclist as $k => $v){
                    //封面处理
                    $dynamiclist[$k]['cover'] = ImageUrl.$v['cover'];
                }
            }else
                return [];

            return $dynamiclist;
        }
    }
