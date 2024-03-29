<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `Book` module
 */
class UpdateController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'update'],
                        'roles' => ['@'],
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
        $book = Book::findOne(['id' => $id]);
        return $this->render('update', compact(['book']));
    }

    public function actionUpdate()
    {
        if (\Yii::$app->request->isPost) {
            $book = Book::findOne(['id' => ArrayHelper::getValue(\Yii::$app->request->post('Book'), 'id')]);
            if ($book) {
                $book->file = UploadedFile::getInstance($book, 'file');
                $book->load(\Yii::$app->request->post());
                if ($book->save()) {
                    return $this->redirect(['/book/view', 'id' => $book->id]);
                } else {
                    return 'Пум пум, возникла ошибка сохранения. Обработчик ошибок ещё не написали';
                }
            }
        }
    }
}
