<?php

namespace app\controllers;

use app\models\Asztal;
use app\models\Felhasznalo;
use yii\web\Controller;
use Da\QrCode\QrCode;

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

           /* $qrCode = (new QrCode('http://localhost:8080/site/eladofelulet'))
                ->setSize(250)
                ->setMargin(5);
            $qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified

            header('Content-Type: '.$qrCode->getContentType());*/


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

}
