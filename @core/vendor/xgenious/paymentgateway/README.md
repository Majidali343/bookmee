# paymentgateway

> General information about this package.
## Installation For laravel 8x

##### Configure Your Composer.json file to install this package
add below code to your ``composer.json`` file

````shell
 "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Sharifur/paymentgateway.git"
        }
    ],
````

run below command to install this package from your command promt or terminal
````shell
composer require xgenious/paymentgateway 
````

if this payment package asked you for username and password here is it or generate your own token.
```apacheconf

```


Information about the installation procedure for this package.
> use Version 3.x for laravel 9
> all payment gateway is now support v2/v3

## Supported Payment Gateway List

1. Paytm
2. PayPal
3. Stripe 
4. Midtrans
5. Razorpay
6. Mollie
7. FlutterwaveRave
8. Paystack
9. Payfast
10. Cashfree 
11. Instamojo 
12. Mercado pago 
13. Squareup 
14. Cinetpay 
15. PayTabs 
16. BillPlz 
17. Zitopay 
18. Toyyibpay 
19. Pagali 
20. Autorize.Net 
* PayU (upcoming) 
* PerfectMoney (upcoming)
* payumoney (upcoming)
* Paytr (upcoming)
* Authorized.net (upcoming)
* Pagseguro (upcoming)


## Payment Request Function With params v1
here is an example of a ``Controller`` method to charge a customer, this is same for all of available payment gateway in this package

```php
 public function payment(Request $request)
    {
         return XgPaymentGateway::payfast()->charge_customer([ 
            //payfast is an example you can added all of payment gateawy name in lowercase
            'amount' => 10, // amount you want to charge from customer
            'title' => 'this is test title', // payment title
            'description' => 'this is test description', // payment description
            'ipn_url' => route('stripe.ipn'), //you will get payment response in this route
            'order_id' => 5, // your order number
            'track' => 'asdfasdfsdf', // a random number to keep track of your payment 
            'cancel_url' => route('payment.failed'), //payment gateway will redirect here if the payment is failed
            'success_url' => route('payment.success'), // payment gateway will redirect here after success
            'email' => 'dvrobin4@gmail.com', // user email
            'name' => 'sharifur rhamna', // user name
            'payment_type' => 'order', // which kind of payment your are receving from customer
        ]);
    }
 ```



## Payment Ipn Function v1

here is an example of a ``Controller`` method to ipn response, this is same for all of available payment gateway in this package

```php
    public function payfast_ipn()
    {
        dd(XgPaymentGateway::payfast()->ipn_response());
    }
 ```


## Paytm

[Checkout Paytm Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/paytm/)

Here is Test Credentials For Paytm
````dotenv
PAYTM_ENVIRONMENT=local // local|production
PAYTM_MERCHANT_ID=Digita57697814558795
PAYTM_MERCHANT_KEY="dv0XtmsPYpewNag&"
PAYTM_MERCHANT_WEBSITE="WEBSTAGING"
PAYTM_CHANNEL=""
PAYTM_INDUSTRY_TYPE=""
PAYTM_ENVIRONMENT="local" // values : (local | production)
````


#### Paytm ipn route example
````php
Route::post('/paytm-ipn', [\App\Http\Controllers\PaymentLogController::class,'paytm_ipn'] )->name('payment.paytm.ipn');
````
you must have to excluded paytm ipn route from csrf token verify, go to `app/Http/Middleware` ``VerifyCsrfToken`` Middleware add your route path here in ``$except`` array

````php
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'paytm-ipn'
    ];
}
````


## 2.0 Setup For Paytm
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php

$paytm = XgPaymentGateway::paytm();
$paytm->setMerchantId('Digita57697814558795');
$paytm->setMerchantKey('dv0XtmsPYpewNag&');
$paytm->setMerchantWebsite('WEBSTAGING');
$paytm->setChannel('WEB');
$paytm->setIndustryType('Retail');
$paytm->setCurrency("EUR");
$paytm->setEnv(true); // this must be type of boolean , string will not work
$paytm->setExchangeRate(74); // if INR not set as currency

$response =  $paytm->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.paytm.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$paytm = XgPaymentGateway::paytm();
$paytm->setMerchantId('Digita57697814558795');
$paytm->setMerchantKey('dv0XtmsPYpewNag&');
$paytm->setMerchantWebsite('WEBSTAGING');
$paytm->setChannel('WEB');
$paytm->setIndustryType('Retail');
$paytm->setEnv(true); //env must set as boolean, string will not work
dd($paytm->ipn_response());

