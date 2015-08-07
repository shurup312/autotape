<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $workModel frontend\models\Work */
/* @var $metaModel frontend\models\MetaTag */

$this->title = 'Обновление работы: ' . ' ' . $workModel->name;
$this->params['breadcrumbs'][] = ['label' => 'Работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'workModel' => $workModel,
        'metaModel' => $metaModel,
    ]) ?>

</div>
