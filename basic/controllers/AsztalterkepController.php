<?php


namespace app\controllers;


use app\models\Asztal;
use app\widgets\SideBar;
use yii\helpers\Url;
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
        return $this->render('asztal_terkep.tpl', ["asztalok" => $asztalok]);
    }

    public function beforeAction($action)
    {
        $session = \Yii::$app->session;
        if(!is_null($session->get('felhasznalo'))){
            $this->enableCsrfValidation = false;

            $bar = new Sidebar;
            $bar->setItems([
                ['title' => 'Asztaltérkép', 'url' => '/asztalterkep', 'jog' => ''],
                ['title' => 'Szerkesztés', 'url' => '/asztalterkep/szerkesztes', 'jog' => 'fonok']
            ]);
            $widget = $bar->run();
            \Yii::$app->view->params['sidebar'] = $widget;

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
            $asztal->nev = $nev;
            $asztal->x = $x;
            $asztal->y = $y;
            if($asztal->save()){
                var_dump('siker');
            }
        } else {
            $asztal = new Asztal();
            $asztal->nev = $nev;
            $asztal->x = $x;
            $asztal->y = $y;
            if($asztal->save()){
                $qrCode = (new QrCode('http://localhost:8080/eladofelulet?asztal_id=' . $asztal->id))
                    ->setSize(250)
                    ->setMargin(5);
                 $str = \Yii::$app->basePath . '/img/qr_codes/' . $nev . '.png';

                $qrCode->writeFile($str);
                $asztal->qr =    Url::to('@web/img/qr_codes/'. $nev . '.png');
                var_dump( Url::to('@web/img/qr_codes/'. $nev . '.png'));
                if($asztal->save()){
                    var_dump('siker');
                }
                header('Content-Type: '.$qrCode->getContentType());
            }
        }
    }
}