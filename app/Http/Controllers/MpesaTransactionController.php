<?php

namespace App\Http\Controllers;

use App\models\MpesaTransaction;
use App\models\Stkpush;
use Illuminate\Http\Request;

class MpesaTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stk_push()
    {
        $stk_push = Stkpush::first('data');
        $data = json_decode($stk_push->data);
        $data_1 = array(
            'data' => $data
        );
        return view('saf', compact('data_1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stk_push = Stkpush::first('data');
        $data = $stk_push['data']->Body->stkCallback->CallbackMetadata->Item;

        dd($data);

        $stk_push->MpesaReceiptNumber = $data->MpesaReceiptNumber;
        $stk_push->Balance = $data->Balance;
        $stk_push->TransactionDate = $data->TransactionDate;
        $stk_push->PhoneNumber = $data->PhoneNumber;


        $stk_push->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\MpesaTransaction  $mpesaTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(MpesaTransaction $mpesaTransaction)
    {

        $stk_push = Stkpush::first('data');
        $data = json_decode($stk_push->data);

        $data = $data->Body->stkCallback->CallbackMetadata->Item;

        $stk = new Stkpush;

        $cols = [];
        $vals = [];

        foreach ($data as $key => $value) {
            $val_arr = ((array) $value);
            $cols[] = $val_arr['Name'];
            $vals[] = (array_key_exists('Value', $val_arr)) ? $value->Value : '';
        }

        $stk_data =  array_combine( $cols, $vals);

        $stk->Amount = $stk_data['Amount'];
        $stk->MpesaReceiptNumber = $stk_data['MpesaReceiptNumber'];
        $stk->Balance = $stk_data['Balance'];
        $stk->TransactionDate = $stk_data['TransactionDate'];
        $stk->PhoneNumber = $stk_data['PhoneNumber'];
        $stk->save();
        return $stk;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\MpesaTransaction  $mpesaTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(MpesaTransaction $mpesaTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\MpesaTransaction  $mpesaTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MpesaTransaction $mpesaTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\MpesaTransaction  $mpesaTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(MpesaTransaction $mpesaTransaction)
    {
        //
    }
}
