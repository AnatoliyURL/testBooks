<?php

use app\modules\book\models\Author;
use app\modules\book\models\Book;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var Book $book */

$form = ActiveForm::begin([
    'id' => 'book-form',
    'action' => '/book/update/update',
]); ?>

<div class="row">
    <h1>Редактирование - <?= $book->title ?></h1>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
        <?= $form->field($book, 'id')->hiddenInput()->label(false) ?>
        <?= $form->field($book, 'title') ?>
        <?= $form->field($book, 'date_released')->widget(DatePicker::class, [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control']
        ]) ?>
        <?= $form->field($book, 'description')->textarea() ?>
        <?= $form->field($book, 'isbn') ?>
        <div class="form-group field-book-authors">
            <label><?= $book->getAttributeLabel('authors') ?></label>
            <?= Select2::widget([
                'name' => 'Book[authors]',
                'data' => ArrayHelper::map(Author::find()->all(), 'id', 'fullName'),
                'value' => ArrayHelper::getColumn($book->bookAuthors, 'author_id'),
                'options' => ['multiple' => true, 'class' => 'form-control'],
            ]) ?>
        </div>
        <?= $form->field($book, 'file')->fileInput(['class' => 'form-control'])->label('Загрузить новую обложку') ?>
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 h-50">
        <?php if ($book->cover): ?>
            <img class="h-50 w-50" src="<?= $book->urlCover ?>" alt="<?= $book->title ?>">
        <?php endif; ?>
    </div>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
<?php
ActiveForm::end() ?>

