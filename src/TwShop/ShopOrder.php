<?php

namespace App\TwShop;


class ShopOrder
{
    private $order_id;
    private $order_amount;
    private $create_at;
    private $rid;
    private $click_id;

    /**
     * ShopOrder constructor.
     */
    public function __construct($order_id, $order_amount, $create_at, $rid, $click_id)
    {
        $this->order_id = $order_id;
        $this->order_amount = $order_amount;
        $this->create_at = date("Y-m-d", strtotime($create_at));
        $this->rid = $rid;
        $this->click_id = $click_id;
    }

    /**
     * @return string
     */
    public function getCreateStamp()
    {
        return $this->create_at;
    }

    /**
     * @return mixed
     */
    public function getOrderAmount()
    {
        return $this->order_amount;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getRid()
    {
        return $this->rid;
    }

    /**
     * @return mixed
     */
    public function getClickId()
    {
        return $this->click_id;
    }
}
