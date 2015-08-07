<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "works".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $image1
 * @property integer $image2
 * @property string $description
 * @property string $date_created
 * @property string $date_deleted
 *
 * @property Image $image10
 * @property Image $image20
 */
class Work extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required','message'=>'{attribute} необходимо заполнить'],
            [['image1'], 'required','message'=>'{attribute} необходимо заполнить','on'=>'add'],
            [['description'], 'string'],
            [['date_created', 'date_deleted'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь, добавивший работу',
            'name' => 'Имя работы',
            'image1' => 'Первое изображение работы',
            'image2' => 'Второе изображение работы',
            'description' => 'Описание работы',
            'date_created' => 'Date Created',
            'date_deleted' => 'Date Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage1()
    {
        return $this->hasOne(Image::className(), ['id' => 'image1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage2()
    {
        return $this->hasOne(Image::className(), ['id' => 'image2']);
    }


}
