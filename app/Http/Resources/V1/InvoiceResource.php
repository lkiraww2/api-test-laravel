<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Invoice;
class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $id=$request->id;
       $data=Invoice::where('id',$id)->select('id','customer_id','amount','status','billed_deted','paid_deted')->get();
       return [$data];
    }
}
