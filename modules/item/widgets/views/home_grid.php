<?php
/**
 *    @property \app\modules\item\models\Item[] $items
 */
use yii\helpers\Url;
use app\modules\item\components\MediaManager;
use app\components\WidgetRequest;
?>

<!--Area for all categories-->
<Section id="content-home-categories">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2>Opdag børneting</h2>
                <h4>Find de ting som passer til din familie</h4>
            </div>
        </div>
        <!--new row with stuff-->
        <div class="row">
            <div class="col-md-3">
                <a href="<?= Url::to('@web/search?category=1') ?>">
                    <div class="card card-background">
                        <div class="image"  style="background-image: url('<?= Url::to('@web/img/categories/bike2.png') ?>')">
                        </div>
                        <div class="content text-center">
                            <br>
                            <br>
                            <h2 class="category-name">Cykler</h2>
                        </div>
                    </div> <!-- end card -->
                </a>
            </div>

            <?php if (isset($items[0])): ?>
            <div class="col-md-4">
                <a href="<?= Url::to('@web/item/' . $items[0]->id) ?>">
                    <div class="card  card-background" >
                        <div class="image" style="background-image: url('<?= $items[0]->getImageUrls()[0]['medium'] ?>'); width:100%">
                        </div>
                        <div class="content">
                            <h5 class="price">
                                <?= $items[0]->price_week ?> dkk
                            </h5>
                            <h4 class="title"><?= $items[0]->name ?></h4>

                        </div>
                        <div class="footer">
                            <div class="author">
                                <?= WidgetRequest::request(WidgetRequest::USER_PROFILE_IMAGE, ['user_id' => $items[0]->owner_id]) ?>
                                <span><?= $items[0]->owner->profile->first_name ?></span>
                                <span class="pull-right"><?= $items[0]->location->city ?><i class="fa fa-map-marker"></i></span>
                            </div>
                        </div>
                    </div> <!-- end card  card-background -->
                </a>
            </div>
            <?php endif; ?>

            <div class="col-md-5">
                <a href="<?= Url::to('@web/search?category=7') ?>">
                    <div class="card  card-background">
                        <div class="image"  style="background-image: url('<?= Url::to('@web/img/categories/stroller2.png') ?>')">
                        </div>
                        <div class="content text-center">
                            <br>
                            <br>
                            <h2 class="category-name">Barnevogne</h2>
                        </div>
                    </div> <!-- end card  card-background -->
                </a>
            </div>
        </div>
        <!--new row with stuff-->
        <div class="row">
            <div class="col-md-6">
                <a href="<?= Url::to('@web/search?category=2') ?>">
                    <div class="card  card-background">
                        <div class="image"  style="background-position: top; background-image: url('<?= Url::to('@web/img/categories/toy2.png') ?>')">
                        </div>
                        <div class="content text-center">
                            <br>
                            <br>
                            <h2 class="category-name">Legetøj</h2>
                        </div>
                    </div> <!-- end card  card-background -->
                </a>
            </div>
            <?php if (isset($items[1])): ?>
                <div class="col-md-3">
                    <a href="<?= Url::to('@web/item/' . $items[1]->id) ?>">
                        <div class="card  card-background" >
                            <div class="image" style="background-image: url('<?= $items[1]->getImageUrls()[0]['medium'] ?>'); width:100%">
                            </div>
                            <div class="content">
                                <h5 class="price">
                                    <?= $items[1]->price_week ?> dkk
                                </h5>
                                <h4 class="title"><?= $items[1]->name ?></h4>

                            </div>
                            <div class="footer">
                                <div class="author">
                                    <?= WidgetRequest::request(WidgetRequest::USER_PROFILE_IMAGE, ['user_id' => $items[1]->owner_id]) ?>
                                    <span><?= $items[1]->owner->profile->first_name ?></span>
                                    <span class="pull-right"><?= $items[1]->location->city ?><i class="fa fa-map-marker"></i></span>
                                </div>
                            </div>
                        </div> <!-- end card  card-background -->
                    </a>
                </div>
            <?php endif; ?>

            <div class="col-md-3">
                <a href="<?= Url::to('@web/search?category=2') ?>">
                    <div class="card  card-background">
                        <div class="image"  style="background-image: url('<?= Url::to('@web/img/categories/room2.png') ?>')">
                        </div>
                        <div class="content text-center">
                            <br>
                            <br>
                            <h2 class="category-name">Værelse</h2>
                        </div>
                    </div> <!-- end card  card-background -->
                </a>
            </div>
        </div>
        <!--new row with stuff-->
        <div class="row">
            <?php if (isset($items[2])): ?>
                <div class="col-md-4">
                    <a href="<?= Url::to('@web/item/' . $items[2]->id) ?>">
                        <div class="card  card-background" >
                            <div class="image" style="background-image: url('<?= $items[2]->getImageUrls()[0]['medium'] ?>'); width:100%">
                            </div>
                            <div class="content">
                                <h5 class="price">
                                    <?= $items[2]->price_week ?> dkk
                                </h5>
                                <h4 class="title"><?= $items[2]->name ?></h4>

                            </div>
                            <div class="footer">
                                <div class="author">
                                    <?= WidgetRequest::request(WidgetRequest::USER_PROFILE_IMAGE, ['user_id' => $items[2]->owner_id]) ?>
                                    <span><?= $items[2]->owner->profile->first_name ?></span>
                                    <span class="pull-right"><?= $items[2]->location->city ?><i class="fa fa-map-marker"></i></span>
                                </div>
                            </div>
                        </div> <!-- end card  card-background -->
                    </a>
                </div>
            <?php endif; ?>
            <div class="col-md-3 col-xs-6">
                <a href="<?= Url::to('@web/search?category=6') ?>">
                    <div class="card  card-background">
                        <div class="image"  style="background-image: url('<?= Url::to('@web/img/categories/playfull2.png') ?>')">
                        </div>
                        <div class="content text-center">
                            <br>
                            <br>
                            <h2 class="category-name">Udendørs</h2>
                        </div>
                    </div> <!-- end card  card-background -->
                </a>
            </div>
            <div class="col-md-5 col-xs-6">
                <a href="<?= Url::to('@web/search?category=2') ?>">
                    <div class="card  card-background">
                        <div class="image"  style="background-image: url('<?= Url::to('@web/img/categories/carseat2.png') ?>')">
                        </div>
                        <div class="content text-center">
                            <br>
                            <br>
                            <h2 class="category-name">Autostole</h2>
                        </div>
                    </div> <!-- end card  card-background -->
                </a>
            </div>
        </div>
    </div>
</Section>
<!--Area for steps explanation-->