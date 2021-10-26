<?php

namespace app\controllers;

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
        $session = \Yii::$app->session;
        if(!is_null($session->get('felhasznalo'))){
            return $this->render('main.tpl');
        } else {
            return $this->render('bejelentkezes.tpl');
        }
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
                $session->set('felhasznalo', $felhasznalo);
                return $this->render('main.tpl');
            } else {
                var_dump('Hibás jelszó/név');
            }
        } else {
            var_dump('Hibás jelszó/név');
        }
    }

    public function actionKijelentkezes() {
        \Yii::$app->session->remove('felhasznalo');
        return $this->render('bejelentkezes.tpl');
    }

    public function actionEladofelulet() {
        return $this->render('elado_felulet.tpl');
    }

    public function actionAsztalterkep() {
        return $this->render('asztal_terkep.tpl');
    }

    public function actionMenteskordinata() {
        $request = \Yii::$app->request;
        $id = $request->post('id');
        $x = $request->post('x');
        $y = $request->post('y');
       var_dump($id, $x, $y);
    }

}
