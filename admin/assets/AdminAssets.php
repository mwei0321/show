<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  后台 css, js等文件载入管理
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月11日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    namespace admin\assets;
    use yii\web\AssetBundle;

    class AdminAssets extends AssetBundle {

        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'css/bootstrap.css',
            'css/custom.css',
            'css/font-awesome.min.css',
            'css/landing.css',
            'css/plugin.css',
            'css/style.css',
        ];
        public $js = [
            //jquery
//             'js/jquery.min.js',
            //html5
            'js/ie/respond.min.js',
            'js/ie/html5.js',
            //Bootstrap
            'js/bootstrap.js',
            //app
            'js/app.js',
            'js/app.plugin.js',
//             'js/app.data.js',
            //Sparkline Chart
            'js/charts/sparkline/jquery.sparkline.min.js',
            //Easy Pie Chart
            'js/charts/easypiechart/jquery.easy-pie-chart.js',
            'js/ie/excanvas.js',
            //check form value not null
//             'js/mwForm.js'
            'js/mwlayer.js',
            'js/adminPublic.js',
        ];
    }