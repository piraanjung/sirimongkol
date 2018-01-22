<?php

namespace app\controllers\user;

use Yii;
use dektrium\user\controllers\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function actionDashboard(){
        $this->layout = 'admin';
        return $this->render('/admin/dashboard');
    }
    public function actionCreate()
    {
        // do your magic
    }
}
