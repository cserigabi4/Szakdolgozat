<?php


namespace app\controllers;


use app\models\Asztal;
use yii\web\Controller;
use Da\QrCode\QrCode;


class AsztalterkepController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $asztalok = Asztal::find()->all();
        //  $this->layout = '@app/views/layouts/teszt.tpl';
        $widget = \app\widgets\Menu::widget();
        $widget=null;
        \Yii::$app->view->params['sidebar'] = $widget;
        return $this->render('asztal_terkep.tpl', ["asztalok" => $asztalok]);
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

    public function actionSzerkesztes() {
        $asztalok = Asztal::find()->all();
        return $this->render('asztal_terkep_elrendezes.tpl', ["asztalok" => $asztalok]);
    }

    public function actionMenteskordinata() {
        $request = \Yii::$app->request;
        $x = $request->post('x');
        $y = $request->post('y');
        $nev = $request->post('nev');

        if(Asztal::findOne(['nev'=>$nev])){
            $asztal = Asztal::findOne(['nev'=>$nev]);
        } else {
            $asztal = new Asztal();
            $qrCode = (new QrCode('http://localhost:8080/site/eladofelulet?asztal_id='.$asztal->id))
               ->setSize(250)
               ->setMargin(5);
           $qrCode->writeFile(__DIR__ . '/' . $nev . '.png'); // writer defaults to PNG when none is specified
           $asztal->qr = __DIR__ . '/' . $nev . '.png';
           header('Content-Type: '.$qrCode->getContentType());

        }
        $asztal->nev = $nev;
        $asztal->x = $x;
        $asztal->y = $y;

        if($asztal->save()){
            var_dump('siker');
        } else {
            var_dump();
        }



    }
}