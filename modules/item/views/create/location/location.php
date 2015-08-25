<h4>
    <?= Yii::t("item", "Set your pickup location") ?>
</h4>

<?= Yii::t("item", "Where can the product be picked up?"); ?>
<hr>

<i class="fa fa-lock"></i> <?= Yii::t("item",
    "Other users can see the neighbourhood of the pickup location, but the details are only shared with users that made a booking.") ?>
<div class="row">
    <div class="col-md-8" style="padding:0">
        <?= $form->field($model,
            'location_id')->widget(\kartik\select2\Select2::classname(), [
            'data' => \app\modules\user\helpers\SelectData::userLocations(),
            'options' => ['placeholder' => 'Select a Location', 'width' => '200px'],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ])->label(false); ?>
    </div>
    <div class="col-md-4" style="padding:0;padding-left:15px;">
        <button type="button" class="btn btn-primary btn-fill btn-sm" data-toggle="modal"
                data-target="#location-modal">
            <?= Yii::t("item", "Add new location") ?>
        </button>
    </div>
</div>
