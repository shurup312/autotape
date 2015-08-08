<?php
namespace frontend\models\storages;

use frontend\models\Image;
use Yii;
use yii\base\Object;
use yii\web\UploadedFile;

/**
 * User: Oleg Prihodko
 * Mail: shuru@e-mind.ru
 * Date: 08.08.2015
 * Time: 21:48
 */

/**
 * Class ImageStorage
 * @package frontend\storages
 *
 */
class ImageStorage extends Object
{
	public $filename;
	public $uploadPath = '/images/works/';
	/**
	 * @var UploadedFile $uploadedFile
	 */
	private $uploadedFile;
	private $model;

	/**
	 * @param Image $model
	 */
	public function __construct(Image &$model)
	{
		$this->model = $model;
	}
	public function save()
	{
		$this->filename = $this->uploadedFile->baseName.'.'.$this->uploadedFile->extension;
		if($this->uploadedFile->saveAs(Yii::getAlias('@webroot'.$this->uploadPath).$this->filename)){
			$this->model->filename = $this->filename;
			$this->model->path = $this->uploadPath;
			return true;
		}
		return false;
	}

	public function delete()
	{
		$path = Yii::getAlias('@webroot'.$this->uploadPath).$this->filename;
		if($this->filename && file_exists($path)){
			unlink($path);
		}
	}

	public function isSendFile($name)
	{
		$this->uploadedFile = UploadedFile::getInstance($this->model,$name);
		return (bool) $this->uploadedFile;
	}
}
