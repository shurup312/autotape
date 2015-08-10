<?php
namespace frontend\controllers;

use Faker\Provider\File;
use frontend\models\MetaTag;
use Exception;
use frontend\models\Image;
use frontend\models\storages\ImageStorage;
use Yii;
use frontend\models\Work;
use frontend\models\search\WorkSearch;
use yii\db\Transaction;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WorksController implements the CRUD actions for Work model.
 */
class WorksController extends Controller
{
	public $layout = 'admin';

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
		$image1Model = new Image();
		$image1Model->setScenario('add');
		$image2Model = new Image();
		$transaction = null;
		try {
			if (!$workModel->load(Yii::$app->request->post())) {
				throw new Exception();
			}
			$transaction = \yii::$app->getDb()->beginTransaction();
			$image1Storage = new ImageStorage($image1Model);
			$image2Storage = new ImageStorage($image2Model);

			if($image1Storage->isSendFile('image1') && $image1Storage->save()){
				$image1Model->save();
				$workModel->image1 = $image1Model->id;
			}

			if($image2Storage->isSendFile('image2') && $image2Storage->save()){
				$image2Model->save();
				$workModel->image2 = $image2Model->id;
			}

			if (!$workModel->save()) {
				throw new Exception();
			}

			$metaModel->load(Yii::$app->request->post());
			$metaModel->link = '/works/details/'.$workModel->id;
			if (!$metaModel->save()) {
				throw new Exception();
			}
			$transaction->commit();
			return $this->redirect(
				[
					'index',
				]
			);
		} catch(Exception $e) {
			if(isset($image1Storage)){
				$image1Storage->delete();
			}
			if(isset($image2Storage)){
				$image2Storage->delete();
			}
			if($transaction instanceof Transaction){
				$transaction->rollBack();
			}
		}
		return $this->render(
			'create', [
						'workModel' => $workModel,
						'metaModel' => $metaModel,
						'image1Model' => $image1Model,
						'image2Model' => $image2Model,
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
		$image1Model = $this->findImageModel($workModel->image1);
		$image2Model = $this->findImageModel($workModel->image2);
		$image1Storage = new ImageStorage($image1Model);
		$image2Storage = new ImageStorage($image2Model);
		$transaction = null;
		try {
			if (!$workModel->load(Yii::$app->request->post())) {
				throw new Exception();
			}
			$transaction = \yii::$app->getDb()->beginTransaction();

			if($image1Storage->isSendFile('image1') && $image1Storage->save()){
				$image1Model->save();
				$workModel->image1 = $image1Model->id;
			}

			if($image2Storage->isSendFile('image2') && $image2Storage->save()){
				$image2Model->save();
				$workModel->image2 = $image2Model->id;
			}

			if (!$workModel->save()) {
				throw new Exception();
			}

			$metaModel->load(Yii::$app->request->post());
			$metaModel->link = '/works/details/'.$workModel->id;
			if (!$metaModel->save()) {
				throw new Exception();
			}
			$transaction->commit();
			return $this->redirect(
				[
					'index',
				]
			);
		} catch(Exception $e) {
			$image1Storage->delete();
			$image2Storage->delete();
			if($transaction instanceof Transaction){
				$transaction->rollBack();
			}
		}
		return $this->render(
			'update', [
						'workModel' => $workModel,
						'metaModel' => $metaModel,
						'image1Model' => $image1Model,
						'image2Model' => $image2Model,
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
			throw new NotFoundHttpException('Запрошенная страница не найдена');
		}
	}
	/**
	 * Finds the Image model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Image the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findImageModel($id)
	{
		if($id===null){
			return new Image();
		}
		if (($model = Image::findOne($id))!==null) {
			return $model;
		} else {
			throw new NotFoundHttpException('Запрошенная страница не найдена');
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
			throw new NotFoundHttpException('Запрошенная страница не найдена');
		}
	}
}
