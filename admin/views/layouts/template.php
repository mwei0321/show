<?php
   /**
	*  +----------------------------------------------------------------------------------------------+
	*   | Explain:  话剧演出公共模板
	*  +----------------------------------------------------------------------------------------------+
	*   | Author: MaWei <1123265518@qq.com>
	*  +----------------------------------------------------------------------------------------------+
	*   | Creater Time : 2017年1月11日
	*  +----------------------------------------------------------------------------------------------+
	*   | Link :		http://www.phpython.com
	*  +----------------------------------------------------------------------------------------------+
	**/

    use yii\helpers\Html;
    use admin\assets\AdminAssets;
    use yii\helpers\Url;

    AdminAssets::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="utf-8">
    <meta name="description" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script type="text/javascript" src="/js/jquery.min.js"></script>
</head>
<body>

<?php $this->beginBody() ?>
<!-- header -->

<header id="header" class="navbar">

	<img class="logo-top" src="/images/logo-top.png">
    <ul class="nav navbar-nav navbar-avatar pull-right">

        <li class="dropdown">

            <a class="logout" href="<?= Url::toRoute(['site/logout']) ?>">注销</a>

            <ul class="dropdown-menu">

                <li><a href="#">Settings</a></li>

                <li><a href="#">Profile</a></li>

                <li><a href="#"><span class="badge bg-danger pull-right">3</span>Notifications</a></li>

                <li class="divider"></li>

                <li><a href="docs.html">Help</a></li>

                <li><a href="signin.html">Logout</a></li>

            </ul>

        </li>

    </ul>

    <button type="button" class="btn btn-link pull-left nav-toggle hidden-lg" data-toggle="class:slide-nav slide-nav-left" data-target="body">

        <i class="icon-reorder icon-xlarge text-default"></i>

    </button>



    </li>

    </ul>


</header>

<!-- / header -->

<!-- nav -->

<nav id="nav" class="nav-primary visible-lg nav-vertical">

    <ul class="nav" data-spy="affix" data-offset-top="50">
        <?php ?>
        <li class="<?php if(Yii::$app->controller->id == 'show') echo 'active';?>"><a href="<?= Url::toRoute(['show/index']) ?>"><i class="icon-dashboard icon-xlarge"></i>演出管理</a></li>
        <li class="<?php if(Yii::$app->controller->id == 'actor') echo 'active';?>"><a href="<?= Url::toRoute(['actor/index']) ?>"><i class="icon-dashboard icon-xlarge"></i>演员管理</a></li>
        <li class="<?php if(Yii::$app->controller->id == 'dynamic') echo 'active';?>"><a href="<?= Url::toRoute(['dynamic/index']) ?>"><i class="icon-dashboard icon-xlarge"></i>剧场动态管理</a></li>
        <li class="<?php if(Yii::$app->controller->id == 'banner') echo 'active';?>"><a href="<?= Url::toRoute(['banner/index']) ?>"><i class="icon-dashboard icon-xlarge"></i>广告位管理</a></li>
    </ul>

</nav>

<!-- / nav -->

<section id="content">

    <?= $content ?>
</section>

<!-- .modal -->

<div id="modal" class="modal fade">

    <form class="m-b-none">

        <div class="modal-dialog pos-abt" style="margin-top:-235px; top:50%">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>

                    <h4 class="modal-title" id="myModalLabel">Post your first idea</h4>

                </div>

                <div class="modal-body">

                    <div class="block">

                        <label class="control-label">Title</label>

                        <input type="text" class="form-control" placeholder="Post title">

                    </div>

                    <div class="block">

                        <label class="control-label">Content</label>

                        <textarea class="form-control" placeholder="Content" rows="5"></textarea>

                    </div>

                    <div class="checkbox">

                        <label>

                            <input type="checkbox"> Share with all memebers of first

                        </label>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-small btn-default" data-dismiss="modal">Save</button>

                    <button type="button" class="btn btn-small btn-primary" data-loading-text="Publishing...">Publish</button>

                </div>

            </div><!-- /.modal-content -->

        </div>

    </form>

</div>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>