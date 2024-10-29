<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    public function createPayment()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // Define an item list
        $items = [];
        foreach (session('cart') as $cartItem) {
            $item = new Item();
            $item->setName($cartItem['name'])
                ->setCurrency('USD')
                ->setQuantity($cartItem['quantity'])
                ->setPrice($cartItem['price']);
            $items[] = $item;
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal(session('cart_total'));  // Total amount from cart

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Payment for items in the cart');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.success'))
                     ->setCancelUrl(route('payment.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

        try {
            $payment->create($this->getApiContext());
        } catch (PayPalConnectionException $ex) {
            return back()->withError('Error processing PayPal payment');
        }

        return redirect()->away($payment->getApprovalLink());
    }

    public function executePayment(Request $request)
    {
        $paymentId = $request->paymentId;
        $payerId = $request->PayerID;

        if (empty($payerId) || empty($paymentId)) {
            return back()->withError('Payment failed');
        }

        $payment = Payment::get($paymentId, $this->getApiContext());

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->getApiContext());
        } catch (PayPalConnectionException $ex) {
            return back()->withError('Error executing payment');
        }

        // Handle successful payment here

        return redirect()->route('order.success')->with('success', 'Payment successful!');
    }

    private function getApiContext()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        $apiContext->setConfig(config('paypal.settings'));

        return $apiContext;
    }
}

