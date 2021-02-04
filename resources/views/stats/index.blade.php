@extends('_layouts.dashboard')
@section('title')
    Stats
@endsection

@section('page')
    Estatísticas
@endsection

@section('main')
    <div class="mb-4">
        <div class="">
            <form method="get" action="{{ route('stats') }}" class="mt-2 grid md:grid-cols-5 gap-4">
                <div>
                    <label class="label-base" for="customerId1">Id1 do cliente</label>
                    <input class="input-base" name="customer_id1" type="number" value="{{ request('customer_id1') }}" id="customerId1">
                </div>
            
                <div>
                    <label class="label-base" for="customerId2">Id2 da conta</label>
                    <input class="input-base" name="customer_id2" type="number" value="{{ request('customer_id2') }}" id="customerId2">
                </div>

                <div>
                    <label class="label-base" for="initialDate">Data Inicial</label>
                    <input class="input-base" name="initial_date" type="date" value="{{ request('initial_date') }}" id="initialDate">
                </div>

                <div>
                    <label class="label-base" for="finalDate">Data Final</label>
                    <input class="input-base" name="final_date" type="date" value="{{ request('final_date') }}" id="finalDate">
                </div>


                <div class="flex w-24 ">
                    <button class="btn-primary self-end" type="submit">Pesquisar</button>
                </div>
            </form>

            <div class="mt-2">
                <a href="{{ route('stats') }}" class="mt-2 text-sm text-red-500 hover:font-semibold underline">Limpar
                    filtros</a>
            </div>
        </div>
        <div class="mt-10">
            <div>
                <form action="" method="get" class="flex justify-end mb-4">
                    @csrf
                    <input type="hidden" name="customer_id1" value="{{ request()->input('customer_id1') }}">
                    <input type="hidden" name="customer_id2" value="{{ request()->input('customer_id2') }}">
                    <input type="hidden" name="initial_date" value="{{ request()->input('initial_date') }}">
                    <input type="hidden" name="final_date" value="{{ request()->input('final_date') }}">
                    <button class="text-green-500 underline">Baixar (.xlsx)</button>
                </form>
            </div>

            @isset($stats)
                <div class="grid md:grid-cols-2 gap-16">
                    <table class="w-full h-full table-auto">
                        <thead class="text-left bg-gray-300">
                        <tr>
                            <th class="bg-gray-900 text-center text-white border px-4 py-2" colspan="6">
                                Airtime
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center bg-gray-400 border px-4 py-2" colspan="6">
                                Periodo: <span class="font-normal">{{ request()->input('initial_date') ?? '-' }} áte {{ request()->input('final_date') ?? '*' }}</span>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <th class="text-white bg-red-700 px-4 py-2" colspan="2">Vodacom</th>
                            <th class="text-white bg-green-700 px-4 py-2" colspan="2">Tmcel</th>
                            <th class="text-white bg-orange-600 px-4 py-2" colspan="2">Movitel</th>
                        </tr>
                        <tr>
                            <th class="font-normal bg-red-500 px-4 py-2">Pinless</th>
                            <th class="font-normal bg-red-500 px-4 py-2">Pin</th>
                            <th class="font-normal bg-green-500 px-4 py-2">Pinless</th>
                            <th class="font-normal bg-green-500 px-4 py-2">Pin</th>
                            <th class="font-normal bg-orange-500 px-4 py-2">Pinless</th>
                            <th class="font-normal bg-orange-500 px-4 py-2">Pin</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $stats['vodacom']['pinless']['qtty'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['vodacom']['pin']['qtty'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['tmcel']['pinless']['qtty'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['tmcel']['pin']['qtty'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['movitel']['pinless']['qtty'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['movitel']['pin']['qtty'] }}</td>
                        </tr>
                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $stats['vodacom']['pinless']['amount'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['vodacom']['pin']['amount'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['tmcel']['pinless']['amount'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['tmcel']['pin']['amount'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['movitel']['pinless']['amount'] }}</td>
                            <td class="border px-4 py-2">{{ $stats['movitel']['pin']['amount'] }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="w-1/2 table-auto">
                        <thead class="text-left bg-gray-300">
                        <tr>
                            <th class="bg-orange-600 text-center text-white border px-4 py-2" colspan="6">
                                CREDELEC
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center bg-gray-400 border px-4 py-2" colspan="6">
                                Periodo: <span class="font-normal">{{ request()->input('initial_date') ?? '*' }} áte {{ request()->input('final_date') ?? '*' }}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $stats['credelec']['qtty'] }}</td>
                        </tr>
                        <tr class="bg-white">
                            <td class="border px-4 py-2">{{ $stats['credelec']['amount'] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endisset

            @isset($errors)
                @if($errors->has('search_params'))
                    <h2 class="text-2xl text-red-600">{{$errors->first('search_params')}}</h2>
                @endif
            @endisset
        </div>
    </div>
@endsection
