<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@2.6.12/dist/vue.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue.min.js"></script>
    <script src = "https://unpkg.com/bootstrap-vue@2.21.2/dist/bootstrap-vue-icons.min.js" > </script>

    <script src="https://unpkg.com/konva@8/konva.min.js"></script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body class="d-flex flex-column h-100">
 <?= \app\widgets\Menu::widget()?>
<?php $this->beginBody() ?>
<main role="main" class="flex-shrink-0 container-fluid">
    <div class="row  h-100">
       <div class="col-auto col-md-1 px-sm-2 px-0 bg-dark text-light h-100 shadow-lg">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3  min-vh-100 pt-2 text-white">

            </div>
        </div>
        <div class="container col py-3"">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</main>
<footer class="footer mt-auto py-3 text-muted bg-dark ">
    <div class="container">
        <p class="float-left">&copy; Cseri Gábor <?= date('Y') ?> Szakdolgozat</p>
        <p class="float-right"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
