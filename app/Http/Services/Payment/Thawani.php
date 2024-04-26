<?php


namespace App\Http\Services\Payment;


use Illuminate\Support\Facades\Http;


class Thawani
{

    const test_url = 'https://uatcheckout.thawani.om/api/v1';
    const prod_url = 'https://checkout.thawani.om/api/v1';

    protected $secret_key;
    protected $publish_key;
    protected $mode;

    protected $base_url;

    public function __construct($secret_key, $publish_key, $mode = 'prod')
    {
        $this->mode = $mode;
        $this->secret_key = $secret_key;
        $this->publish_key = $publish_key;
        if ($mode == 'test') {
            $this->base_url = self::test_url;
        } else {
            $this->base_url = self::prod_url;
        }
    }
    public function CreateCheckoutSession($data)
    {
        $response = \Http::baseUrl($this->base_url)->withHeaders([
            'thawani-api-key' => $this->secret_key
        ])->asJson()
            ->post('checkout/session', $data);

        $body = $response->json();
        if ($body['success'] == true and $body['code'] == 2004) {
            return $body['data']['session_id'];
        }
        dd($body);

        throw new \Exception($body['description'], $body['code']);
    }

    public function getPayUrl($session_id)
    {

        if ($this->mode == 'test') {
            return 'https://uatcheckout.thawani.om/pay/' . $session_id . '?key=' . $this->publish_key;
        }

        return 'https://checkout.thawani.om/pay/' . $session_id . '?key=' . $this->publish_key;
    }

    public function getPaymentSession($session_id)
    {

        return \Http::baseUrl($this->base_url)->withHeaders([
            'thawani-api-key' => $this->secret_key
        ])->get('checkout/session/' . $session_id)->json();
    }
}
