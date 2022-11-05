<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $transaction = Transaction::count();
        $user = User::where('roles', 'user')->count();

        return view('dashboard', compact('product', 'transaction', 'user'));
    }
}
