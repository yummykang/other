<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/7
 * Time: 8:45
 */

namespace app\controllers;


use app\models\Customer;
use app\models\Reservation;
use app\models\Room;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class RoomsController extends Controller
{
    public function actionIndex()
    {
//        $query = Room::find()->where('floor = 1');
//        $item = $query->one();
//        $item2 = Room::find()->where(['floor' => 1])->all();
//
//        $sql = 'select * from room order by id asc';
//        $db = Yii::$app->db;
//        $rooms = $db->createCommand($sql)->queryAll();
        $query = Room::find();
        if (isset($_POST['floor']) && $_POST['floor'] != '') {
            $query->andWhere(['floor' => $_POST['floor']]);
        }

        $rooms = $query->all();
        return $this->render('index', ['rooms' => $rooms]);
    }

    public function actionCreate()
    {
        $model = new Room();
        $modelCanSave = false;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->file_image = UploadedFile::getInstance($model, 'file_image');
            if ($model->file_image) {
                $model->file_image->saveAs(Yii::getAlias('@uploadedfilesdir') . '/' . $model->file_image->name);
            }
            $modelCanSave = true;
        }
        if ($model->save()) {
            return $this->redirect(['detail', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'modelSaved' => $modelCanSave
        ]);
    }

    public function actionUpdate($id)
    {
        $room = Room::findOne($id);
        if (($room != null) && $room->load(Yii::$app->request->post()) && ($room->save())) {
            return $this->redirect(['detail', 'id' => $room->id]);
        }

        return $this->render('update', ['model' => $room]);
    }

    public function actionDetail($id)
    {
        $room = Room::findOne($id);
        return $this->render('detail', ['room' => $room]);
    }

    public function actionIndexFiltered()
    {
        $query = Room::find();
        $searchFilter = [
            'floor' => ['operator' => '', 'value' => ''],
            'room_number' => ['operator' => '', 'value' => ''],
            'price_per_day' => ['operator' => '', 'value' => ''],
        ];
        if (isset($_POST['SearchFilter'])) {
            $fieldsList = ['floor', 'room_number', 'price_per_day'];
            foreach ($fieldsList as $field) {
                $fieldOperator = $_POST['SearchFilter'][$field]['operator'];
                $fieldValue = $_POST['SearchFilter'][$field]['value'];
                $searchFilter[$field] = ['operator' => $fieldOperator, 'value' => $fieldValue];
                if ($fieldValue != '') {
                    $query->andWhere([$fieldOperator, $field, $fieldValue]);
                }
            }
        }
        $rooms = $query->all();
        return $this->render('indexFiltered', ['rooms' => $rooms, 'searchFilter' =>
            $searchFilter]);
    }

    public function actionLastReservationByRoomId($room_id)
    {
        $room = Room::findOne($room_id);
        // equivalent to
        // SELECT * FROM reservation WHERE room_id = $room_id
        $lastReservation = $room->lastReservation;
        // next times that we will call $room->reservation, no sql query will beexecuted .
        return $this->render('lastReservationByRoomId', ['room' => $room, 'lastReservation' => $lastReservation]);
    }

    public function actionIndexWithRelationships()
    {
        // 1. Check what parameter of detail has been passed
        $room_id = Yii::$app->request->get('room_id', null);
        $reservation_id = Yii::$app->request->get('reservation_id', null);
        $customer_id = Yii::$app->request->get('customer_id', null);
        // 2. Fill three models: roomSelected, reservationSelected and customerSelected and
        // Fill three arrays of models: rooms, reservations and customers;
        $roomSelected = null;
        $reservationSelected = null;
        $customerSelected = null;
        if ($room_id != null) {
            $roomSelected = Room::findOne($room_id);
            $rooms = array($roomSelected);
            $reservations = $roomSelected->reservations;
            $customers = $roomSelected->customers;
        } else if ($reservation_id != null) {
            $reservationSelected = Reservation::findOne($reservation_id);
            $rooms = array($reservationSelected->room);
            $reservations = array($reservationSelected);
            $customers = array($reservationSelected->customer);
        } else if ($customer_id != null) {
            $customerSelected = Customer::findOne($customer_id);
            $rooms = $customerSelected->rooms;
            $reservations = $customerSelected->reservations;
            $customers = array($customerSelected);
        } else {
            $rooms = Room::find()->all();
            $reservations = Reservation::find()->all();
            $customers = Customer::find()->all();
        }
        return $this->render('indexWithRelationships', ['roomSelected' => $roomSelected,
            'reservationSelected' => $reservationSelected, 'customerSelected' => $customerSelected,
            'rooms' => $rooms, 'reservations' => $reservations, 'customers' => $customers]);
    }
}