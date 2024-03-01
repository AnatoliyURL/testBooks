<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use yii\web\Controller;

/**
 * Default controller for the `Book` module
 */
class SubscriptionController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id)
    {
        $book = Book::findOne(['id' => $id]);
        return $this->render('index', compact(['book']));
    }
}
