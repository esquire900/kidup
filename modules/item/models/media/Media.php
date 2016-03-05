<?php

namespace item\models\media;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "media".
 */
class Media extends MediaBase
{
    public function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->created_at = Carbon::now(\Yii::$app->params['serverTimeZone'])->timestamp;
        }
        $this->updated_at = Carbon::now(\Yii::$app->params['serverTimeZone'])->timestamp;
        return parent::beforeValidate();
    }
}