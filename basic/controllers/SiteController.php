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

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionBejelentkezes() {
        $request = \Yii::$app->request;
        $azonosito = $request->post('azonosito');
        $jelszo = $request->post('jelszo');
        $felhasznalo = Felhasznalo::findOne($azonosito);
        if (!is_null($felhasznalo)) {
            if ($felhasznalo->validatePassword($jelszo)) {
                $session = \Yii::$app->session;
                $session->open();
                $session->set('felhasznalo_jog', $felhasznalo->jog);
            } else {
                var_dump('Hibás jelszó/név');
            }
        } else {
            var_dump('Hibás jelszó/név');
        }
    }

}
