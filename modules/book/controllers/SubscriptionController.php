<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use app\modules\book\models\BookSubscription;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `Book` module
 */
class SubscriptionController extends Controller
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
                        'roles' => ['?'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id)
    {
        $subscription = new BookSubscription();
        $book = Book::findOne($id);
        if (!$book) return 'Пум пум, возникла ошибка поиска книги. Обработчик ошибок ещё не написали';
        return $this->render('subscription', compact(['subscription', 'book']));
    }

    public function actionCreate()
    {
        if (\Yii::$app->request->isPost) {
            $subscription = new BookSubscription();
            $subscription->load(\Yii::$app->request->post());
            if ($subscription->save()) {
                return $this->redirect(['/book/view', 'id' => $subscription->book_id]);
            } else {
                return 'Пум пум, возникла ошибка сохранения. Обработчик ошибок ещё не написали';
            }
        }
    }
}