```



## CinetPay

[Checkout CinetPay Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/cinetpay/)


#### Paytm ipn route example
````php
Route::post('/cinetpay-ipn', [\App\Http\Controllers\PaymentLogController::class,'cinetpay_ipn'] )->name('payment.cinetpay.ipn');
````
you must have to excluded cinetpay ipn route from csrf token verify, go to `app/Http/Middleware` ``VerifyCsrfToken`` Middleware add your route path here in ``$except`` array

````php
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'cinetpay-ipn'
    ];
}
````


## 2.0 Setup For Cinetpay
Cinetpay payment gateway is only supported in version  > v2.x

#### charge_customer method example
```php
$cinetpay = XgPaymentGateway::cinetpay();
$cinetpay->setAppKey('LE9C12TNM5HAS');
$cinetpay->setSiteId('EAAAEOuLQObrVwJvCvoio3H13b8Ssqz1ighmTBKZvIENW9qxirHGHkqsGcPBC1uN');
$cinetpay->setCurrency("USD");
$cinetpay->setEnv(true);
$cinetpay->setExchangeRate(74); // if ['XOF', 'XAF', 'CDF', 'GNF', 'USD'] not set as currency

$response =  $paytm->charge_customer([
    'amount' => 10, // minimum 100 amount is required to process payment if usd not set as currency
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.cinetpay.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$cinetpay = XgPaymentGateway::cinetpay();
$cinetpay->setAppKey('LE9C12TNM5HAS');
$cinetpay->setSiteId('EAAAEOuLQObrVwJvCvoio3H13b8Ssqz1ighmTBKZvIENW9qxirHGHkqsGcPBC1uN');
$cinetpay->setEnv(true); //env must set as boolean, string will not work
dd($cinetpay->ipn_response());

```


#### CinetPay test credentials
```apacheconf
apiKey = "12912847765bc0db748fdd44.40081707"; 
site_id = "445160";
```


## PayPal

[Checkout Paypal Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/paypal/)

Here is Test Credentials For Paypal
````dotenv
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID='AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb'
PAYPAL_SANDBOX_CLIENT_SECRET='EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y'
PAYPAL_SANDBOX_APP_ID="641651651958"
PAYPAL_LIVE_CLIENT_ID=""
PAYPAL_LIVE_CLIENT_SECRET=""
PAYPAL_LIVE_APP_ID=""
PAYPAL_PAYMENT_ACTION=""
PAYPAL_CURRENCY="USD"
PAYPAL_NOTIFY_URL="http://gateway.test/paypal/ipn"
PAYPAL_LOCALE="en_GB"
PAYPAL_VALIDATE_SSL="false"
````

#### Paypal ipn route example
````php
Route::get('/paypal-ipn', [\App\Http\Controllers\PaymentLogController::class,'paypal_ipn'] )->name('payment.paypal.ipn');
````


## 2.0 Setup For Paypal
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php

$paypal = XgPaymentGateway::paypal();
$paypal->setClientId('client_id'); // provide sandbox id if payment env set to true, otherwise provide live credentials
$paypal->setClientSecret('client_secret'); // provide sandbox id if payment env set to true, otherwise provide live credentials
$paypal->setAppId('app_id'); // provide sandbox id if payment env set to true, otherwise provide live credentials
$paypal->setCurrency("EUR");
$paypal->setEnv(true); //env must set as boolean, string will not work
$paypal->setExchangeRate(74); // if INR not set as currency

$response =  $paypal->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$paypal = XgPaymentGateway::paypal();
$paypal->setClientId('AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb');
$paypal->setClientSecret('EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y');
$paypal->setEnv(true); //env must set as boolean, string will not work
$paypal->setAppId('641651651958');
dd($paypal->ipn_response());

```


## Stripe

[Checkout Stripe Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/stripe/)


Here is Test Credentials For Stripe
````dotenv
STRIPE_PUBLIC_KEY=pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x
STRIPE_SECRET_KEY=sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw
````


#### Stripe ipn route example
````php
Route::get('/stripe-ipn', [\App\Http\Controllers\PaymentLogController::class,'stripe_ipn'] )->name('payment.stripe.ipn');
````


## 2.0 Setup For Stripe
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php
$stripe = XgPaymentGateway::stripe();
$stripe->setSecretKey('sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw');
$stripe->setPublicKey('pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x');
$stripe->setCurrency("EUR");
$stripe->setEnv(true); //env must set as boolean, string will not work
$stripe->setExchangeRate(74); // if INR not set as currency

$response =  $stripe->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$stripe = XgPaymentGateway::stripe();
$stripe->setSecretKey('sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw');
$stripe->setPublicKey('pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x');
$stripe->setEnv(true); //env must set as boolean, string will not work
dd($stripe->ipn_response());

```


## Midtrans

[Checkout Midtrans Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/midtrans/)


Here is Test Credentials For Midtrans

````dotenv
MIDTRANS_MERCHANT_ID="G770543580"
MIDTRANS_SERVER_KEY="SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on"
MIDTRANS_CLIENT_KEY="SB-Mid-client-iDuy-jKdZHkLjL_I"
MIDTRANS_ENVAIRONTMENT="false"
````

## 2.0 Setup For Midtrans
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php
$midtrans = XgPaymentGateway::midtrans();
$midtrans->setClientKey('SB-Mid-client-iDuy-jKdZHkLjL_I');
$midtrans->setServerKey('SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on');
$midtrans->setCurrency("IDR");
$midtrans->setEnv(true); //true mean sandbox mode , false means live mode
$midtrans->setExchangeRate(74); // if IDR not set as currency

$response =  $midtrans->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$midtrans->setClientKey('client_key');
$midtrans->setServerKey('server_key');
$midtrans->setEnv(true); //true mean sandbox mode , false means live mode
dd($midtrans->ipn_response());

```


#### Midtrans ipn route example
````php
Route::get('/midtrans-ipn', [\App\Http\Controllers\PaymentLogController::class,'midtrans_ipn'] )->name('payment.midtrans.ipn');
````

#### Midtrans Test Cards
```
VISA                                        Description
4811 1111 1111 1114                         3DS Enabled
4911 1111 1111 1113                         3DS Enabled. Transaction Denied by Bank

4411 1111 1111 1118                         3DS Disabled
4511 1111 1111 1117                         3DS Disabled. Challenged by Fraud Detection
4611 1111 1111 1116                         3DS Disabled. Denied by Fraud Detection
4711 1111 1111 1115                         3DS Disabled. Transaction Denied by Bank

MASTERCARD                                  Description
5211 1111 1111 1117                         3DS Enabled
5111 1111 1111 1118                         3DS Enabled. Transaction Denied by Bank

5410 1111 1111 1116                         3DS Disabled
5510 1111 1111 1115                         3DS Disabled. Challenged by Fraud Detection
5411 1111 1111 1115                         3DS Disabled. Denied by Fraud Detection
5511 1111 1111 1114                         3DS Disabled. Transaction Denied by Bank
```

## Razorpay

[Checkout Razorpay Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/razorpay/)


Here is Test Credentials For Razorpay

````dotenv
RAZORPAY_API_KEY="rzp_test_SXk7LZqsBPpAkj"
RAZORPAY_API_SECRET="Nenvq0aYArtYBDOGgmMH7JNv"
````
#### Razorpay ipn route example
````php
Route::post('/razorpay-ipn', [\App\Http\Controllers\PaymentLogController::class,'razorpay_ipn'] )->name('payment.razorpay.ipn');
````

#### Razorpay test card
```apacheconf
TEST MODE

card - Visa
number - 4111 1111 1111 1111
CVV - Random CVV
Expiry - Any future date

```


## 2.0 Setup For Razorpay
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php

$razorpay = XgPaymentGateway::razorpay();
$razorpay->setApiKey('rzp_test_SXk7LZqsBPpAkj');
$razorpay->setApiSecret('Nenvq0aYArtYBDOGgmMH7JNv');
$razorpay->setCurrency("EUR");
$razorpay->setEnv(true); //env must set as boolean, string will not work
$razorpay->setExchangeRate(74); // if INR not set as currency

$response =  $razorpay->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$razorpay = XgPaymentGateway::razorpay();
$razorpay->setApiKey('rzp_test_SXk7LZqsBPpAkj');
$razorpay->setApiSecret('Nenvq0aYArtYBDOGgmMH7JNv');
$razorpay->setEnv(true); //env must set as boolean, string will not work
dd($razorpay->ipn_response());

```



## Mollie
[Checkout Mollie Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/mollie/)

Here is Test Credentials For Mollie

````dotenv
MOLLIE_KEY=test_fVk76gNbAp6ryrtRjfAVvzjxSHxC2v
````
#### Mollie ipn route example
````php
Route::get('/mollie-ipn', [\App\Http\Controllers\PaymentLogController::class,'mollie_ipn'] )->name('payment.razorpay.ipn');
````



## 2.0 Setup For Mollie
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php

$mollie = XgPaymentGateway::mollie();
$mollie->setApiKey('api_key');
$mollie->setCurrency("EUR");
$mollie->setEnv(true); //env must set as boolean, string will not work
$mollie->setExchangeRate(74); // if INR not set as currency

$response =  $mollie->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.mollie.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$mollie = XgPaymentGateway::mollie();
$mollie->setApiKey('api_key');
$mollie->setCurrency("EUR");
$mollie->setEnv(true); //env must set as boolean, string will not work
$mollie->setExchangeRate(74); // if INR not set as currency
dd($mollie->ipn_response());

```


## FlutterwaveRave

[Checkout Flutterwave Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/flutterwave/)


Here is Test Credentials For Flutterwave

````dotenv
FLW_PUBLIC_KEY=FLWPUBK_TEST-86cce2ec43c63e09a517290a8347fcab-X
FLW_SECRET_KEY=FLWSECK_TEST-d37a42d8917db84f1b2f47c125252d0a-X
FLW_SECRET_HASH="fundorex"
````

#### FlutterwaveRave ipn route example
````php
Route::get('/flutterwave-ipn', [\App\Http\Controllers\PaymentLogController::class,'flutterwave_ipn'] )->name('payment.flutterwave.ipn');
````

###### Test Cards
````apacheconf
Test MasterCard PIN authentication
 Card number: 5531 8866 5214 2950
 cvv: 564
 Expiry: 09/32
 Pin: 3310
 OTP: 12345

Card number: 4556052704172643
  cvv: 899
  Expiry: 09/32
  Pin: 3310
  OTP: 12345

````



## 2.0 Setup For Flutterwave
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php

$flutterwave = XgPaymentGateway::flutterwave();
$flutterwave->setPublicKey('FLWPUBK_TEST-86cce2ec43c63e09a517290a8347fcab-X');
$flutterwave->setSecretKey('FLWSECK_TEST-d37a42d8917db84f1b2f47c125252d0a-X');
$flutterwave->setCurrency("USD");
$flutterwave->setEnv(true); //env must set as boolean, string will not work
$flutterwave->setExchangeRate(74); // if NGN not set as currency

$response =  $flutterwave->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```

#### ipn_response method example

```php
$flutterwave = XgPaymentGateway::flutterwave();
$flutterwave->setPublicKey('FLWPUBK_TEST-86cce2ec43c63e09a517290a8347fcab-X');
$flutterwave->setSecretKey('FLWSECK_TEST-d37a42d8917db84f1b2f47c125252d0a-X');
$flutterwave->setCurrency("USD");
$flutterwave->setEnv(true);  //env must set as boolean, string will not work
dd($flutterwave->ipn_response());

```




## Paystack

[Checkout Paystack Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/paystack/)

Here is Test Credentials For Paystack

````dotenv
PAYSTACK_PUBLIC_KEY=pk_test_a7e58f850adce9a73750e61668d4f492f67abcd9
PAYSTACK_SECRET_KEY=sk_test_2a458001d806c878aba51955b962b3c8ed78f04b
PAYSTACK_PAYMENT_URL=https://api.paystack.co
MERCHANT_EMAIL=sopnilsohan03@gmail.com
````

#### Paystack ipn route example
````php
Route::get('/paystack-ipn', [\App\Http\Controllers\PaymentLogController::class,'paystack_ipn'] )->name('payment.paystack.ipn');
````

> Note: paystack does not support multiple ipn route, it supports only one webhook you can add in paystack dashboard. you can use $arg['payment_type'] data for check which kind of payment processed


## 2.0 Setup For Paystack
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php

$paystack = XgPaymentGateway::paystack();
$paystack->setPublicKey('pk_test_a7e58f850adce9a73750e61668d4f492f67abcd9');
$paystack->setSecretKey('sk_test_2a458001d806c878aba51955b962b3c8ed78f04b');
$paystack->setMerchantEmail('sopnilsohan03@gmail.com');
$paystack->setCurrency("EUR");
$paystack->setEnv(true); //env must set as boolean, string will not work
$paystack->setExchangeRate(74); // if NGN not set as currency

$response =  $paystack->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$paystack = XgPaymentGateway::paystack();
$paystack->setPublicKey('pk_test_a7e58f850adce9a73750e61668d4f492f67abcd9');
$paystack->setSecretKey('sk_test_2a458001d806c878aba51955b962b3c8ed78f04b');
$paystack->setMerchantEmail('sopnilsohan03@gmail.com');
$paystack->setEnv(true);  //env must set as boolean, string will not work
dd($paystack->ipn_response());

```



## Payfast
[Checkout Payfast Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/payfast/)

Here is Test Credentials For Payfast

````dotenv
PF_MERCHANT_ID=10024000
PF_MERCHANT_KEY=77jcu5v4ufdod
PAYFAST_PASSPHRASE=testpayfastsohan
PF_MERCHANT_ENV=true
PF_ITN_URL="https://fundorex.test/donation-payfast"
````

#### Payfast ipn route example
````php
Route::post('/payfast-ipn', [\App\Http\Controllers\PaymentLogController::class,'payfast_ipn'] )->name('payment.payfast.ipn');
````
you must have to excluded Payfast ipn route from csrf token verify, go to `app/Http/Middleware` ``VerifyCsrfToken`` Middleware add your route path here in ``$except`` array

````php
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'payfast-ipn'
    ];
}
````
## 2.0 Setup For Payfast
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php

