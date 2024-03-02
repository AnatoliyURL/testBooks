<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use app\modules\book\models\AuthorSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `Book` module
 */
class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['favorite-year'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionFavoriteYear()
    {
        $year = Yii::$app->request->post('year', date('Y'));
        $searchModel = new AuthorSearch(['year' => $year]);
        $authors = $searchModel->search();
        return $this->render('favorite-year', compact('authors', 'year'));
    }
}
