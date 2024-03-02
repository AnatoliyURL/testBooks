<?php

namespace app\modules\book\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string|null $patronymic
 *
 * @property BookAuthors[] $bookAuthors
 * @property string $fullName
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name'], 'required'],
            [['surname', 'name', 'patronymic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthors::class, ['author_id' => 'id']);
    }

    public function getFullName(): string
    {
        return "{$this->surname} {$this->name} {$this->patronymic}";
    }
}
