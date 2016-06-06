<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/6
 * Time: 10:05
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class NewsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionItemsList()
    {

        return $this->render('itemsList', ['newsList' => $this->dataItems()]);
    }

    public function actionItemDetail($id)
    {
        $newsList = $this->dataItems();

        $item = null;
        foreach ($newsList as $value) {
            if ($id == $value['id']) $item = $value;
        }
        return $this->render('itemDetail', ['item' => $item]);
    }

    public function actionAdvTest() {
        return $this->render('advTest');
    }

    public function actionResponsiveContentTest() {
        $responsive = Yii::$app->request->get('responsive', 0);
        if ($responsive) {
            $this->layout = 'responsive';
        } else {
            $this->layout = 'main';
        }
        return $this->render('responsiveContentTest', ['responsive' => $responsive]);
    }


    public function dataItems()
    {
        return $newsList = [
            ['id' => 1, 'title' => 'First world war', 'date' => '1914-07-08'],
            ['id' => 2,'title' => 'Second world war', 'date' => '1939-09-01'],
            ['id' => 3,'title' => 'Third world war', 'date' => '1969-07-20']
        ];
    }
}