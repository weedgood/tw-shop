<?php

namespace App\TwShop;


class ShopService
{
    /**
     * @var array
     */
    private $option;

    public function __construct($id, $token)
    {
        $this->option = [
            'Version' => 2,
            'Format' => 'json',
            'Target' => 'Conversion',
            'Method' => 'create',
            'Service' => 'HasOffers',
            'NetworkId' => $id,
            'NetworkToken' => $token,
            'data' => []
        ];
    }

    public function createOrder(ShopOrder $shopOrder, ShopSetting $twShopSetting, $dry_run = false)
    {
        $revenue = $twShopSetting->getCommission(
            $shopOrder->getOrderAmount()
        );

        $option = $this->option;

        $option['data'] = [
            'offer_id' => $twShopSetting->getOfferId(),
            'advertiser_id' => $twShopSetting->getAdvertiserId(),
            'sale_amount' => $shopOrder->getOrderAmount(),
            'affiliate_id' => $twShopSetting->getAffiliateId(),
            'payout' => $revenue,
            'revenue' => $revenue,
            'advertiser_info' => $shopOrder->getOrderId(),
            'affiliate_info1' => $shopOrder->getRid(),
            'ad_id' => $shopOrder->getClickId(),
            'session_datetime' => $shopOrder->getCreateStamp(),
        ];

        $url = "https://api.hasoffers.com/Api?" . http_build_query($option);

        $url = "https://api.hasoffers.com/Api?" .  http_build_query($option);

        if($dry_run)
            return $url;

        return $this->curl($url);
    }

    public function cancelOrder(ShopOrder $shopOrder, ShopSetting $twShopSetting, $dry_run = false)
    {
        $revenue = $twShopSetting->getCommission(
            $shopOrder->getOrderAmount()
        );

        $option = $this->option;

        $option['data'] = [
            'offer_id' => $twShopSetting->getOfferId(),
            'advertiser_id' => $twShopSetting->getAdvertiserId(),
            'sale_amount' => $shopOrder->getOrderAmount(),
            'affiliate_id' => $twShopSetting->getAffiliateId(),
            'payout' => $revenue,
            'revenue' => $revenue,
            'advertiser_info' => $shopOrder->getOrderId(),
            'affiliate_info1' => $shopOrder->getRid(),
            'ad_id' => $shopOrder->getClickId(),
            'is_adjustment' => 1,
            'session_datetime' => $shopOrder->getCreateStamp(),
        ];

        $url = "https://api.hasoffers.com/Api?" .  http_build_query($option);

        if($dry_run)
            return $url;

        return $this->curl($url);
    }

    private function curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0");
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
