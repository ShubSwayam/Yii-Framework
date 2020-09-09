<?php

namespace app\models;

use Codeception\Test\Descriptor;
use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    private $title;
    private $description;
    private $category;

    public function rules()
    {
        return[
            [['title', 'description', 'category'], 'required']
        ];
    }
}
