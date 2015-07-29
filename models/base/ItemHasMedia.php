<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "item_has_media".
 *
 * @property integer $item_id
 * @property integer $media_id
 * @property integer $order
 *
 * @property \app\models\base\Item $item
 * @property \app\models\base\Media $media
 */
class ItemHasMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_has_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'media_id'], 'required'],
            [['item_id', 'media_id', 'order'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => Yii::t('app', 'Item ID'),
            'media_id' => Yii::t('app', 'Media ID'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(\app\models\base\Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(\app\models\base\Media::className(), ['id' => 'media_id']);
    }
}
