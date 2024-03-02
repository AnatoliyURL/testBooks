<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use app\modules\book\models\CatalogBooksHistory;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `Book` module
 */
class StockController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['receipt'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionReceipt($id)
    {
        $receipt = new CatalogBooksHistory([
            'user_id' => Yii::$app->user->id,
            'book_id' => $id,
            'event' => CatalogBooksHistory::EVENT_RECEIPT,
        ]);

        if ($receipt->save()) {
            return $this->redirect(['/book/view', 'id' => $receipt->book_id]);
        } else {
            return 'Пум пум, возникла ошибка сохранения. Обработчик ошибок ещё не написали';
        }
    }
}
