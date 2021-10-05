<?php


namespace app\widgets;
use yii\base\Widget;


class Menu  extends Widget
{
    public $items = array();

    public function init()
    {
        parent::init();

        // itt nézni hogy be van-e jelentkezve és ha igen akkor más menu
        if (false) {
            $this->items = [
                ["nev" => "Asztaltérkép",
                    "url"=> "/site",
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

    public function run()
    {
        return $this->render('menu.tpl', ["items" => $this->items]);
    }

}