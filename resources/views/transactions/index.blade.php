@extends('_layouts.dashboard')
@section('title')
    Transações
@endsection

@section('page')
    Transações
@endsection

@section('main')
    <div class="mb-4">
        <form method="get" action="" class="mt-2 grid lg:grid-cols-4 gap-4">
            <div>
                <label class="label-base" for="customerId1">Serviço</label>
                <select class="input-base" name="account" id="account">
                    <option value>------------</option>
                    @isset($accounts)
                        @foreach($accounts as $account)
                            <option {{ request('account') == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->account }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <div>
                <label class="label-base" for="msisdn">Numero</label>
                <input class="input-base" name="msisdn" placeholder="Numero de telefone" type="number" value="{{ request('msisdn') }}" id="msisdn">
            </div>

            <div>
                <label class="label-base" for="requestID">Cod. Referencia</label>
                <input class="input-base" name="request_id" placeholder="Numero da pesquisa..." type="number" value="{{ request('request_id') }}" id="requestId">
            </div>

            <div>
                <label class="label-base" for="initialDate">Data Inicial</label>
                <input class="input-base" name="initial_date" type="date" value="{{ request('initial_date') }}" id="initialDate">
            </div>

            <div>
                <label class="label-base" for="finalDate">Data Final</label>
                <input class="input-base" name="final_date" type="date" value="{{ request('final_date') }}" id="finalDate">
            </div>

            <div class="flex justify-between">
                <button class="self-end w-32 btn-primary" type="submit">Pesquisar</button>
                <div class="self-end">
                    <a href="" class="mt-2 text-red-500 hover:font-semibold underline">Limpar filtros</a>
                </div>
            </div>
        </form>
    </div>

    @if(isset($errors) && $errors->has('empty_params'))
        <p class="text-lg text-red-600">{{ $errors->first('empty_params') }}</p>
    @endif

    @isset($transactions)
        @if(count($transactions) > 0)
            <div class="mt-12">
                @if(!empty(request()->except(['page'])))
                    <form action="" method="get" class="flex justify-end mb-4">
                        @csrf
                        <input type="hidden" name="account" value="{{ request()->input('account') }}">
                        <input type="hidden" name="msisdn" value="{{ request()->input('msisdn') }}">
                        <input type="hidden" name="request_id" value="{{ request()->input('request_id') }}">
                        <input type="hidden" name="initial_date" value="{{ request()->input('initial_date') }}">
                        <input type="hidden" name="initial_hour" value="{{ request()->input('initial_hour') }}">
                        <input type="hidden" name="final_date" value="{{ request()->input('final_date') }}">
                        <input type="hidden" name="final_hour" value="{{ request()->input('final_hour') }}">
                        <button class="text-green-500 underline">Baixar (.xlsx)</button>
                    </form>
                @endif
                <main>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="text-left bg-gray-300">
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">TransacNo</th>
                                <th class="border px-4 py-2">MSISDN</th>
                                <th class="border px-4 py-2">CUST_ID</th>
                                <th class="border px-4 py-2">Srv_id</th>
                                <th class="border px-4 py-2">i9_refno</th>
                                <th class="border px-4 py-2">CUST_REQ_ID</th>
                                <th class="border px-4 py-2">DEALER</th>
                                <th class="border px-4 py-2">Amount</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Req_Ts</th>
                                <th class="border px-4 py-2">End_Ts</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="border px-4 py-2">{{ $transaction->id }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->transacNo }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->msisdn_or_mno }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->cust_id }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->srv_id }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->i9_refno }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->cust_req_id }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->dealer->company }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->amount }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->transacStatus }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->req_ts }}</td>
                                    <td class="border px-4 py-2">{{ $transaction->end_ts }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $transactions->withQueryString()->links() }}
                    </div>
                </main>
            </div>
        @else
            <div class="mt-10 w-full border-2 border-gray-400 border-dashed p-4">
                <h2 class="text-gray-600 text-center text-2xl">Sem resultados para os filtros aplicados.</h2>
            </div>
        @endif
    @endisset
@endsection
