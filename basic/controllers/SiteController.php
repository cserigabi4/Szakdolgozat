<?php

namespace app\controllers;

use app\models\BejelentkezesForm;
use app\models\Felhasznalo;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('bejelentkezes.tpl');
    }

}