$payfast = XgPaymentGateway::payfast();
$payfast->setMerchantId('10024000');
$payfast->setMerchantKey('77jcu5v4ufdod');
$payfast->setPassphrase('testpayfastsohan');
$payfast->setCurrency("ZAR");
$payfast->setEnv(true); //env must set as boolean, string will not work
$payfast->setExchangeRate(74); // if INR not set as currency

$response =  $payfast->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$payfast = XgPaymentGateway::payfast();
$payfast->setMerchantId('10024000');
$payfast->setMerchantKey('77jcu5v4ufdod');
$payfast->setPassphrase('testpayfastsohan');
$payfast->setCurrency("ZAR");
$payfast->setEnv(true); //env must set as boolean, string will not work
dd($payfast->ipn_response());

```



## Cashfree
[Checkout Cashfree Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/cashfree/)

Here is Test Credentials For Cashfree
````dotenv
CASHFREE_TEST_MODE=true
CASHFREE_APP_ID="94527832f47d6e74fa6ca5e3c72549"
CASHFREE_SECRET_KEY="ec6a3222018c676e95436b2e26e89c1ec6be2830"
````

#### Cashfree ipn route example
````php
Route::post('/cashfree-ipn', [\App\Http\Controllers\PaymentLogController::class,'cashfree_ipn'] )->name('payment.cashfree.ipn');
````
you must have to excluded Cashfree ipn route from csrf token verify, go to `app/Http/Middleware` ``VerifyCsrfToken`` Middleware add your route path here in ``$except`` array

````php
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'cashfree-ipn'
    ];
}
````
## 2.0 Setup For Cashfree
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example 
```php
$cashfree = XgPaymentGateway::cashfree();
$cashfree->setAppId('app_id');
$cashfree->setSecretKey('secret_key');
$cashfree->setCurrency("USD");
$cashfree->setEnv(true); //true means sandbox, false means live , //env must set as boolean, string will not work
$cashfree->setExchangeRate(74); // if INR not set as currency

