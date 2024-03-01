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
                <div class="card" style="width: 18rem;">
                    <?php
                    if ($book->cover): ?>
                        <img class="card-img-top" src="<?= $book->urlCover ?>" alt="<?= $book->title ?>">
                    <?php
                    endif ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $book->title ?></h5>
                        <?php

                        foreach ($book->bookAuthors as $author): ?>
                            <p><?= $author->author->fullName ?></p>
                        <?php
                        endforeach; ?>
                        <p class="card-text"><?= $book->description ?></p>
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
