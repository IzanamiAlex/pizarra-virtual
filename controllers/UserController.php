<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Assign;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rbac\DbManager;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
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
            'access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update'],
                        'roles' => ['Administrator', 'Tutor'],
                    ],
                    [
						'allow' => true,
						'actions' => ['delete'],
						'roles' => ['Administrator'],
					],
                    [
                        'allow' => true,
						'actions' => ['index','view'],
						'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new User();
        $assign = new Assign();
        
        if ($user->load(Yii::$app->request->post())) {
            $valid = true;
            $valid = $valid && $user->validate();
            
            if (strcmp("Student", $user->roleName) == 0) {
                if ($assign->load(Yii::$app->request->post())) {
                    $valid = $valid && $assign->validate();
                }
            }
            
            if ($valid) {
                if ($user->save()) {
                    Yii::$app->authManager->assign($user->role, $user->id);
                    $isSaved = true;
                    
                    if (strcmp("Student", $user->roleName) == 0) {
                        $assign->student_id = $user->id;
                        $isSaved = $isSaved && $assign->save();
                    }
                    
                    if($isSaved) {
                        return $this->redirect(['view', 'id' => $user->id]);
                    }
                }
            }
        } else {
            return $this->render('create', [
                'user' => $user,
                'assign' => $assign,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $assign = (empty($user->assign))? new Assign() : $user->assign;

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect(['view', 'id' => $user->id]);
        } else {
            return $this->render('update', [
                'user' => $user,
                'assign' => $assign,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
