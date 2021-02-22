<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    protected $searchParams = ['account', 'initial_date', 'final_date'];

    public function index(Request $request)
    {
        $data = [];
        if($request->filled('account')){
            $data['transactions'] = Transaction::with('dealer')->status('Credited')->paginate();
        } else if($request->hasAny($this->searchParams)){
            return view('transactions.index')->withErrors(['empty_params' => 'Preencha os campos de pesquisa']);
        }

        return \view('transactions.index')->with($data);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
