@extends('_layouts.dashboard')
@section('main')

    @if(isset($accounts) && count($accounts))
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="text-left bg-gray-300">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">API Key</th>
                    <th class="border px-4 py-2">Conta</th>
                    <th class="border px-4 py-2">Descrição</th>
                    <th class="border px-4 py-2">Disabled Message</th>
                    <th class="border px-4 py-2">Estado</th>
                    <th class="border px-4 py-2">Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)
                    <tr>
                        <td class="border px-4 py-2">{{ $account->id }}</td>
                        <td class="border px-4 py-2">{{ $account->apikey }}</td>
                        <td class="border px-4 py-2">{{ $account->account }}</td>
                        <td class="border px-4 py-2">{{ $account->descr }}</td>
                        <td class="border px-4 py-2">{{ $account->disabled_msg }}</td>
                        <td class="border px-4 py-2">{{ $account->status }}</td>
                        <td class="border px-4 py-2">{{ $account->creationDate }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $accounts->links() }}
        </div>
    @else
        <div class="mt-10 w-full border-2 border-gray-400 border-dashed p-4">
            <h2 class="text-gray-600 text-center text-2xl">Sem contas a listar.</h2>
        </div>
    @endif
@endsection
