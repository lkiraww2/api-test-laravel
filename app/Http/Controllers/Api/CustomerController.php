<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoice;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerqullatinResource;
use App\Services\V1\CustomerQuery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {

        return new CustomerqullatinResource($request);
    }
    public function show(Request $request)
    {
        return new CustomerResource($request);
    }

    public function create(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'type' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',


        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Customer::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'email' => $request['email'],
            'address' => $request['address'],
            'city' => $request['city'],
            'state' => $request['state'],
            'postal_code' => $request['postal_code'],
        ])->save();


        return response()->json(['message' => 'create  successfully'], 201);


    }


    public function update(Request $request)
    {
        $Customer = new Customer;
        if (!$Customer) {
            return response()->json(['message' => 'update not   successfully']);
        }
        if ($Customer) {
            $Customer->where('id', $request->id)->update(
                [
                    'name' => $request['name'],
                    'type' => $request['type'],
                    'email' => Auth::user()->email ?? $request->email,
                    'address' => $request['address'],
                    'city' => $request['city'],
                    'state' => $request['state'],
                    'postal_code' => $request['postal_code'],
                ]
            );
            return response()->json(['message' => 'update  successfully'], 201);
        }
    }


    public function delete(Request $request)
    {
        //
        $Customer = Customer::find($request->id);
        if (!$Customer) {
            return response()->json(['message' => 'delete not   successfully']);
        }
        if ($Customer) {
            $Customer->delete();
            return response()->json(['message' => 'delete  successfully'], 201);
        }
    }

}
