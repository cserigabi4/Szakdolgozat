<?php


namespace app\widgets;


use yii\base\Widget;

class SideBar  extends Widget
{
    private $items = array();

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('sidebar.tpl', ["items" => $this->items]);
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $item
     */
    public function setItems($item): void
    {
       // array_push($this->items,$item);
        $this->items = $item;
    }


}