<?php

namespace api\v2\models;

use images\components\ImageHelper;
use item\models\itemHasMedia\ItemHasMedia;
use item\models\itemSimilarity\ItemSimilarity;
use item\models\wishListItem\WishListItem;
use yii\helpers\Json;

/**
 * This is the model class for table "item".
 */
class Item extends \item\models\item\Item
{

    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            'default' => ['owner_id']
        ]);
    }

    public function beforeValidate()
    {
        if (!isset($this->category_id)) {
            $this->category_id = 44;
        }
        if ($this->isNewRecord) {
            $this->owner_id = \Yii::$app->user->id;
        }
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function extraFields()
    {
        return ['owner', 'category', 'location', 'currency', 'media', 'similarItems'];
    }

    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    public function getMedia()
    {
        return $this->hasMany(Media::className(), ['id' => 'media_id'])
            ->viaTable('item_has_media', ['item_id' => 'id']);
    }

    public function getSimilarItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id_2'])
            ->viaTable(ItemSimilarity::tableName(), ['item_id_1' => 'id'], function ($query) {
                $query->orderBy("similarity DESC")->limit(4);
            });
    }
}