$response =  $cashfree->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.cashfree.ipn'),
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$cashfree = XgPaymentGateway::cashfree();
$cashfree->setAppId('app_id');
$cashfree->setSecretKey('secret_key');
$cashfree->setEnv(true); //true means sandbox, false means live  //env must set as boolean, string will not work
dd($cashfree->ipn_response());

```


## Instamojo
[Checkout Instamojo Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/instamojo)

Here is Test Credentials For Instamojo

````dotenv
INSTAMOJO_CLIENT_ID=test_nhpJ3RvWObd3uryoIYF0gjKby5NB5xu6S9Z
INSTAMOJO_CLIENT_SECRET=test_iZusG4P35maQVPTfqutbCc6UEbba3iesbCbrYM7zOtDaJUdbPz76QOnBcDgblC53YBEgsymqn2sx3NVEPbl3b5coA3uLqV1ikxKquOeXSWr8Ruy7eaKUMX1yBbm
INSTAMOJO_USERNAME=""
INSTAMOJO_PASSWORD=""
INSTAMOJO_TEST_MODE="true"
````
>> Instamojo Pago only works with INR currency

#### Instamojo ipn route example
````php
Route::get('/instamojo-ipn', [\App\Http\Controllers\PaymentLogController::class,'instamojo_ipn'] )->name('payment.instamojo.ipn');
````

##### Test Credentials for Instamojo
````
mobile number 919090213229
For payments use the following card details:
Number: 4242 4242 4242 4242
Date: Any valid future date
CVV: 111
Name: abc
3D-secure password: 1221
````

## 2.0 Setup For Instamojo
route and middleware code will be same as version ^1.0, version ^2.0 will change only customer_charge and ipn_response method

#### charge_customer method example
```php
$instamojo = XgPaymentGateway::instamojo();
$instamojo->setClientId('client_id');
$instamojo->setSecretKey('secret_key');
$instamojo->setCurrency("INR");
$instamojo->setEnv(true); //true mean sandbox mode , false means live mode //env must set as boolean, string will not work
$instamojo->setExchangeRate(74); // if INR not set as currency

