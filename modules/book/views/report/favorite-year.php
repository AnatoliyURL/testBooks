<?php
/** @var array $authors */

/** @var string $year */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>ТОП 10 авторов выпуствиших больше книг за <?= $year ?> год</h1>
<div class="row">
    <?php
    $form = ActiveForm::begin([
        'id' => 'book-form',
        'options' => ['class' => 'form-horizontal'],
    ]);
    ?>
    <div class="d-flex">
        <?= Html::input('number', 'year', $year, ['class' => 'form-control', 'min' => 0, 'max' => 3000, 'step' => 1]) ?>
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php
    ActiveForm::end() ?>
</div>
<div class="row m-1">
    <ol>
        <?php foreach ($authors as $author): ?>

            <li><?= $author['fullName'] ?> : количество книг - <?= $author['countBook'] ?></li>

        <?php endforeach; ?>
    </ol>
</div>
