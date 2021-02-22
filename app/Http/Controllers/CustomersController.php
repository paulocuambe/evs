<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate();
        return view('customers.index')->with(['customers'=>$customers]);
    }
}
