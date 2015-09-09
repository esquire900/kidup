<?php
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use app\modules\user\helpers\SelectData;
use \app\modules\item\widgets\GoogleAutoComplete;

/**
 * @var \yii\web\View $this
 * @var \app\modules\item\forms\LocationForm $model
 * @var integer $itemId
 */
?>

<?php Modal::begin([
    'header' => '<h2>'.Yii::t('item', 'Enter Address').'</h2>'.Yii::t('item', 'Where can the product be picked up?'),
    'id' => 'location-modal', // important for the opening button caller
    'class' => 'greyed-modal'
]);

$form = \yii\bootstrap\ActiveForm::begin([
    'action' => '@web/item/create/add-location',
    'method' => 'post',
    'enableAjaxValidation' => true,
    'validationUrl' => '@web/item/create/add-location',
]);
?>
<?= $form->field($model, 'item_id')->hiddenInput(['value' => $itemId])->label(false) ?>
<?= $form->field($model, 'country')->widget(Select2::classname(), [
    'data' => SelectData::nationality(),
    'options' => ['placeholder' => 'Select a country'],
    'pluginOptions' => [
        'allowClear' => false
    ],
]); ?>

<div class="form-group field-location-form-street required">
    <label class="control-label" for="location-form-street"><?= \Yii::t('item', 'Street Address') ?></label>
    <?= \app\modules\item\widgets\GoogleAutoComplete::widget([
        'options' => [
            'class' => 'form-control location-input',
        ],
        'autocompleteOptions' => [
            'types' => ['geocode']
        ],
        'name' => 'street'
    ]); ?>
    <p class="help-block help-block-error"></p>
</div>

<?= $form->field($model, 'street_suffix')->label(\Yii::t('item', 'Apt, Suite, Building (optional)')) ?>
<?= $form->field($model, 'zip_code') ?>
<?= $form->field($model, 'city') ?>

<?= \yii\bootstrap\Html::submitButton(\Yii::t('item', 'Submit'), [
    'class' => "btn btn-danger btn-fill",
]); ?>

<?php
\yii\bootstrap\ActiveForm::end();

Modal::end(); ?>

