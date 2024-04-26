<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\CheckoutController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Http\Services\Payment\Thawani;
use App\Models\Admin\Order;
use App\Models\Admin\OrderDetails;
use App\Models\Admin\Product;

class PaymentCallbackController extends Controller
{
    //
    public function success()
    {
        $session_id = Session::get('payment_session_id');

        $client = new Thawani(config('services.thawani.secret_key'), config('services.thawani.publish_key'), config('services.thawani.mode'));

        $result = $client->getPaymentSession($session_id);
        Order::findOrFail($result['data']['client_reference_id'])->update([
            'Payment_Status' => PAYMENT_SUCCESS
        ]);

        session()->forget('Coupon_Id');
        session()->forget('Points_Amount');
        session()->forget('redeemedPoints');
        Cart::destroy();
        return redirect()->route('checkout.thankyou_page')->with('success', 'Order successfully created!');
    }
    public function cancel()
    {
        return redirect()->route('checkout')->with('error', 'Order cancel!');
    }
}
