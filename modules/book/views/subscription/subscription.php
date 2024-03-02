<?php
/** @var Book $book */

/** @var BookSubscription $subscription */

use app\modules\book\models\Book;
use app\modules\book\models\BookSubscription;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$form = ActiveForm::begin([
    'id' => 'book-form',
    'action' => '/book/subscription/create',
]); ?>
    <div class="row">
        <h1>Оформление подписки на книгу</h1>
        <p>Спасибо за проявленный интерес к книге: <small class="text-muted"><?= $book->title ?></small></p>
        <p>Оставьте свой номер телефона и при поступлении книги мы с вами свяжемся</p>
        <?= $form->field($subscription, 'book_id')->hiddenInput(['value' => $book->id])->label(false) ?>
        <?= $form->field($subscription, 'phone')->widget(MaskedInput::class, [
            'mask' => '+7 (999) 999-99-99',
            'options' => [
                'class' => 'form-control placeholder-style',
            ],
            'clientOptions' => [
                'clearIncomplete' => true
            ]
        ])->label(false) ?>
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
        <p class="lead">
            При нажатии кнопки отправить вы даете согласие на обработку персональных данных и т.д. и т.п.
        </p>
    </div>
<?php
ActiveForm::end() ?>