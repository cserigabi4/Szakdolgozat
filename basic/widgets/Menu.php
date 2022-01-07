<?php


namespace app\widgets;
use yii\base\Widget;
use app\helper\UserHelper;



class Menu  extends Widget
{
    public $items = array();

    public function init()
    {
        parent::init();

        // itt nézni hogy be van-e jelentkezve és ha igen akkor más menu
        $session = \Yii::$app->session;

        if (!is_null($session->get('felhasznalo'))) {
            $this->items = [
                ["nev" => "Asztalok",
                    "url"=> "/asztalterkep",
                    "jog"=> "",
                    "active" => false,
                    "disable" => false
                ],
                ["nev" => "Jelenléti ív",
                    "url"=> "Teszt2",
                    "jog"=> "",
                    "active" => false,
                    "disable" => false
                ],
                ["nev" => "Beosztás",
                    "url"=> "Teszt2",
                    "jog"=> "",
                    "active" => false,
                    "disable" => false
                ],
                ["nev" => "Statisztikák",
                    "url"=> "Teszt2",
                    "jog"=> "",
                    "active" => false,
                    "disable" => false
                ],
                ["nev" => "Saját fogyaszts",
                    "url"=> "Teszt2",
                    "jog"=> "",
                    "active" => false,
                    "disable" => false
                ],
                ["nev" => "Saját Profil",
                    "url"=> "Teszt2",
                    "jog"=> "",
                    "active" => false,
                    "disable" => false
                ],
                ["nev" => "Kijelentkezés",
                    "url"=> "/site/kijelentkezes",
                    "jog"=> "",
                    "active" => false,
                    "disable" => false
                ]
            ];
        } else {
            if (UserHelper::isMobileDevice()){
                $this->items = [
                    ["nev" => "Asztal tartalma",
                        "url"=> "/vendeg",
                        "jog"=> "",
                        "active" => false,
                        "disable" => false
                    ],
                    ["nev" => "Termékek",
                        "url"=> "/vendeg",
                        "jog"=> "",
                        "active" => false,
                        "disable" => false
                    ],
                ];
            } else {
                $this->items = [
                    ["nev" => "Bejelentkezés",
                        "url"=> "/site",
                        "jog"=> "",
                        "active" => false,
                        "disable" => false
                    ],
                ];
            }

        }
    }

    public function run()
    {
        $mobil = UserHelper::isMobileDevice();
        return $this->render('menu.tpl', ["items" => $this->items, "vendeg" => $mobil]);
    }



}