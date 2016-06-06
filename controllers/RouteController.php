<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/6
 * Time: 15:08
 */

namespace app\controllers;


use Yii;
use yii\web\Controller;

class RouteController extends Controller
{
    public function data()
    {
        return [
            ["id" => 1, "date" => "2015-04-19", "category" => "business", "title" => "Test news of 2015-04-19"],
            ["id" => 2, "date" => "2015-05-20", "category" => "shopping", "title" => "Test news of 2015-05-20"],
            ["id" => 3, "date" => "2015-06-21", "category" => "business", "title" => "Test news of 2015-06-21"],
            ["id" => 4, "date" => "2016-04-19", "category" => "shopping", "title" => "Test news of 2016-04-19"],
            ["id" => 5, "date" => "2017-05-19", "category" => "business", "title" => "Test news of 2017-05-19"],
            ["id" => 6, "date" => "2018-06-19", "category" => "shopping", "title" => "Test news of 2018-06-19"]];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionItemsList()
    {
        $year = Yii::$app->request->get("year");
        $category = Yii::$app->request->get("category");
        $data = $this->data();

        $filtedData = [];

        foreach ($data as $item) {
            if (($year != null) && (date("Y", strtotime($item['date'])) == $year)) $filtedData[] = $item;
            if (($category != null) && ($item['category'] == $category)) $filtedData[] = $item;
        }

        return $this->render('itemsList', ['year' => $year, 'category' => $category, 'filteredData' => $filtedData]);
    }
}