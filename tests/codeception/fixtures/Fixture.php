<?php
namespace app\tests\codeception\fixtures;

use yii\test\ActiveFixture;

class Fixture extends ActiveFixture
{
    public function unload(){
        return true;
    }
}