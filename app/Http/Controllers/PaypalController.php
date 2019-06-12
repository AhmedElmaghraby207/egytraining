<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Netshell\Paypal\Facades\Paypal;
use Illuminate\Support\Facades\Redirect;
use PayPal\Api\Currency;
use PayPal\Api\Payout;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;

class PaypalController extends Controller
{
    private $_apiContext;

    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('paypal.client_id'),
            config('paypal.secret'));

        $this->_apiContext->setConfig(array(
            'mode' => config('paypal.mode'),
            'service.EndPoint' => config('paypal.link_mode'),
            'http.ConnectionTimeOut' => config('paypal.timeout'),
            'log.LogEnabled' => config('paypal.enable_log'),
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }

    public function getCheckout($currency, $desc, $price)
    {
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');

        $amount = PayPal:: Amount();
        $amount->setCurrency($currency);
        $amount->setTotal($price); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.

        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription($desc);

        $redirectUrls = PayPal::RedirectUrls();
        $redirectUrls->setReturnUrl(action('WebsiteCoursesController@getDone')); //localhost/egytraining/paypal/done
        $redirectUrls->setCancelUrl(action('WebsiteCoursesController@getCancel')); //localhost/egytraining/paypal/cancel

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));
        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return Redirect::to( $redirectUrl );
    }

    public function getDone($id, $token, $payer_id)
    {
        $payment = PayPal::getById($id, $this->_apiContext);
        $paymentExecution = PayPal::PaymentExecution();
        $paymentExecution->setPayerId($payer_id);
        //return  dd($payment->execute($paymentExecution, $this->_apiContext));
        return $payment->execute($paymentExecution, $this->_apiContext);
    }

    public function payout()
    {
        $payouts    =   new Payout();
        $senderBatchHeader  = new PayoutSenderBatchHeader();

        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a ");

        $senderItem1    =   new PayoutItem();
        $senderItem1->setRecipientType('Email')
            ->setNote("New Payment")
            ->setReceiver('xxx@gmail.com')
            ->setSenderItemId(uniqid())
            ->setAmount(new Currency('{
        "value":"99",
        "currency":"USD"
        }'));

        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem1);

        $request    =   clone $payouts;

        try{
            $output =   $payouts->create(null, $this->_apiContext);
        }catch (Exception $ex){
            return $ex->getMessage();
        }
        return $output;
    }

}
