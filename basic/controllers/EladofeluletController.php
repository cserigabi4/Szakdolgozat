<?php


namespace app\controllers;


use app\models\Asztal;
use app\models\Rendeles;
use app\models\RendeltTermek;
use app\models\Termek;
use yii\base\BaseObject;
use yii\web\Controller;

class EladofeluletController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $asztal_id = $request->get('asztal_id');

        $asztal = Asztal::findOne($asztal_id);
        $termekek = Termek::find()->with('kategoria')->all();

        $rendeles = Rendeles::findOne(['asztal_id' => $asztal_id, 'allapot' => 1]);
        if ($rendeles) {
            $rendelt_termekek = RendeltTermek::findAll(['rendeles_id' => $rendeles->id, 'torolt' => null]);
        } else {
            $rendeles = null;
            $rendelt_termekek = null;
        }

        return $this->render('elado_felulet.tpl', ['termekek' => $termekek, 'asztal' => $asztal, 'rendeles' => $rendeles, 'rendelt_termekek' => $rendelt_termekek]);
    }

    public function beforeAction($action)
    {
        $session = \Yii::$app->session;
        if(!is_null($session->get('felhasznalo'))){
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
        } else {
            throw new \yii\web\HttpException(403, 'Nincs jogusoltsága az oldal eléréséhez!');
        }

    }

    public function actionMentes()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $termek_id = $request->post('termek_id');
        $asztal_id = $request->post('asztal_id');
        $ar = $request->post('ar');

        $rendeles_id = $request->post('rendeles_id');
        if ($rendeles_id){
            $rendeles = Rendeles::findOne($rendeles_id);
        } else {
            $rendeles = new Rendeles();
            $rendeles->asztal_id = $asztal_id;
            $rendeles->allapot = true;
        }
        $rendeles->ar = $ar;
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

    public function actionTorles()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $termek_id = $request->post('termek_id');
        $rendeles_id = $request->post('rendeles_id');

        $rendelt_termek = RendeltTermek::findOne(['rendeles_id' => $rendeles_id, 'termek_id' => $termek_id, 'torolt' => null]);
        $rendelt_termek->torolt = true;
        $rendelt_termek->rendeles->ar -= $rendelt_termek->termek->ar;

        if ($rendelt_termek->save() && $rendelt_termek->rendeles->save()) {
            $response->data = ['message' => 'Siker'];
        } else {
            $response->data = ['error' => 'Sikertelen törlés'];
        }
        return $response;

    }

    public function actionFizetes()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $rendeles_id = $request->post('rendeles_id');
        $kedvezmeny = $request->post('kedvezmeny');

        $rendeles = Rendeles::findOne($rendeles_id);
        $rendeles->kedvezmeny = $kedvezmeny;
        $rendeles->allapot = false;

        foreach ($rendeles->rendeltTermeks as $rendeltTermek) {
            if(is_null($rendeltTermek->torolt)) {
                $rendeltTermek->torolt = false;
                $rendeltTermek->save();
            }
        }

        if ($rendeles->save()) {
            $response->data = ['message' => 'Siker'];
        } else {
            $response->data = ['error' => 'Sikertelen törlés'];
        }

    }

}