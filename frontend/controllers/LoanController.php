<?php

namespace frontend\controllers;

class LoanController extends \yii\web\Controller
{
    public function actionBank()
    {
        $this->layout = FALSE;
        return $this->render('bank');
    }

    public function actionIndex()
    {
        $this->layout = FALSE;
        return $this->render('index');
    }

    public function actionSchool()
    {
        $this->layout = FALSE;
        return $this->render('school');
    }

    public function actionSuccess()
    {
        $this->layout = FALSE;
        return $this->render('success');
    }

}
