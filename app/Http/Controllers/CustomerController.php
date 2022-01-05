<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CustomerController extends Controller
{

    public function store(Request $request){

        // Redis Query

        $customer_Id=Redis::get("email_".$request->email);
        if($customer_Id){
            Customer::find($customer_Id)->update($request->all());
        }else {
            Customer::create($request->all());
        }

        // DB Query

        // $customer=Customer::where("email",$request->email)->first();
        // if($customer){
        //     Customer::find($customer->id)->update($request->all());
        // }else {
        //     Customer::create($request->all());
        // }
    }
}
