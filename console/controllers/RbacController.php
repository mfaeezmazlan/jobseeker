<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {

    public function actionInit() {



        $auth = Yii::$app->authManager;

        // add "createUser" permission
        $createUser = $auth->createPermission('create-user');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        // add "updateUser" permission
        $updateUser = $auth->createPermission('update-user');
        $updateUser->description = 'Update user';
        $auth->add($updateUser);

        // add "myProfile" permission
        $myProfile = $auth->createPermission('my-profile');
        $myProfile->description = 'View My Profile';
        $auth->add($myProfile);

        // add "selectJob" permission
        $selectJob = $auth->createPermission('select-job');
        $selectJob->description = 'Select job';
        $auth->add($selectJob);

        // add "createJob" permission
        $createJob = $auth->createPermission('create-job');
        $createJob->description = 'Create a job';
        $auth->add($createJob);

        // add "updateJob" permission
        $updateJob = $auth->createPermission('update-job');
        $updateJob->description = 'Update job';
        $auth->add($updateJob);

        // add "employee" role and give this role the "createPost" permission
        $employee = $auth->createRole('employee');
        $auth->add($employee);
        $auth->addChild($employee, $selectJob);
        $auth->addChild($employee, $myProfile);

        // add "company" role and give this role the "createPost" permission
        $company = $auth->createRole('company');
        $auth->add($company);
        $auth->addChild($company, $createUser);
        $auth->addChild($company, $createJob);
        $auth->addChild($company, $updateJob);
        $auth->addChild($company, $myProfile);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $company);
        $auth->addChild($admin, $myProfile);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($employee, 3);
        $auth->assign($company, 2);
        $auth->assign($admin, 1);
    }

}
