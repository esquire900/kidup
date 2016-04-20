<?php

namespace api\v2\models;

use item\models\item\Item;
use item\models\media\Media;
use user\models\profile\Profile;


/**
 * This is the base-model class for table "item_facet_value".
 *
 * @property integer $id
 * @property string $device_id
 * @property string $image_url
 * @property int $rating
 */
class KodeUp extends \app\components\models\BaseActiveRecord
{
    private $kfcServer = 'http://178.62.234.114';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kodeup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id', 'image_url', 'rating'], 'required'],
            [['image_url', 'device_id'], 'string'],
            [['rating'], 'integer', 'max' => 1000],
        ];
    }

    public function beforeSave($insert)
    {
        if(strpos($this->image_url, "/") > -1){
            $this->image_url = explode(".png", explode(".jpg", explode("/",  $this->image_url)[6])[0])[0];
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function getRecommendations($deviceId){
        $liked = KodeUp::find()->distinct('image_url')
            ->select('image_url')
            ->where(['device_id' => $deviceId])->indexBy('image_url')->where('rating=1')->asArray()->all();
        $disLiked = KodeUp::find()->distinct('image_url')
            ->select('image_url')
            ->where(['device_id' => $deviceId])->indexBy('image_url')->where('rating=1')->asArray()->all();
        $url =$this->kfcServer."/kodup_kfc/php_wrapper.php";
        $data = [
            'like' => array_keys($liked),
            'dislike' => array_keys($disLiked)
        ];

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = json_decode(file_get_contents($url, false, $context));
        return array_reverse($result);
    }

    public function filterHadBefore($deviceId, $recommendedSet){
        $hadBefore = KodeUp::find()
            ->select('image_url')
            ->where(['device_id' => $deviceId])->indexBy('image_url')->asArray()->all();
        if(count($hadBefore) > 0){
            $hadBefore = array_keys($hadBefore);
        }
        return $this->removeFromSet($recommendedSet, $hadBefore);
    }

    public function filterChicks($set){
        $hadBefore =  Profile::find()->where('img != "kidup/user/default-face.jpg"')
            ->asArray()->select('img')->indexBy('img')
            ->all();
        if(count($hadBefore) > 0){
            $hadBefore = array_keys($hadBefore);
        }
        return $this->removeFromSet($set, $hadBefore);
    }

    public function filterMedia($set){
        $hadBefore =  Media::find()
            ->asArray()->select('file_name')->indexBy('file_name')
            ->all();
        if(count($hadBefore) > 0){
            $hadBefore = array_keys($hadBefore);
        }
        return $this->removeFromSet($set, $hadBefore);
    }

    private function removeFromSet($topSet, $toRemove){
        foreach ([$topSet, $toRemove] as &$set) {
            foreach ($set as &$item) {
                $item = explode("?", $item)[0];
                $item = str_replace(".jpg", '', $item);
                $item = str_replace(".png", '', $item);
            }
        }
        return array_diff($topSet, $toRemove);
    }
}
