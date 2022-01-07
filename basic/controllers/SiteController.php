<?php

namespace app\controllers;

use app\models\Asztal;
use app\models\Felhasznalo;
use app\widgets\SideBar;
use yii\web\Controller;
use Da\QrCode\QrCode;
use app\helper\UserHelper;

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

            $bar = new Sidebar;
            $bar->setItems([
                            ['title' => 'Termék felvétel', 'url' => '/letrehozas', 'jog' => ''],
                            ['title' => 'Asztalterkep', 'url' => '/asztalterkep', 'jog' => 'fonok']
                           ]);
            $widget = $bar->run();
            \Yii::$app->view->params['sidebar'] = $widget;

            return $this->render('main.tpl');
        } else {
            if(UserHelper::isMobileDevice()) {
              return \Yii::$app->runAction('vendeg', null);
            } else {
                return $this->render('bejelentkezes.tpl');
            }
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
