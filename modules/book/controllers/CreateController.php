<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `Book` module
 */
class CreateController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $book = new Book();
        return $this->render('create', compact(['book']));
    }

    public function actionCreate()
    {
        if (\Yii::$app->request->isPost) {
            $book = new Book();
            $book->load(\Yii::$app->request->post());
            if ($book->save()) {
                return $this->redirect(['/book/view', 'id' => $book->id]);
            } else {
                return 'Пум пум, возникла ошибка сохранения. Обработчик ошибок ещё не написали';
            }
        }
    }
}
