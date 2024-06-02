<?php
namespace App\Services\V1;

use Illuminate\Http\Request;
use  App\Http\Resources\V1\CustomerqullatinResource;

class CustomerQuery{
    protected $safeParms=[
        'name' =>['eq'],
        'type' =>['eq'],
        'email' =>['eq'],
        'address' =>['eq'],
        'city' =>['eq'],
        'state' =>['eq'],
        'postalcode' =>['eq','gt','lt'],
    ];
    protected $columnMap=[
        'postalcode' =>'postal_code'
    ];
    protected $operatorMap=[
        'eq'=>'=',
         'lt'=>'<',
        //  'lte'=>'',    //  'gte'=>'', بسبب مفيش علامه اكبر ويساوى فى كبيوؤد 
         'gt'=>'<',
      
    ];
    public function inde(Request $request){
        return new CustomerqullatinResource($request);

    }
    public function transform(Request $request){
        $eloQuery=[];
        foreach($this->safeParms as $parm =>$operators){
            $query=$request->query($parm);
            if(isset($query)){
                continue;
            }
            $column=$this->columnMap[$parm] ?? $parm;
            $query=$request->query($parm);
            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[]=[$column,$this->operatorMap[$operator],$query[$operator]];
                }
            }
          
        }
        
        return $eloQuery;
    }
}