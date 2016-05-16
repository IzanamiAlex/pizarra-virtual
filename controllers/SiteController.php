<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Json;
use app\models\Chat;
use app\models\Assign;
use app\models\Group;

class SiteController extends Controller
{
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {

        $idGroup = '';

        $idUser = Yii::$app->user->id;
        $idGroupAux = Assign::find()
            ->where(['student_id' => $idUser])
            ->asArray()
            ->one();

        $idGroupTutor = Group::find()
            ->where(['tutor_id' => $idUser])
            ->asArray()
            ->one();

        if(!empty($idGroupTutor)){
            $idGroup = $idGroupTutor['name'];
            //echo json_encode($idGroup);
        }else{
            if(!empty($idGroupAux)){
                $nameGroup = Group::find()
                    ->where(['id' => $idGroupAux['group_id']])
                    ->asArray()
                    ->one();
                $idGroup = $nameGroup['name'];
            }

        }
        


        if (Yii::$app->request->post()) {

            $message = Yii::$app->request->post('message');
            $chat = new Chat;
            $chat->username = Yii::$app->user->identity->username;
            $chat->message = $message;
            $chat->group = $idGroup;
            $chat->save();
            Yii::$app->redis->executeCommand('BGSAVE');

        //$grupo = \app\models\Group::find();
        //$chat = new Group;
        //$chat->id = 1;
        //$chat->tutor_id = 1;
        //$chat->name = $message;
        //$chat->insert();
        //$name = Yii::$app->request->post('name');

        /*Yii::$app->redis->executeCommand('HSET',[
        'key' => 'grupo1',
            'field' => Yii::$app->user->identity->username,
            'value' => $message
        ]);*/
        return Yii::$app->redis->executeCommand('PUBLISH', [
            'channel' => $idGroup,
            'message' => Json::encode(['name' => Yii::$app->user->identity->username, 'message' => $message])
            //'message' => Json::encode(['name' => 'Josafat', 'message' => $message,'grupo' => $grupo])
        ]);

        //echo Json::encode(['name' => 'Josafat', 'message' => $message]);
    }else{


            $aux = Chat::find()
                ->where(['group' => $idGroup])
                ->asArray()
                ->all();
            $int = sizeof($aux);
            $intOff = $int - 5;

            $mensajes = Chat::find()
                ->where(['group' => $idGroup])
                ->offset($intOff)
                ->asArray()
                ->all();
            return $this->render('index',['mensajes'=> $mensajes,'grupo'=> $idGroup]);
        }
    //echo $idGroup;

    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }
}
