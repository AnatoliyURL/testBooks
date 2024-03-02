<?php

/** @var yii\web\View $this */

/** @var array $books */
/** @var Book $book */

/** @var BookAuthors $author */

use app\modules\book\models\Book;
use app\modules\book\models\BookAuthors;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Карточки';
?>
<div class="site-index">
    <div class="row">
        <?php
        foreach ($books as $book): ?>
            <div class="col-sm-3">
                <div class="card">
                    <?php
                    if ($book->cover): ?>
                        <img class="card-img-top" src="<?= $book->urlCover ?>" alt="<?= $book->title ?>">
                    <?php
                    endif ?>
                    <div class="card-body">
                        <h4 class="card-title"><?= $book->title ?></h4>
                        <?php

                        foreach ($book->bookAuthors as $author): ?>
                            <p class="lead"><?= $author->author->fullName ?></p>
                        <?php
                        endforeach; ?>
                        <?= Html::a(
                            'Подробнее',
                            Url::to(['/book/view', 'id' => $book->id]),
                            ['class' => ['btn btn-primary']]
                        ) ?>
                    </div>
                </div>
            </div>
        <?php
        endforeach; ?>
    </div>
</div>
