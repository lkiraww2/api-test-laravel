<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//customer

Route::get('customer',[CustomerController::class,'index']); 
Route::post('createcustomer',[CustomerController::class,'create']); 
Route::post('updatecustomer/{id}',[CustomerController::class,'update']);
Route::get('customer/{id}',[CustomerController::class,'show']); 
Route::post('delete/{id}',[CustomerController::class,'delete']); 

//invoice
Route::get('invoice',[InvoiceController::class,'index']);
Route::post('createinvoice',[InvoiceController::class,'create']);
Route::get('invoice/{id}',[InvoiceController::class,'show']);
Route::post('updateinvoice/{id}',[InvoiceController::class,'update']);
Route::post('deleteinvoice/{id}',[InvoiceController::class,'delete']); 

//user
Route::post('createacuont',[UserController::class,'create']);
Route::post('loginaccount',[UserController::class,'login']);
