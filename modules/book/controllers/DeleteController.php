<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `Book` module
 */
class DeleteController extends Controller
{

    public function actionIndex($id)
    {
        $book = Book::findOne(['id' => $id]);
        if ($book) {
            if ($book->delete()) {
                return $this->redirect(Yii::$app->homeUrl);
            } else {
                return 'Пум пум, возникла ошибка удаления. Обработчик ошибок ещё не написали';
            }
        }

        return 'Пум пум, возникла ошибка, такой книги не нашли. Обработчик ошибок ещё не написали';

    }
}
