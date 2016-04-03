<?php
namespace api\v2\controllers;

use api\v2\models\Review;

class ReviewController extends Controller
{
    public function init()
    {
        $this->modelClass = Review::className();
        parent::init();
    }

    public function accessControl()
    {
        return [
            'guest' => ['index', 'view', 'create'],
            'user' => ['update']
        ];
    }


    public function actions()
    {
        $actions = parent::actions();

        return $actions;
    }
}