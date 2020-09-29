<?php

namespace App\Http\Controllers;

use App\models\MpesaTransaction;
use App\models\Stkpush;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MpesaController extends Controller
{
    /**
     * Lipa na M-PESA password
     * */
    public function lipaNaMpesaPassword()
    {
        $lipa_time = Carbon::rawParse('now')->format('YmdHms');
        $passkey = env('MPESA_PASS_KEY', 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919');
        // $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $BusinessShortCode = 174379;
        $timestamp = $lipa_time;

        $lipa_na_mpesa_password = base64_encode($BusinessShortCode . $passkey . $timestamp);
        return $lipa_na_mpesa_password;
    }

    /**
     * Lipa na M-PESA STK Push method
     * */

    public function customerMpesaSTKPush()
    {
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->generateAccessToken()));

        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => 174379,
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => 1,
            'PartyA' => 254743895505, // replace this with your phone number
            'PartyB' => 174379,
            'PhoneNumber' => 254743895505, // replace this with your phone number
            'CallBackURL' => 'https://apptest.swapstore.co.ke/api/v1/stk_push',
            // 'CallBackURL' => 'https://apptest.swapstore.co.ke/api/v1/laratest/transaction/confirmation',
            'AccountReference' => "Laravel app",
            'TransactionDesc' => "Testing stk push on sandbox"
        ];
        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        Log::debug('*******************');

        Log::debug($curl_response);

        Log::debug('*******************');
        return $curl_response;
    }

    public function generateAccessToken()
    {
        $consumer_key = env('MPESA_CUSTOMER_KEY', 'mdRZ2GNPrDuOtG9LZhmPgO6KUqamZQox');
        $consumer_secret = env('MPESA_SECRET', 'yGbCJfW1GXbhdhL2');
        $credentials = base64_encode($consumer_key . ":" . $consumer_secret);

        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic " . $credentials));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        $access_token = json_decode($curl_response);
        return $access_token->access_token;
    }


    /**
     * J-son Response to M-pesa API feedback - Success or Failure
     */
    public function createValidationResponse($result_code, $result_description)
    {
        $result = json_encode(["ResultCode" => $result_code, "ResultDesc" => $result_description]);
        $response = new Response();
        $response->headers->set("Content-Type", "application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }

    /**
     *  M-pesa Validation Method
     * Safaricom will only call your validation if you have requested by writing an official letter to them
     */

    public function mpesaValidation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->createValidationResponse($result_code, $result_description);
    }

    /**
     * M-pesa Transaction confirmation method, we save the transaction in our databases
     */

    public function mpesaConfirmation(Request $request)
    {

        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug($request->getContent());
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        $content = json_decode($request->getContent());

        $mpesa_transaction = new MpesaTransaction();
        $mpesa_transaction->TransactionType = $content->TransactionType;
        $mpesa_transaction->TransID = $content->TransID;
        $mpesa_transaction->TransTime = $content->TransTime;
        $mpesa_transaction->TransAmount = $content->TransAmount;
        $mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
        $mpesa_transaction->BillRefNumber = $content->BillRefNumber;
        $mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
        $mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
        $mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
        $mpesa_transaction->MSISDN = $content->MSISDN;
        $mpesa_transaction->FirstName = $content->FirstName;
        $mpesa_transaction->MiddleName = $content->MiddleName;
        $mpesa_transaction->LastName = $content->LastName;
        $mpesa_transaction->save();

        // Responding to the confirmation request
        $response = new Response();
        $response->headers->set("Content-Type", "text/xml; charset=utf-8");
        $response->setContent(json_encode(["C2BPaymentConfirmationResult" => "Success"]));

        return $response;
    }

    /**
     * M-pesa Register Validation and Confirmation method
     */
    public function mpesaRegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer ' . $this->generateAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => "600273",
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://apptest.swapstore.co.ke/api/v1/laratest/transaction/confirmation",
            'ValidationURL' => "https://apptest.swapstore.co.ke/api/v1/laratest/validation"
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }

    public function stk_push(Request $request)
    {
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug(($request->getContent()));
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');
        Log::debug('***************************************************************');

        // $stk_push = new Stkpush;
        // $stk_push->data = serialize($request->getContent());
        // $stk_push->save();

        $data = json_decode($request->getContent());

        $data = $data->Body->stkCallback->CallbackMetadata->Item;

        $stk = new Stkpush;

        $cols = [];
        $vals = [];

        foreach ($data as $key => $value) {
            $val_arr = ((array) $value);
            $cols[] = $val_arr['Name'];
            $vals[] = (array_key_exists('Value', $val_arr)) ? $value->Value : '';
        }

        $stk_data =  array_combine($cols, $vals);

        $stk->Amount = $stk_data['Amount'];
        $stk->MpesaReceiptNumber = $stk_data['MpesaReceiptNumber'];
        $stk->Balance = $stk_data['Balance'];
        $stk->TransactionDate = $stk_data['TransactionDate'];
        $stk->PhoneNumber = $stk_data['PhoneNumber'];
        $stk->save();
        return $stk;
    }
}
