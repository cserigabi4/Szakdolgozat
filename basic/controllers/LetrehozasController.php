<?php


namespace app\controllers;

use app\models\Alapanyag;
use app\models\Kategoria;
use app\models\Termek;
use app\models\TermekOsszetevoi;
use yii\base\BaseObject;
use yii\web\Controller;

class LetrehozasController extends Controller {

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $kategoriak = Kategoria::find()->all();
        $alapanyagok = Alapanyag::find()->all();
        return $this->render('termek_alapanyag_kategoria_felvetel.tpl', ['kategoriak' => $kategoriak, 'alapanyagok' => $alapanyagok]);
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

    public function actionAlapanyag()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $nev = $request->post('alapanyag_nev');
        $mennyiseg = $request->post('alapanyag_mennyiseg');
        $mertekegyseg = $request->post('alapanyag_mertekegyseg');

        $alapanyag = new Alapanyag();
        $alapanyag->nev = $nev;
        $alapanyag->mennyiseg= $mennyiseg;
        $alapanyag->mertekegyseg = $mertekegyseg;

        if ($alapanyag->save()) {
            $response->data = ['message' => 'Siker', 'data' => $nev];
        } else {
           // var_dump($alapanyag->getErrors()['nev'][0]);
            $response->data = ['error' => 'Sikertelen mentés!', 'data' => $alapanyag->getErrors()];
        }

        return $response;
    }

    public function actionKategoria()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $nev = $request->post('kategoria_nev');
        $allergen = (boolean) $request->post('kategoria_allergen');
        $afa_kulcs =   $request->post('kategoria_afa');

        $kategoria = new Kategoria();
        $kategoria->nev = $nev;
        $kategoria->allergen = $allergen;
        $kategoria->afa_kulcs = $afa_kulcs;

        if ($kategoria->save()) {
            $response->data = ['message' => 'Siker', 'id' => $kategoria->id];
        } else {
            $response->data = ['error' => 'Sikertelen mentés!'];
        }

        return $response;
    }

    public function actionTermek()
    {
        $request = \Yii::$app->request;
        $response = \Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $nev = $request->post('termek_nev');
        $kategoria = $request->post('termek_kategoria');
        $ar =   $request->post('termek_ar');
        $termek_alapanyagok =  $request->post('termek_alapanyagok');
        $termek_alapanyagok = explode(',', $termek_alapanyagok);
        $termek = new Termek();
        $termek->nev = $nev;
        $termek->kategoria_id = $kategoria;
        $termek->ar = $ar;

        if ($termek->save()) {
            foreach ($termek_alapanyagok as $alapanyag_nev) {
                $termek_osszetevoi = new TermekOsszetevoi();
                $termek_osszetevoi->termek_id = $termek->id;
                $alapanyag = Alapanyag::findOne(['nev' => $alapanyag_nev]);
                $termek_osszetevoi->alapanyag_id = $alapanyag->id;
                $termek_osszetevoi->save();
            }

            $response->data = ['message' => 'Siker'];
        } else {
            $response->data = ['error' => 'Sikertelen mentés!'];
        }

        return $response;
    }
}