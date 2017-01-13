<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  上传操作模型
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月13日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace common\models;
    use Yii;
use function Faker\unique;

    class Uploade{
        //文件名前缀
        public $filePrefix = 'mw';
        //文件名
        public $fileName;
        //最大文件大小
        public $maxSize = 20971520;
        //文件大小
        public $size;
        //上传文件夹根路径
        public $absRootPath;
        //文件绝对路径
        public $fileAbsPath;
        //文件路径
        public $path;
        //接收的Key
        public $upKey = 'file';
        //过滤接收文件类型
        public $filterExe = ['gif','jpg','jpeg','bmp','png','swf','txt','xls','doc','xlsx','docx','zip','rar','7z'];
        //文件对象
        public $fileObj;

        function __construct($_path,$_config = []){
            //主项目根目录
            $this->absRootPath = str_replace('\\', '/', dirname(Yii::$app->basePath)).'/upload';
            //获取文件对象
            isset($_config['upKey']) && $this->upKey = $_config['upkey'];
            $this->fileObj = @$_FILES[$this->upKey];
            //过滤接收文件类型
            isset($_config['filterExe']) && $this->filterExe = $_config['filterExe'];
            //初始化文件上传相对路
            $this->_initPath($_path);
            //文件过滤检查
            $this->_checkFile();
        }

        /**
         * 上传图片
         * @param  string $_path;
         * @param  string $_filename;
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午2:56:34
        **/
        function uploadeImg($_fileName = null){
            //文件绝对路径
//             $this->filePrefix.date('YmdHis').rand(2000,99999).$this->fileObj['extension'];
            $this->fileName = autoCharset(($_fileName ? $_fileName : $this->fileObj['name']),'utf-8','gbk');
            $this->fileAbsPath = $this->absRootPath.$this->path.$this->fileName;
            if(!move_uploaded_file($this->fileObj['tmp_name'], $this->fileAbsPath)) {
                return false;
            }
            return [
                'fileName'  =>  $this->fileName,
                'size'      =>  $this->size,
                'path'      =>  $this->path.$this->fileName,
            ];
        }

        /**
         * 返回文件的后缀名
         * @param string $_file
         * @return string $exname
         * @author MaWei ( http://www.phpyrb.com )
         * @date 2014-4-17 下午1:50:15
         */
        protected function _getFileExeName($_file){
            $file = basename($_file);
            $exname = substr(strrchr($file,'.'), 1);
            return  strtolower($exname);
        }

        /**
         * 文件过滤检查
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午3:50:53
        **/
        protected function _checkFile(){

            $this->size = $this->fileObj['size'];
            //过滤文件大小
            if($this->size > $this->maxSize || $this->size == -1){
                return -2;//文件太大
            }
            $fileExeName = $this->_getFileExeName($this->fileObj['name']);
            //过滤文件类型
            if(!in_array($fileExeName,$this->filterExe)){
                return -1;//文件类型错误
            }
        }

        /**
         * 初始化文件上传路径
         * @return array
         * @author MaWei (http://www.phpython.com)
         * @date 2017年1月13日 下午3:22:21
        **/
        protected function _initPath($_path){
            //文件路径
            $path = [
                'showimg'   =>  '/showimg/',
                'actorimg'  =>  '/actorimg/',
            ];

            $this->path = $path[$_path].date('Y').'/';
            createDir($this->absRootPath.$this->path);
        }
    }