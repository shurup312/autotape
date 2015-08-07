<?php
namespace frontend\controllers;

use frontend\models\MetaTag;
use Exception;
use frontend\models\Image;
use Yii;
use frontend\models\Work;
use frontend\models\search\WorkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WorksController implements the CRUD actions for Work model.
 */
class WorksController extends Controller
{

	public $uploadPath = '/images/works/';

	public function behaviors()
	{
		return [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Work models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel  = new WorkSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render(
			'index', [
					   'searchModel'  => $searchModel,
					   'dataProvider' => $dataProvider,
				   ]
		);
	}

	/**
	 * Displays a single Work model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render(
			'view', [
					  'model' => $this->findWorkModel($id),
				  ]
		);
	}

	/**
	 * Creates a new Work model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$workModel = new Work();
		$metaModel = new MetaTag();
		try {
			if (!$workModel->load(Yii::$app->request->post())) {
				throw new Exception();
			}
			if (!$metaModel->load(Yii::$app->request->post())) {
				throw new Exception();
			}
			$workModel->setScenario('add');
			$workModel = $this->uploadImageByName($workModel, 'image1');
			if (!$workModel->image1) {
				throw new Exception();
			}
			$workModel = $this->uploadImageByName($workModel, 'image2');
			$workModel = $this->saveImageAndGetIdByWork($workModel, 'image1');
			if ($workModel->image2) {
				$workModel = $this->saveImageAndGetIdByWork($workModel, 'image2');
			}
			$workModel->user_id = \yii::$app->user->id;
			if (!$workModel->save()) {
				throw new Exception();
			}
			$metaModel->link = '/work/'.$workModel->id;
			if (!$metaModel->save()) {
				throw new Exception();
			}
			return $this->redirect(
				[
					'index',
				]
			);
		} catch(Exception $e) {

		}
		return $this->render(
			'create', [
						'workModel' => $workModel,
						'metaModel' => $metaModel,
					]
		);
	}

	/**
	 * Updates an existing Work model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$workModel = $this->findWorkModel($id);
		$metaModel = $this->findMetaModel($id);
		try {
			if (!$workModel->load(Yii::$app->request->post())) {
				throw new Exception();
			}
			if (!$metaModel->load(Yii::$app->request->post())) {
				throw new Exception();
			}
			$workModel = $this->uploadImageByName($workModel, 'image1');
			if (!$workModel->image1) {
				throw new Exception();
			}
			$workModel = $this->uploadImageByName($workModel, 'image2');
			$workModel = $this->saveImageAndGetIdByWork($workModel, 'image1');
			if ($workModel->image2) {
				$workModel = $this->saveImageAndGetIdByWork($workModel, 'image2');
			}
			$workModel->user_id = \yii::$app->user->id;
			if (!$workModel->save()) {
				throw new Exception();
			}
			$metaModel->link = '/work/'.$workModel->id;
			if (!$metaModel->save()) {
				throw new Exception();
			}
			return $this->redirect(
				[
					'index',
				]
			);
		} catch(Exception $e) {
		}
		return $this->render(
			'update', [
						'workModel' => $workModel,
						'metaModel' => $metaModel,
					]
		);
	}

	/**
	 * Deletes an existing Work model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findWorkModel($id)
			 ->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Work model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Work the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findWorkModel($id)
	{
		if (($model = Work::findOne($id))!==null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	/**
	 * Finds the MetaTag model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return MetaTag the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findMetaModel($id)
	{
		if (($model = MetaTag::findOne($id))!==null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * @param Work $model
	 * @param      $name
	 *
	 * @return Work
	 */
	private function uploadImageByName($model, $name)
	{
		$image = UploadedFile::getInstance($model, $name);
		if(!$image){
			return $model;
		}
		$model->$name = $image;
		if ($model->$name && $model->validate()) {
			$model->$name->saveAs(Yii::getAlias('@webroot'.$this->uploadPath).$model->$name->baseName.'.'.$model->$name->extension);
		}
		return $model;
	}

	/**
	 * @param Work $model
	 * @param      $name
	 *
	 * @return Work
	 * @throws Exception
	 */
	private function saveImageAndGetIdByWork($model, $name)
	{
		if(!$model->$name instanceof UploadedFile){
			return $model;
		}
		$image           = new Image();
		$image->path     = $this->uploadPath;
		$image->filename = $model->$name->name;
		if (!$image->save()) {
			throw new Exception();
		}
		$model->$name = $image->id;
		return $model;
	}
}
