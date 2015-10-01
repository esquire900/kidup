<?php

namespace app\assets;
use yii\web\AssetBundle;
/**
 * Asset for the lodash library
 */
class LodashAsset extends AssetBundle
{
    public $sourcePath = '@bower/lodash';
    public $js = [
        'lodash.js',
    ];
}