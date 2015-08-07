<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "meta_tags".
 *
 * @property integer $id
 * @property string $link
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $date_created
 * @property string $date_deleted
 */
class MetaTag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meta_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'title', 'description', 'keywords'], 'required'],
            [['date_created', 'date_deleted'], 'safe'],
            [['link', 'title', 'description', 'keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Ссылка',
            'title' => 'Заголовок страницы',
            'description' => 'Description meta-тэг',
            'keywords' => 'Keywords meta-тэг',
            'date_created' => 'Date Created',
            'date_deleted' => 'Date Deleted',
        ];
    }
}
