<?php

namespace app\modules\book\models;

use yii\data\ActiveDataProvider;

class AuthorSearch extends Author
{
    public string $startYear;
    public string $endYear;
    public string $year;

    public function __construct($config = [])
    {
        $this->year = $config['year'];
        $this->startYear = $this->year . "-01-01";
        $this->endYear = $this->year . "-12-31";
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['startYear', 'endYear', 'year'], 'string'],
        ];
    }

    public function search()
    {
        $query = Author::find();
        $query->select(['CONCAT_WS(\' \', author.surname, author.name, author.patronymic) as fullName', 'COUNT(book.id) as countBook']);
        $query->joinWith(['bookAuthors', 'bookAuthors.book']);
        $query->where([
            'and',
            ['between', 'book.date_released', $this->startYear, $this->endYear],
            ['book.is_deleted' => false],
        ]);
        $query->groupBy(['author.id']);
        $query->orderBy(['countBook' => SORT_DESC, 'fullName' => SORT_ASC]);
        $query->limit(10);
        $query->asArray();

        return $query->all();
    }
}