$response =  $instamojo->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$instamojo = XgPaymentGateway::instamojo();
$instamojo->setClientId('client_id');
$instamojo->setSecretKey('secret_key');
$instamojo->setEnv(true); //env must set as boolean, string will not work
dd($instamojo->ipn_response());

```


## Mercadopago

[Checkout Mercadopago Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/mercadopago/)

Here is Test Credentials For Mercadopago 

````dotenv
MERCADO_PAGO_CLIENT_ID=TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769
MERCADO_PAGO_CLIENT_SECRET=TEST-4644184554273630-070813-7d817e2ca1576e75884001d0755f8a7a-786499991
MERCADO_PAGO_TEST_MODE=true
````
>> Mercado Pago only works with BRL currency 

#### Mercado ipn route example
````php
Route::get('/mercadopago-ipn', [\App\Http\Controllers\PaymentLogController::class,'mercadopago_ipn'] )->name('payment.mercadopago.ipn');
````

##### Test Credentials for Mercadopago
````
For payments use the following card details:
Number: 5031 4332 1540 6351
Date: 11/25
CVV: 123
Name: abc
````


## 2.0 Setup For Instamojo
route and middleware code will be same as version ^1.0, version ^2.0, will change only customer_charge and ipn_response method

#### charge_customer method example
```php
$marcadopago = XgPaymentGateway::marcadopago();
$marcadopago->setClientId('client_id');
$marcadopago->setClientSecret('client_secret');
$marcadopago->setCurrency("USD");
$marcadopago->setExchangeRate(82); // if BRL not set as currency, you must have to provide exchange rate for it
$marcadopago->setEnv(true); ////true mean sandbox mode , false means live mode
$response =  $marcadopago->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.instamojo.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example

```php
$marcadopago = XgPaymentGateway::marcadopago();
$marcadopago->setClientId('client_id');
$marcadopago->setClientSecret('client_secret');
$marcadopago->setEnv(true); 
dd($marcadopago->ipn_response());

```


## Squareup

[Checkout Squareup Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/how-to-get-square-payment-gateway-api-credentials/)

