<?php

namespace app\modules\book\models;

use app\models\User;
use app\modules\book\clients\SmsPilotClient;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalog_books_history".
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property int $event
 * @property string|null $created_by
 *
 * @property Book $book
 * @property User $user
 */
class CatalogBooksHistory extends \yii\db\ActiveRecord
{
    const EVENT_RECEIPT = 1; // Событие поступления книги на импровизированный склад
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalog_books_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'book_id', 'event'], 'required'],
            [['user_id', 'book_id', 'event'], 'integer'],
            [['created_by'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'book_id' => 'Book ID',
            'event' => 'Event',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        switch($this->event) {
            case self::EVENT_RECEIPT:
                (new SmsPilotClient())->sendMessages(ArrayHelper::getColumn($this->book->bookSubscriptions, 'phone'), 'Книга поступила');
                break;
        }

        return parent::beforeSave($insert);
    }
}
