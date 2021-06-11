<?php

namespace App\TwShop;


class ShopSetting
{
    private $offer_id;
    private $advertiser_id;
    private $affiliate_id;

    /**
     * @var
     * 介於 0-100 之間
     */
    private $commission;

    /**
     * TwShopSetting constructor.
     */
    public function __construct($affiliate_id, $offer_id, $advertiser_id, $commission)
    {
        $this->offer_id = $offer_id;
        $this->advertiser_id = $advertiser_id;
        $this->commission = $commission;
        $this->affiliate_id = $affiliate_id;
    }

    /**
     * @param $amount
     * @return float|int
     */
    public function getCommission($amount)
    {
        if(!is_numeric($amount) || $amount <= 0)
            return 0;

        return round($amount * $this->commission / 100, 2) * -1;
    }

    /**
     * @return mixed
     */
    public function getAdvertiserId()
    {
        return $this->advertiser_id;
    }

    /**
     * @return mixed
     */
    public function getOfferId()
    {
        return $this->offer_id;
    }

    /**
     * @return mixed
     */
    public function getAffiliateId()
    {
        return $this->affiliate_id;
    }
}
