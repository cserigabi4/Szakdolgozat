<?php


namespace app\controllers;


use app\models\Kategoria;
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
        $kategoriak = Kategoria::find()->all();
      //  var_dump($kategoriak[0]->getTermeks());
        return $this->render('vendeg_eladfelulet.tpl', ['kategoriak' => $kategoriak]);
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }



}