Here is Test Credentials For Squareup 

>> Squareup supported currency list

#### Squareup ipn route example
````php
Route::get('/Squareup-ipn', [\App\Http\Controllers\PaymentLogController::class,'Squareup_ipn'] )->name('payment.mercadopago.ipn');
````

##### Api Credentials for Squareup
```apacheconf
access_token = 'EAAAEOuLQObrVwJvCvoio3H13b8Ssqz1ighmTBKZvIENW9qxirHGHkqsGcPBC1uN'
location_id = 'LE9C12TNM5HAS'
```
##### Test Credentials for Squareup
````
Mastercard	5105 1051 0510 5100	
CVC: 111
Date: any future date

Discover	
6011 0000 0000 0004	
CVC: 111
Date: any future date

Diners Club	3000 000000 0004	
CVC: 111
Date: any future date


JCB	3569 9900 1009 5841	
CVC: 111
Date: any future date

Name: Test
Email: test@gmail.com
````


## 2.0 Setup For Squareup
#### charge_customer method example
```php
$squareup = XgPaymentGateway::squareup();
$squareup->setLocationId('location_id');
$squareup->setAccessToken('access_token');
$squareup->setApplicationId('');
$squareup->setCurrency("USD");
$squareup->setEnv(true);
$squareup->setExchangeRate(74); // if INR not set as currency
$response =  $squareup->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.get.ipn'),
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
 return $response;
```
#### ipn_response method example

```php
$squareup = XgPaymentGateway::squareup();
$squareup->setLocationId('location_id');
$squareup->setAccessToken('access_token');
$squareup->setApplicationId('');
$squareup->setCurrency("USD");
$squareup->setEnv(true);
dd($squareup->ipn_response());

```


## PayTabs

[Checkout PayTabs Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/how-to-get-paytabs-payment-gateway-api-credentials/)

Here is Test Credentials For PayTabs 

>> PayTabs supported currency list

#### PayTabs ipn route example
````php
Route::post('/paytabs-ipn', [\App\Http\Controllers\PaymentLogController::class,'paytabs_ipn'] )->name('payment.mercadopago.ipn');
````

#### Add This class to config/app.php (Its Mendatory)
````php
\Paytabscom\Laravel_paytabs\PaypageServiceProvider::class
````

##### Api Credentials for PayTabs
```phpregexp
[
'currency' => 'USD', //['AED','EGP','SAR','OMR','JOD','USD']
'profile_id' => '96698',
'region' => 'GLOBAL', // ['ARE','EGY','SAU','OMN','JOR','GLOBAL']
'server_key' => 'SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L'
]
```
##### Test Credentials for PayTabs
````
Number	            Scheme	CVV	3D enrolled

4000000000000002	Visa	123	Yes
4111111111111111	Visa	123	No
4012001036983332	Visa	530	Yes
5498383801606532	MasterCard	977	Yes
5200000000000007	MasterCard	977	Yes
5200000000000114	MasterCard	977	No
````


## 2.0 Setup For PayTabs
#### charge_customer method example
```php
$paytabs = XgPaymentGateway::paytabs();
$paytabs->setProfileId('96698');
$paytabs->setRegion('GLOBAL');
$paytabs->setServerKey('SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L');
$paytabs->setCurrency("USD");
$paytabs->setEnv(true);
$paytabs->setExchangeRate(74); // if ['AED','EGP','SAR','OMR','JOD','USD'] not set as currency
$response =  $paytabs->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.post.ipn'),
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example for PayTabs

```php
$paytabs = XgPaymentGateway::paytabs();
$paytabs->setProfileId('96698');
$paytabs->setRegion('GLOBAL');
$paytabs->setServerKey('SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L');
$paytabs->setCurrency("USD");
dd($paytabs->ipn_response());

```

## 2.0 Setup For BillPlz
[Checkout BillPlz Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/how-to-setup-api-for-billplz-payment-gateway/)

>> Billplz supported currency list ['MYR]


#### Billplz ipn route example
````php
Route::post('/billplz-ipn', [\App\Http\Controllers\PaymentLogController::class,'billplz_ipn'] )->name('payment.billplz.ipn');
````

##### Api Credentials for Billplz
```phpregexp
[
'key' => 'b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6',
'version' => 'v4',
'x_signature' => 'S-HDXHxRJB-J7rNtoktZkKJg',
'collection_name' => 'kjj5ya006'
]
```

#### charge_customer method example
```php
$billplz = XgPaymentGateway::billplz();
$billplz->setKey('b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6');
$billplz->setVersion('v4');
$billplz->setXsignature('S-HDXHxRJB-J7rNtoktZkKJg');
$billplz->setCollectionName('kjj5ya006');
$billplz->setCurrency("MYR");
$billplz->setEnv(true);
$billplz->setExchangeRate(50); // if ['MYR'] not set as currency
$response =  $billplz->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('payment.post.ipn'),
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
return $response;
```
#### ipn_response method example for Billplz

```php
$billplz = XgPaymentGateway::billplz();
$billplz->setKey('b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6');
$billplz->setVersion('v4');
$billplz->setXsignature('S-HDXHxRJB-J7rNtoktZkKJg');
$billplz->setCollectionName('kjj5ya006');
$billplz->setCurrency("MYR");
$billplz->setEnv(true);
dd($billplz->ipn_response());

