<?php

namespace App\Http\Controllers;

use App\User;
use App\Sale;
use App\Product;
use App\Delivery;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function mostSold(User $user, $year, $month)
    {
        $products = [];
        $date = "'".$year."-".$month."%'";
        $sales = \DB::select("SELECT * FROM `sales` WHERE created_at LIKE " . $date . " AND user_id = " . $user->id);
        foreach($sales as $sale){
            foreach(json_decode($sale->products) as $product){
                if(isset($products[$product->sku])){
                     $products[$product->sku]['qty']+= $product->qty;
                }
                else {
                    $products[$product->sku]['name'] = $product->name;
                    $products[$product->sku]['qty'] = $product->qty;
                }
            }
        }
        
        arsort($products, SORT_NUMERIC);
        $newArray = array_slice($products, 0, 5, true);
        return $newArray;
    }
}
