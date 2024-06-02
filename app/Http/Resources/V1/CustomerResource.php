<?php

namespace App\Http\Resources\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //    parent::toArray($request);

        $id=$request->id;
        $data=Customer::where('id',$id)->select('id','name','type','email','address','city','state','postal_code')->get();
          return [$data];
    }
}
