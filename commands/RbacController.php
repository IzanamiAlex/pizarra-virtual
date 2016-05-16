<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //add "createUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        //add "updateUser" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update a user';
        $auth->add($updateUser);

        //add the rol Tutor
        $tutor = $auth->createRole('Tutor');
        $auth->add($tutor);

        //add the rol Student
        $student = $auth->createRole('Student');
        $auth->add($student);

        //add the rol administrator
        $admin = $auth->createRole('Administrator');
        $auth->add($admin);
    }
}