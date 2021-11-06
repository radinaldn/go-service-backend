<?php

namespace app\controllers;

use Yii;
use app\models\Topup;
use app\models\Masyarakat;
use app\models\TopupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TopupController implements the CRUD actions for Topup model.
 */
class TopupController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Topup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TopupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Topup model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Topup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Topup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_topup]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    // action terima topup
    public function actionTerima($id){
        
        
        $model = Topup::find()->where(['id_topup' => $id])->one();
        $model->proses = "Diterima";

        // tambah nilai saldo
        $masyarakat = Masyarakat::find()->where(['nik' => $model->nik])->one();
        $masyarakat->saldo += $model->nominal;
        // echo "<pre>";
        // var_dump($masyarakat);
        // exit();
        

        if ($model->save() && $masyarakat->update()) {

            // send push notif to masyaraakt
            $title = "Topup Diterima";
            $body = "Saldo Rp".$model->nominal." ditambahkan.";
            
            // Deprecated
//             TopupController::sendPushNotifToMasyarakat($masyarakat->nik, $title, $body);

            Yii::$app->session->setFlash('success', "Request Topup <b>ID #".$model->id_topup."</b> berhasil diterima.");
            return $this->redirect(['index']);
        }

        Yii::$app->session->setFlash('failed', "Request Topup <b>ID #".$model->id_topup."</b> gagal diterima.");
        return $this->redirect(['index']);

        
    }

    // action tolak topup
    public function actionTolak($id){
        
        
        $model = Topup::find()->where(['id_topup' => $id])->one();
        $model->proses = "Ditolak";
        

        if ($model->save()) {
            Yii::$app->session->setFlash('success', "Request Topup <b>ID #".$model->id_topup."</b> berhasil ditolak.");
            return $this->redirect(['index']);
        }

        Yii::$app->session->setFlash('failed', "Request Topup <b>ID #".$model->id_topup."</b> gagal diterima.");
        return $this->redirect(['index']);

        
    }

    /**
     * Updates an existing Topup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_topup]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Topup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Topup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Topup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Topup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public static function sendPushNotifToMasyarakat($nik, $title, $body){
        $pushNotifications = new \Pusher\PushNotifications\PushNotifications(array(
            "instanceId" => "825913f1-e596-46cd-a0b8-22d2b6535c3d",
            "secretKey" => "39E2D6ED04F7B5B008D95228D503237F6B3CB96BE3862D4BF16AE31F30D44289",
          ));

          $publishResponse = $pushNotifications->publish(
            // array("hello", "donuts"),
            array(strval($nik)),
            array(
              "fcm" => array(
                "notification" => array(
                  "title" => $title,
                  "body" => $body,
                  "sound" => "default",
                  "click_action" => "ACTIVITY_SALDO"
                )
              ),
              "data" => array(
                "inAppNotificationMessage" => "Display me somewhere in the app ui!",
              ),
            //   "apns" => array("aps" => array(
            //     "alert" => array(
            //       "title" => "Hi!",
            //       "body" => "This is my first Push Notification!"
            //     )
            //   ))
          ));

        //   echo "<pre>";
        //   var_dump($publishResponse);
        //   exit();
    }
}
