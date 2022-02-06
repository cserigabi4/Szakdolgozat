<?php


namespace app\controllers;


use app\models\Asztal;
use app\models\Kategoria;
use app\models\Rendeles;
use app\models\RendeltTermek;
use app\models\Termek;
use yii\base\BaseObject;
use yii\web\Controller;

class VendegController  extends Controller
{
    public $rendeles;
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

        $this->rendeles = Rendeles::findOne(['asztal_id' => $asztal_id, 'allapot' => 1]);
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

    public function actionFelvetel()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $session = \Yii::$app->session;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $termek_id = $request->post('termek_id');
        $asztal_id = $session->get('asztal_id');
        $ar = $request->post('ar');
        $rendeles = Rendeles::findOne(['asztal_id' => $asztal_id, 'allapot' => 1]);
        if (is_null($rendeles)){
            $rendeles = new Rendeles();
            $rendeles->asztal_id = $asztal_id;
            $rendeles->allapot = true;
        }

        $rendeles->ar += $ar;
        if ($rendeles->save()) {
            $response->data = ['message' => 'Siker'];
        } else {
            $response->data = ['error' => 'Sikertelen mentés!'];
        }

        $rendelt_termek = new RendeltTermek();
        $rendelt_termek->rendeles_id = $rendeles->id;
        $rendelt_termek->termek_id = $termek_id;
        if ($rendelt_termek->save()) {
            $response->data = ['message' => 'Siker',  'rendeles_id' => $rendeles->id];
        } else {
            $response->data = ['error' => 'Sikertelen mentés a rendelt_termeknel!'];
        }
        return $response;
    }



}