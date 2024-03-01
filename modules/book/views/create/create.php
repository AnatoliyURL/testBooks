<?php

use app\modules\book\models\Book;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var Book $book */

$form = ActiveForm::begin([
    'id' => 'book-form',
    'options' => ['class' => 'form-horizontal'],
    'action' => '/book/create/create',
]); ?>

<h1>Добавление новой книги</h1>

<?= $form->field($book, 'id')->hiddenInput()->label(false) ?>
<?= $form->field($book, 'title') ?>
<?= $form->field($book, 'date_released') ?>
<?= $form->field($book, 'description')->textarea() ?>
<?= $form->field($book, 'isbn') ?>
<?/*= $form->field($book, 'image')->fileInput() */?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>

