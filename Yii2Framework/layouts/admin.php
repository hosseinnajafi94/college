<?php
use yii\helpers\Html;
use app\assets\AdminAsset;
use app\config\widgets\Alert;
use app\config\widgets\Breadcrumbs;
use app\config\components\functions;
use app\modules\site\models\SRL\SiteSettingsSRL;
/* @var $this \yii\web\View */
/* @var $content string */
AdminAsset::register($this);
$settings    = SiteSettingsSRL::get();
$user        = Yii::$app->user;
$title       = [$settings->title];
$breadcrumbs = [];
if (isset($this->params['breadcrumbs'])) {
    $breadcrumbs = $this->params['breadcrumbs'];
}
foreach ($breadcrumbs as $breadcrumb) {
    if (is_string($breadcrumb)) {
        $title[] = $breadcrumb;
    }
    else if (is_array($breadcrumb) && isset($breadcrumb['label'])) {
        $title[] = $breadcrumb['label'];
    }
}
$this->title = implode(' / ', $title);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?= Html::csrfMetaTags() ?>
        <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web/uploads/settings/favicon/' . $settings->favicon) ?>"/>
        <link rel="shortcut icon" type="image/ico" href="<?= Yii::getAlias('@web/uploads/settings/favicon/' . $settings->favicon) ?>"/>
        <title><?= $this->title ?></title>
        <script>var urlLoading = '<?= Yii::getAlias('@web/themes/default/images/loading.gif') ?>';</script>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header <?= (isset($_COOKIE['cls']) ? ' h' : '') ?>">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?= Html::a($settings->title, ['/dashboard/default/index'], ['class' => 'navbar-brand']) ?>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="hidden-xs"><a onclick="toggleMenuCookie();"><i class="fa fa-bars"></i></a></li>
                    <li><a style="cursor: default;direction: ltr;">امروز: <?= functions::datestring() ?></a></li>
                    <li><a style="cursor: default;direction: ltr;"><span id="hours" style="width: 20px;display: inline-block;text-align: center;"><?= date('H') ?></span>:<span id="min" style="width: 20px;display: inline-block;text-align: center;"><?= date('i') ?></span>:<span id="sec" style="width: 20px;display: inline-block;text-align: center;"><?= date('s') ?></span></a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-left">
                    <li><?= !$user->isGuest ? Html::a('<i class="fa fa-fw fa-user"></i> ' . Yii::t('users', 'Profile'), ['/users/profile/index']) : '' ?></li>
                    <li><?= !$user->isGuest ? Html::a('<i class="fa fa-fw fa-sign-out-alt"></i> ' . Yii::t('users', 'Logout'), ['/users/auth/logout'], ['data' => ['method' => 'post']]) : '' ?></li>
                </ul>
            </nav>
            <div class="sidebar <?= (isset($_COOKIE['cls']) ? ' h' : '') ?>" role="navigation">
                <div class="sidebar-nav navbar-collapse collapse">
                    <ul class="nav" id="side-menu">
                        <?php
                        echo !$user->isGuest     ? '<li>' . Html::a('<i class="fa fa-fw fa-tachometer-alt"></i> ' . Yii::t('dashboard', 'Dashboard')  , ['/dashboard/default/index'])  . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-users"></i> '          . Yii::t('users', 'Users Statuses') , ['/users/users-status/index']) . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-users"></i> '          . Yii::t('users', 'Users Groups')   , ['/users/users-groups/index']) . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-users"></i> '          . Yii::t('users', 'Users')          , ['/users/users/index'])        . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-user"></i> '           . Yii::t('users', 'Create New User'), ['/users/users/create'])       . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-users"></i> '          . Yii::t('users', 'Clerk')          , ['/users/clerk/index'])        . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-users"></i> '          . Yii::t('users', 'Teacher')        , ['/users/teacher/index'])      . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-users"></i> '          . Yii::t('users', 'Student')        , ['/users/student/index'])      . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-cogs"></i> '           . Yii::t('site', 'Site Settings')   , ['/site/settings/index'])      . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms Classes Lists')  , ['/terms/terms-classes-list/index'])  . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms Books Lists')    , ['/terms/terms-books-list/index'])    . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms Statuses Lists') , ['/terms/terms-statuses-list/index']) . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms')               , ['/terms/terms/index'])               . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms Students')      , ['/terms/terms-students/index'])      . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms Meetings')      , ['/terms/terms-meetings/index'])      . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms Meetings Absenteeisms')      , ['/terms/terms-meetings-absenteeism/index'])      . '</li>' : '';
                        echo $user->can('admin') ? '<li>' . Html::a('<i class="fa fa-fw fa-"></i> '               . Yii::t('terms', 'Terms Payments')      , ['/terms/terms-payments/index'])      . '</li>' : '';
                        ?>
                    </ul>
                </div>
            </div>
            <div id="page-wrapper" class="<?= (isset($_COOKIE['cls']) ? ' h' : '') ?>">
                <?= Breadcrumbs::widget(['links' => $breadcrumbs]) ?>
                <div class="container-fluid">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </div>
        <div id="modelIndex0" class="modal" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header white" style="background: #1bbc9b;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <a class="back"><i class="fa fa-fw fa-arrow-right"></i></a>
                        <span></span>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer bg-white" style="padding: 8px 15px;text-align: right;">
                        <a class="btn btn-sm btn-warning" data-dismiss="modal"><?= Yii::t('app', 'Close') ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
