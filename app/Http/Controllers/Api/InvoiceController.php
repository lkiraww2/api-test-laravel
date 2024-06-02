<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Customer;
use  App\Http\Resources\V1\InvoiceResource;
use  App\Http\Resources\V1\InvoicequllatResource;
use Illuminate\Support\Facades\Auth;
class InvoiceController extends Controller
{
    //
    public function index(Request $request){
       
        return new InvoicequllatResource($request);
    }
    public function show(Request $request){
        return new InvoiceResource($request);
    }
 
    public function create(Request $request){
        $this->validate($request,[
            'customer_id'=>'required',
            'amount'=>'required',
            'status'=>'required',
            'billed_deted'=>'required',
            'paid_deted'=>'required',

        ]);
        Invoice::create([
            'customer_id' =>$request['customer_id'],
            'amount' =>$request['amount'],
             'status' =>$request['status'],
            'billed_deted' =>$request['billed_deted'],
             'paid_deted' =>$request['paid_deted'],
           ])->save();
     
      return response()->json(["masssage"=>"create Invoice successfully"]);
    }
    public function update(Request $request){
        $id=$request->id;
        if(!$id){
            return response()->json(['message' => 'update not id  successfully']);
        }
        if($id){
        Invoice::where('id',$id)->update([
            'customer_id' =>Auth::user()->customer_id ?? $request->customer_id,
            'amount' =>$request['amount'],
             'status' =>$request['status'],
            'billed_deted' =>$request['billed_deted'],
             'paid_deted' =>$request['paid_deted'],
        ]);
        return response()->json(['message' => 'update  successfully'], 201);
            }
    }public function delete(Request $request)
    {
        //
        Invoice::where('id',$request->id)->delete();  
        return response()->json(['message' => 'delete  successfully'], 201);
        
    }
}
