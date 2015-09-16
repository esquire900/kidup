<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\typeahead\Typeahead;
use yii\helpers\Html;

\app\modules\item\assets\MenuSearchAsset::register($this);
?>

<?php $form = ActiveForm::begin([
    'action' => Url::to('@web/search'),
    'method' => 'get',
    'options' => [
        'class' => 'form-inline hidden-xs'
    ],
    'enableClientValidation' => false,
    'enableClientScript' => false,
    'id' => 'menu-search-form'
]) ?>

<div class="form-group" style="margin-top:10px;">

    <?= $form->field($model, 'query')->widget(Typeahead::className(), [
        'options' => [
            'placeholder' => \Yii::t('home', 'What do you like to get your child?'),
            'class' => 'form-control',
            'disabled' => false,
            'id' => 'menu-search-autocomplete' // need to be unique
        ],
        'pluginOptions' => ['highlight' => true, 'hint' => true],
        'pluginEvents' => [
            "typeahead:select" => "function() { $('#menu-search-form').submit(); }",
        ],
        'dataset' => [
            [
                'remote' => [
                    'url' => Url::to('@web/search/auto-complete/index?q=%q'),
                    'wildcard' => '%q'
                ],
                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                'limit' => 5,
                'display' => 'text',
                'templates' => [
                    'notFound' => '<div class="text-danger" style="padding:0 8px">'.\Yii::t('home', "No results, perhaps try Stroller, Trampoline or Toy?").'</div>',
                    'suggestion' => new \yii\web\JsExpression("Handlebars.compile('<div>{{text}}</div>')")
                ]
            ]
        ]
    ])->label(false); ?>

</div>

<?= Html::submitButton(Yii::t("item", "Search"), ['class' => "btn btn-fill btn-danger"]) ?>

<?php ActiveForm::end() ?>

