<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Masyarakat;
use app\models\Teknisi;
use app\models\Topup;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $masyarakat = Masyarakat::find()->count();
        $teknisi = Teknisi::find()->where(['status_akun' => "Aktif"])->count();
        $topup = Topup::find()->where(['proses' => "Diproses"])->count();
        $queryNominalTopup = Yii::$app->db->createCommand("SELECT sum(nominal) as total FROM tb_topup WHERE proses = 'Diterima'")->queryAll();
        $nominalTopup = $queryNominalTopup[0]['total'];
        $nominalTopupConverted = $nominalTopup;

        if($nominalTopup>1000) {

            $x = round($nominalTopup);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array(' RB', ' JT', ' M', ' T');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
    
             $nominalTopupConverted = $x_display;
            
    
      }

      //Array Bulan
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
        $bulanKini = $array_bulan[date('n')];
        // var_dump(SiteController::get_disk_usage());
        // exit();

        return $this->render('index', [
            'totalMasyarakat'=>$masyarakat,
            'totalTeknisi'=>$teknisi,
            'totalTopupDiproses'=>$topup,
            'nominalTopup'=>$nominalTopupConverted ,
            'cpuUsage'=>SiteController::get_server_cpu_usage(),
            'memoryUsage'=>SiteController::get_server_memory_usage(),
            'diskUsage'=>SiteController::get_disk_usage(),
            'numberProcess'=>SiteController::get_number_processes(),
            'bulanKini'=>$bulanKini
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public static function get_server_memory_usage(){

        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2]/$mem[1]*100;
    
        return $memory_usage;
    }

    public static function get_server_cpu_usage(){

        $load = sys_getloadavg();
        return $load[0];
    
    }

    public static function get_disk_usage() {
	
        $disktotal = disk_total_space ('/');
        $diskfree  = disk_free_space  ('/');
        $diskuse   = round (100 - (($diskfree / $disktotal) * 100)) .'%';
        
        return $diskuse;
        
    }

    public static function get_number_processes() {
	
        $proc_count = 0;
        $dh = opendir('/proc');
        
        while ($dir = readdir($dh)) {
            if (is_dir('/proc/' . $dir)) {
                if (preg_match('/^[0-9]+$/', $dir)) {
                    $proc_count ++;
                }
            }
        }
        
        return $proc_count;
        
    }
    
}
