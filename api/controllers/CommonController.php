<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  API公用入口
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月19日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace api\controllers;
    use yii\base\Controller;
    use Yii;

    class CommonController extends Controller{
        public $_reCode = 200;
        public $_reMsg  = '';
        public $_count  = 0;

        /**
         * 检查用户登录
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月19日 上午11:18:47
        **/
        function _checkUser(){

        }

        /**
         * json返回数据
         * @param  array
         * @param  string
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月19日 上午11:03:11
        **/
        function _returnJson($_data = [],$_addData = []){
            $data = [
                'code'  =>  $this->_reCode,
                'msg'   =>  $this->_reCodeMsg(),
                'count' =>  $this->_count,
                'data'  =>  $_data,
            ];
            //合并数据
            $data = array_merge($data,$_addData);
            //格式化为json输入
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        }

        /**
         * 返回提示信息
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月19日 上午11:06:36
        **/
        private function _reCodeMsg(){
            $codeMsg = [
                //请求成功
                '200'   =>  '请求成功！',
                '204'   =>  '请求成功！,数据为空',
                //请求失败
                '400'   =>  '请求失败！',
                '401'   =>  '请求失败，没有登录！',
                '440'   =>  '请求参数错误:'.$this->_reMsg,
            ];

            return $codeMsg[$this->_reCode];
        }
    }
