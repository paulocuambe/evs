<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;

class TransactionsController extends Controller
{
    protected $searchParams = ['account', 'initial_date', 'final_date'];

    public function index(Request $request)
    {
        $data = [];

        if (Auth::user()->isSuperAdmin()) {
            $data['accounts'] = Account::query()->select(['id', 'account'])->get();
        } else {
            $data['accounts'] = Account::query()->whereIn('id', Auth::user()->accounts->pluck('account_id'))->select(['id', 'account'])->get();
        }

        if ($request->filled('account')) {
            $data['transactions'] = Transaction::with('dealer')
                                        ->customers($request->input('account'))
                                        ->status('Credited')
                                        ->paginate();
        } elseif ($request->hasAny($this->searchParams)) {
            return view('transactions.index')->with($data)->withErrors(['empty_params' => 'O campo de serviço deve estar preenchido.']);
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
