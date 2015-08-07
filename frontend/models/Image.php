<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $path
 * @property string $filename
 * @property string $date_created
 * @property string $date_deleted
 *
 * @property Work[] $works
 * @property Work[] $works0
 */
class Image extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['path', 'filename'], 'required'],
            [['date_created', 'date_deleted'], 'safe'],
            [['path', 'filename'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя, загрузившего изображение',
            'path' => 'Путь до изображения',
            'filename' => 'Имя файла',
            'date_created' => 'Date Created',
            'date_deleted' => 'Date Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['image1' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks0()
    {
        return $this->hasMany(Work::className(), ['image2' => 'id']);
    }
}
