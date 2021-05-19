<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Proyecto;
use Illuminate\Http\Request;

use Stripe;
use Session;

class PaymentController extends Controller
{
    public function index($id)
    {
        return view('pasarela');
    }

    public function makePayment(Request $request)
    {
        //dd($request);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->dineros * 50,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => $request->nombre
        ]);

        Session::flash('success', 'Payment successfully made.');

        return back();
    }

    public function paymentSuccess(Plan $plan){
        Plan::find($plan->id)->increment('participantes');
        Proyecto::find($plan->idProyecto)->increment('financiacionActual',$plan->precio);
        $proyecto = Proyecto::find($plan->idProyecto);
        return redirect()->route('proyecto',['title'=>$proyecto->title]);
    }
}
