<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $workModel frontend\models\Work */
/* @var $metaModel frontend\models\MetaTag */
/* @var $form yii\widgets\ActiveForm */
$image1 = $workModel->getImage1()->one();
$image2 = $workModel->getImage2()->one();
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($workModel, 'name')->textInput(['maxlength' => true]) ?>
	<?= $form->field($workModel, 'image1')->fileInput() ?>
	<? if($image1): ?>
		<?= Html::img($image1->path.$image1->filename, ['class' => 'preview']); ?><br>
		<?=$form->field($workModel,'image1')->hiddenInput(['value'=>$image1->id])->label('');?>
	<? endif ;?>
	<?= $form->field($workModel, 'image2')->fileInput(); ?>
	<? if($image2): ?>
		<?=Html::img($image2->path.$image2->filename,['class'=>'preview']);?>
		<?=$form->field($workModel,'image2')->hiddenInput(['value'=>$image2->id])->label('');?>
	<? endif ;?>

    <?= $form->field($workModel, 'description')->textarea(['rows' => 6]) ?>
	<?= $form->field($metaModel, 'title')->textInput(['maxlength' => true]) ?>
	<?= $form->field($metaModel, 'keywords')->textInput(['maxlength' => true]) ?>
	<?= $form->field($metaModel, 'description')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($workModel->isNewRecord ? 'Создать' : 'Обновить', ['class' => $workModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<style type="text/css">
	.preview {
		width: 300px;
	}
</style>
