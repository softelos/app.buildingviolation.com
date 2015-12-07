<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;

class PaymentController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    // Index, shows all the payments received so far
    
    public function index(){
        $payments=Payment::all();
        $payments_count=count($payments);
        $sum_total=$payments->sum('total');
        $sum_cost=$payments->sum('cost');
        $sum_bv_total=$payments->sum('bv_cost');
        return view('payment.index',compact('payments','payments_count','sum_total','sum_cost','sum_bv_total'));
    }
    
    public function report_paid($payment_id){
        $payment=Payment::findOrFail($payment_id);
        $payment->paid=true;
        $payment->save();
        return redirect()->action('PaymentController@index');
    }
    public function report_unpaid($payment_id){
        $payment=Payment::findOrFail($payment_id);
        $payment->paid=false;
        $payment->save();
        return redirect()->action('PaymentController@index');
    }

}
