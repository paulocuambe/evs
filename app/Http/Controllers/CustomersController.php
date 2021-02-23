<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::query()->select(['id', 'status', 'account', 'apikey', 'descr', 'disabled_msg', 'creationDate'])->paginate();
        return view('customers.index')->with(['customers'=>$customers]);
    }
}
