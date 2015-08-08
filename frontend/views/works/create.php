<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $workModel frontend\models\Work */
/* @var $metaModel frontend\models\MetaTag */
/* @var $image1Model frontend\models\Image */
/* @var $image2Model frontend\models\Image */

$this->title = 'Создать работу';
$this->params['breadcrumbs'][] = ['label' => 'Работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'workModel' => $workModel,
        'metaModel' => $metaModel,
        'image1Model' => $image1Model,
        'image2Model' => $image2Model,
    ]) ?>

</div>
