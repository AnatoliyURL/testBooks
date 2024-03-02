<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `Book` module
 */
class DeleteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex($id)
    {
        $book = Book::findOne(['id' => $id]);
        if ($book) {
            $book->is_deleted = 1;
            if ($book->save()) {
                return $this->redirect(Yii::$app->homeUrl);
            } else {
                return 'Пум пум, возникла ошибка удаления. Обработчик ошибок ещё не написали';
            }
        }

        return 'Пум пум, возникла ошибка, такой книги не нашли. Обработчик ошибок ещё не написали';

    }
}