```
## 2.0 Setup For Zitopay
[Checkout Zitopay Setup Documentation](https://xgenious.com/docs/nexelit/payment-gateway-settings/zitopay-payment-gateway-setup)

>> Zitopay supported currency list [
"USD",
"EUR",
"GBP",
"AED",
"AFN",
"ALL",
"AMD",
"ANG",
"AOA",
"ARS",
"AUD",
"AWG",
"AZN",
"BAM",
"BBD",
"BDT",
"BGN",
"BHD",
"BIF",
"BMD",
"BND",
"BOB",
"BRL",
"BSD",
"BTN",
"BWP",
"BYN",
"BZD",
"CAD",
"CDF",
"CHF",
"CLP",
"CNY",
"COP",
"CRC",
"CUP",
"CVE",
"CZK",
"DJF",
"DKK",
"DOP",
"DZD",
"EGP",
"ERN",
"ETB",
"FJD",
"GEL",
"GHS",
"GMD",
"GNF",
"GTQ",
"GYD",
"HNL",
"HRK",
"HTG",
"HUF",
"IDR",
"ILS",
"INR",
"IQD",
"IRR",
"ISK",
"JMD",
"JOD",
"JPY",
"KES",
"KGS",
"KHR",
"KMF",
"KPW",
"KRW",
"KWD",
"KZT",
"LAK",
"LBP",
"LKR",
"LRD",
"LSL",
"LTL",
"LVL",
"LYD",
"MAD",
"MDL",
"MGA",
"MKD",
"MMK",
"MNT",
"MRO",
"MUR",
"MVR",
"MWK",
"MXN",
"MYR",
"MZN",
"NAD",
"NGN",
"NIO",
"NOK",
"NPR",
"NZD",
"OMR",
"PAB",
"PEN",
"PGK",
"PHP",
"PKR",
"PLN",
"PYG",
"QAR",
"RON",
"RSD",
"RUB",
"RWF",
"SAR",
"SCR",
"SDG",
"SEK",
"SGD",
"SLL",
"SOS",
"SRD",
"STD",
"SVC",
"SYP",
"SZL",
"THB",
"TJS",
"TMT",
"TND",
"TOP",
"TRY",
"TTD",
"TWD",
"TZS",
"UAH",
"UGX",
"UYU",
"UZS",
"VEF",
"VND",
"VUV",
"WST",
"XCD",
"XOF",
"YER",
"ZAR",
"ZMW",
"ZWD",
"XAF",
]

#### Zitopay ipn route example
````php
Route::post('/zitopay-ipn', [\App\Http\Controllers\PaymentLogController::class,'zitopay_ipn'] )->name('payment.zitopay.ipn'); //need to exclude from csrf token varification
````
you must have to excluded Zitopay ipn route from csrf token verify, go to `app/Http/Middleware` ``VerifyCsrfToken`` Middleware add your route path here in ``$except`` array

````php
namespace App\Http\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'zitopay-ipn'
    ];
}
````

#### charge_customer method example
```php
$zitopay = XgPaymentGateway::zitopay();
$zitopay->setUsername('dvrobin4');
$zitopay->setCurrency("USD");
$zitopay->setEnv(true);
$zitopay->setExchangeRate(50); // if INR not set as currency
$args = [
    'amount' => 250,
    'title' => 'this is test title',
    'description' => 'description',
    'ipn_url' => route('payment.post.ipn'),
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'email@mgil.com',
    'name' => 'sharifur',
    'payment_type' => 'order',
];
$response =  $zitopay->charge_customer($args);
return $response;
```
#### ipn_response method example for Zitopay

```php
$zitopay = XgPaymentGateway::zitopay();
$zitopay->setUsername('dvrobin4');
$zitopay->setCurrency("USD");
$zitopay->setEnv(true);
$zitopay->setExchangeRate(50); // if INR not set as currency
dd($zitopay->ipn_response());
```

## 3.0 Setup For Toyyibpay
[Checkout Toyyibpay Setup Documentation](https://docs.xgenious.com/docs/nexelit/payment-gateway-settings/toyyibpay-payment-gateway-setup)
```php
>> Toyyibpay supported currency list ["MYR"]
````
#### Toyyibpay ipn route example
````php
Route::post('/toyyibpay-ipn', [\App\Http\Controllers\PaymentLogController::class,'toyyibpay_ipn'] )->name('payment.toyyibpay.ipn'); //need to exclude from csrf token varification
````
you must have to excluded Toyyibpay ipn route from csrf token verify, go to `app/Http/Middleware` ``VerifyCsrfToken`` Middleware add your route path here in ``$except`` array

````php
namespace App\Http\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'toyyibpay-ipn'
    ];
}
````

