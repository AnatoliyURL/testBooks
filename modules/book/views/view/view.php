<?php
/** @var Book $book */

/** @var Author $author */

use app\modules\book\models\Author;
use app\modules\book\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <div class="book-head d-flex justify-content-around align-items-center">
        <div class="book-head__title">
            <h1><?= $book->title ?></h1>
        </div>
        <div class="book-head__isbn">
            <small>(isbn: <?= $book->isbn ?>)</small>
        </div>
        <div class="book-head__event">
            <div class="book-head__event-group-btn">
                <?php if (Yii::$app->user->isGuest): ?>
                    <?= Html::a('Подписаться <3', Url::to(['/book/subscription', 'id' => $book->id]), ['class' => ['btn btn-primary']]) ?>
                <?php else: ?>
                    <?= Html::a('Книга поступила', Url::to(['/book/stock/receipt', 'id' => $book->id]), ['class' => ['btn btn-warning']]) ?>
                    <?= Html::a('Редактировать', Url::to(['/book/update', 'id' => $book->id]), ['class' => ['btn btn-warning']]) ?>
                    <?= Html::a('Удалить', Url::to(['/book/delete', 'id' => $book->id]), ['class' => ['btn btn-danger']]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="book-body d-flex">
        <div class="book-body__inf col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <div class="book-body__inf-block d-flex">
                <?php if ($book->bookAuthors): ?>
                    <div class="book-body__inf-authors d-flex">
                        <p class="p-3 w-14"><strong>Автор<?= count($book->bookAuthors) > 2 ? 'ы' : '' ?>:</strong></p>
                        <ul class="p-3">
                            <?php foreach ($book->bookAuthors as $author): ?>
                                <li><?= $author->author->fullName ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="book-body__inf-description">
                    <p class="p-3"><strong>Дата публикации:</strong> <?= date("Y", strtotime($book->date_released)) ?></p>
                </div>
            </div>

            <div class="book-body__inf-description">
                <p class="p-3 w-14"><strong>Описание:</strong> <?= $book->description ?></p>
            </div>
        </div>
        <?php if ($book->cover): ?>
            <div class="book-body__cover col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 h-100">
                <img class="h-100 w-100" src="<?= $book->urlCover ?>" alt="<?= $book->title ?>">
            </div>
        <?php endif; ?>
    </div>

</div>
