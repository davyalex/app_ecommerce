<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //home dashboard
    public function index(){
        $orders_attente = Order::orderBy('created_at','DESC')
        ->whereStatus('attente')
        ->get();
        return view('admin.admin',compact('orders_attente'));
      
    }

   

}
