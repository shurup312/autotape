<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $workModel frontend\models\Work */
/* @var $metaModel frontend\models\MetaTag */
/* @var $form yii\widgets\ActiveForm */
/* @var $image1Model \frontend\models\Image */
/* @var $image2Model \frontend\models\Image */
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($workModel, 'name')->textInput(['maxlength' => true]) ?>
	<?= $form->field($image1Model, 'filename')->fileInput(['name'=>'Image[image1]']) ?>
	<? if($image1Model): ?>
		<?= Html::img($image1Model->path.$image1Model->filename, ['class' => 'preview']); ?><br>
		<?=Html::hiddenInput('Image[image1]',$image1Model->id);?>
	<? endif ;?>
	<?= $form->field($image2Model, 'filename')->fileInput(['name'=>'Image[image2]']) ?>
	<? if($image2Model): ?>
		<?= Html::img($image2Model->path.$image2Model->filename, ['class' => 'preview']); ?><br>
		<?=Html::hiddenInput('Image[image2]',$image2Model->id);?>
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
