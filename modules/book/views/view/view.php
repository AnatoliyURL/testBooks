<?php
/** @var Book $book */

use app\modules\book\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <h1><?= $book->title ?> (isbn: <?= $book->isbn ?>)</h1>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class="book-description">
            <?= $book->description ?>
        </div>
        <div class="book-event p-2">
            <?= Html::a('Подписаться <3', Url::to(['/book/subscription', 'id' => $book->id]), ['class' => ['btn btn-primary']]) ?>
            <?php if (!Yii::$app->user->isGuest): ?>
                <?= Html::a('Редактировать', Url::to(['/book/update', 'id' => $book->id]), ['class' => ['btn btn-warning']]) ?>
                <?= Html::a('Удалить', Url::to(['/book/delete', 'id' => $book->id]), ['class' => ['btn btn-danger']]) ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($book->cover): ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="book-cover">
                <img class="w-100 h-100" src="<?= $book->urlCover ?>" alt="<?= $book->title ?>">
            </div>
        </div>
    <?php endif; ?>
</div>
