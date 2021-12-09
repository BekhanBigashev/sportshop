<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    $user = User::find(auth()->user()->id);
        return view('cabinet.home', ['user' => $user]);
    }

    public function orders()
    {
        $orders = Order::where('status', 1)->get();
        return view('cabinet.orders', compact('orders'));
    }
}
