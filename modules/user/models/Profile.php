<?php

namespace user\models;

use images\components\ImageHelper;
use Yii;
use yii\helpers\ArrayHelper;

class Profile extends base\Profile
{
    public $img;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name'], 'required'],
            [
                [
                    'user_id',
                    'email_verified',
                    'phone_verified',
                    'identity_verified',
                    'location_verified',
                    'currency_id',
                    'nationality',
                    'phone_country',
                    'phone_number'
                ],
                'integer'
            ],
            [['description'], 'string'],
            [['first_name'], 'string', 'max' => 128],
            [['last_name', 'img'], 'string', 'max' => 256],
            [['phone_country'], 'string', 'max' => 5],
            [['phone_number'], 'string', 'max' => 50],
            [['language'], 'string', 'max' => 6],
            [['img'], 'safe'],
            [['img'], 'file', 'extensions' => 'jpg, gif, png'],
            [['birthday'], 'date', 'format' => 'dd-mm-yyyy'],
        ];
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'user_id' => Yii::t('profile.attributes.user_id', 'User'),
            'description' => Yii::t('profile.attributes.description', 'Description'),
            'img' => Yii::t('profile.attributes.image', 'Profile Image'),
            'phone_country' => Yii::t('profile.attributes.phone_country', 'Phone Country'),
            'phone_number' => Yii::t('profile.attributes.phone_number', 'Phone Number'),
        ]);

    }

    public function scenarios()
    {
        return ArrayHelper::merge([
            'settings' => ['email', 'language', 'currency_id', 'phone_number', 'phone_country'],
            'verification' => ['phone_number', 'phone_country'],
            'phonecode' => ['phone_verified'],
            'social-connect-image' => ['img'],
        ], parent::scenarios());
    }

    public function getPhoneNumber()
    {
        if ($this->phone_number == null || $this->phone_country == null) {
            return false;
        }
        return "+" . $this->phone_country . ' ' . $this->phone_number;
    }

    public function getName(){
        return isset($this->first_name) ? $this->first_name : \Yii::t('profile.default_user_name', 'KidUp User {id}', [
            'id' => $this->user_id
        ]);
    }

    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function isValidPhoneNumber()
    {
        if (empty($this->phone_number)) {
            return false;
        }
        $number = $this->phone_country . ' ' . $this->phone_number;
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $countries = Country::find()->indexBy('phone_prefix')->all();
        try {
            $numberProto = $phoneUtil->parse($number, $countries[$this->phone_country]->code);
            return $phoneUtil->isValidNumber($numberProto);
        } catch (\libphonenumber\NumberParseException $e) {
            return false;
        }
    }

    public function getImgUrl()
    {
        return ImageHelper::url($this->getAttribute('img'));
    }

    public function beforeSave($insert)
    {
        $this->birthday = strtotime($this->birthday);
        if ($this->isAttributeChanged('language') && \Yii::$app->has('session')) {
            Yii::$app->session->set('lang', $this->language);
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->birthday = date('d-m-Y', $this->birthday);
        return parent::afterFind();
    }

    public function beforeValidate()
    {
        if ($this->isAttributeChanged('description')) {
            $this->description = \yii\helpers\HtmlPurifier::process($this->description);
        }
        if ($this->isAttributeChanged('first_name')) {
            $this->first_name = \yii\helpers\HtmlPurifier::process($this->first_name);
        }
        if ($this->isAttributeChanged('last_name')) {
            $this->last_name = \yii\helpers\HtmlPurifier::process($this->last_name);
        }
        return parent::beforeValidate();
    }
}