#### charge_customer method example
```php
$toyyibpay = XgPaymentGateway::toyyibpay();
$toyyibpay->setUserSecretKey('wnbtrqle-9t9l-m02j-e2bz-iaj2tkp52sfo');
$toyyibpay->setCategoryCode('0m0j9yc4');
$toyyibpay->setEnv(true);
$toyyibpay->setCurrency("MYR");
$toyyibpay->setExchangeRate(74); //only support MYR Currency
return $toyyibpay->charge_customer([
    'amount' => 10, 
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('post.ipn'), //post route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
    'phone' => 12345678
]);
```
#### ipn_response method example for Toyyibpay

```php
$toyyibpay = XgPaymentGateway::toyyibpay();
$toyyibpay->setUserSecretKey('wnbtrqle-9t9l-m02j-e2bz-iaj2tkp52sfo');
$toyyibpay->setCategoryCode('0m0j9yc4');
$toyyibpay->setEnv(true);
$toyyibpay->ipn_response();
```



## Setup For Pagali
[Checkout Pagali Setup Documentation](https://docs.xgenious.com/docs/nexelit/payment-gateway-settings/pagali-payment-gateway-setup)
```php
>> Pagali supported currency list ['MYR','USD','EUR','CVE']
````
#### Pagali ipn route example
````php
Route::post('/pagali-ipn', [\App\Http\Controllers\PaymentLogController::class,'pagali_ipn'] )->name('payment.pagali.ipn'); //need to exclude from csrf token varification
````
you must have to excluded Pagali ipn route from csrf token verify, go to `app/Http/Middleware` ``VerifyCsrfToken`` Middleware add your route path here in ``$except`` array

````php
namespace App\Http\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'pagali-ipn'
    ];
}
````

#### charge_customer method example
```php
$pagali = XgPaymentGateway::pagalipay();
$pagali->setPageId('');
$pagali->setEntityId('');
$pagali->setCurrency("MYR");
$pagali->setEnv(true); // this must be type of boolean , string will not work
$pagali->setExchangeRate(74); // if INR not set as currency

$response =  $pagali->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('post.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
```
#### ipn_response method example for Pagali

```php
$pagali = XgPaymentGateway::pagalipay();
$pagali->setPageId('');
$pagali->setEntityId('');
$pagali->setCurrency("MYR");
$pagali->setEnv(true); // this must be type of boolean , string will not work
dd($pagali->ipn_response());
```


## Setup For Authorize.Net
[Checkout Authorize.nnt Setup Documentation](https://docs.xgenious.com/docs/nexelit/payment-gateway-settings/authorize-payment-gateway-setup)
```php
>>  Authorize.Net supported currency list ['AUD', 'CAD', 'CHF', 'DKK', 'EUR', 'GBP', 'JPY', 'NOK', 'NZD', 'SEK', 'USD', 'ZAR'];
````
####  Authorize.Net ipn route example
````php
Route::get('/authorize-ipn', [\App\Http\Controllers\PaymentLogController::class,'authorize_ipn'] )->name('payment.authorize.ipn'); //need to exclude from csrf token varification
````

#### charge_customer method example
```php

$authorize = XgPaymentGateway::authorizenet();
$authorize->setMerchantLoginId('2e8yjNL89kV2');
$authorize->setMerchantTransactionId('65968Gb3DU2ntX2v');
$authorize->setCurrency("USD");
$authorize->setEnv(true); // this must be type of boolean , string will not work
$authorize->setExchangeRate(74); // if INR not set as currency

$response =  $authorize->charge_customer([
    'amount' => 10,
    'title' => 'this is test title',
    'description' => 'this is test description',
    'ipn_url' => route('get.ipn'), //get route
    'order_id' => 56,
    'track' => 'asdfasdfsdf',
    'cancel_url' => route('payment.failed'),
    'success_url' => route('payment.success'),
    'email' => 'dvrobin4@gmail.com',
    'name' => 'sharifur rhamna',
    'payment_type' => 'order',
]);
```
#### ipn_response method example

```php
    $authorizenet = XgPaymentGateway::authorizenet();
    $authorizenet->setMerchantLoginId('2e8yjNL89kV2');
    $authorizenet->setMerchantTransactionId('65968Gb3DU2ntX2v');
    $authorizenet->setEnv(true); // this must be type of boolean , string will not work
    dd($authorizenet->ipn_response());
```


## Currency Conversation For This Package

>you must have to add this currency value to work all the payment gateway properly, make sure you have make this rate update able from admin panel
>required only for version ^1.0
````dotenv

IDR_EXCHANGE_RATE="14365.30"
INR_EXCHANGE_RATE="74.85"
NGN_EXCHANGE_RATE="409.91"
ZAR_EXCHANGE_RATE="15.86"
BRL_EXCHANGE_RATE="5.70"
SITE_GLOBAL_CURRENCY=USD
````

## Using this package

Information about using this package

## Contributing
Information about contributing to this package.
Owner Of Package @sharifur
Bug Fix and minor Contributor
