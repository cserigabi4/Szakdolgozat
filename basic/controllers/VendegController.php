<?php


namespace app\controllers;


use app\models\Asztal;
use app\models\Kategoria;
use app\models\Rendeles;
use app\models\RendeltTermek;
use app\models\Termek;
use yii\web\Controller;

class VendegController  extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;

        $asztal_id = $request->get('asztal_id');

        if (!$session->get('asztal_id') || ($asztal_id && $session->get('asztal_id') != $asztal_id)) {
            $session->set('asztal_id', $asztal_id);
        }
        $kategoriak = Kategoria::find()->all();
      //  var_dump($kategoriak[0]->getTermeks());
        return $this->render('vendeg_eladfelulet.tpl', ['kategoriak' => $kategoriak]);
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionAsztal()
    {
        $session = \Yii::$app->session;
        $asztal_id = $session->get('asztal_id');

        $asztal = Asztal::findOne($asztal_id);
        $termekek = Termek::find()->with('kategoria')->all();
        $rendeles = Rendeles::findOne(['asztal_id' => $asztal_id, 'allapot' => 1]);
        if ($rendeles) {
            $rendelt_termekek = RendeltTermek::findAll(['rendeles_id' => $rendeles->id, 'torolt' => null]);
        } else {
            $rendeles = null;
            $rendelt_termekek = null;
        }

        return $this->render('vendeg_asztal.tpl', ['termekek' => $termekek, 'asztal' => $asztal, 'rendeles' => $rendeles, 'rendelt_termekek' => $rendelt_termekek]);
    }



}