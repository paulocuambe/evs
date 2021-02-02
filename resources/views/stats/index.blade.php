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
                    <label class="label-base" for="initialDate">Data Inicial</label>
                    <input class="input-base" name="initial_date" type="date" value="{{ request('initial_date') }}"
                           id="initialDate">
                </div>


                <div>
                    <label class="label-base" for="finalDate">Data Final</label>
                    <input class="input-base" name="final_date" type="date" value="{{ request('final_date') }}"
                           id="finalDate">
                </div>


                <div class="flex w-24 ">
                    <button class="btn-primary self-end" type="submit">Pesquisar</button>
                </div>
            </form>

            <div class="mt-2">
                <a href="" class="mt-2 text-sm text-red-500 hover:font-semibold underline">Limpar
                    filtros</a>
            </div>
        </div>

            <div class="mt-10">
                <div>
                    <form action="" method="get" class="flex justify-end mb-4">
                        @csrf
                        <input type="hidden" name="shortcode" value="{{ request()->input('shortcode') }}">
                        <input type="hidden" name="initial_date" value="{{ request()->input('initial_date') }}">
                        <input type="hidden" name="final_date" value="{{ request()->input('final_date') }}">
                        <button class="text-green-500 underline">Baixar (.xlsx)</button>
                    </form>
                </div>

                <div class="grid md:grid-cols-2 gap-16">
                    <table class="w-full h-full table-auto">
                        <thead class="text-left bg-gray-300">
                        <tr>
                            <th class="bg-gray-900 text-center text-white border px-4 py-2" colspan="6">
                                Operadora do Cliente
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center bg-gray-400 border px-4 py-2" colspan="6">
                                Periodo: <span class="font-normal">2121</span>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center bg-gray-400 px-4 py-2" colspan="6">
                                Shortcode: <span class="font-normal">jsak</span>
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
                            <td class="border px-4 py-2">Ubsasas</td>
                            <td class="border px-4 py-2">Ubsasas</td>
                            <td class="border px-4 py-2">Ubsasas</td>
                            <td class="border px-4 py-2">Ubsasas</td>
                            <td class="border px-4 py-2">Ubsasas</td>
                            <td class="border px-4 py-2">Ubsasas</td>
                        </tr>
                        </tbody>
                    </table>

                      <table class="w-full h-full table-auto">
                          <thead class="text-left bg-gray-300">
                          <tr>
                              <th class="bg-green-800 text-center text-white border px-4 py-2" colspan="6">
                                  Operadora de Roteamento
                              </th>
                          </tr>
                          <tr>
                              <th class="text-center bg-gray-400 border px-4 py-2" colspan="6">
                                  Periodo: <span class="font-normal">212121</span>
                              </th>
                          </tr>
                          <tr>
                              <th class="text-center bg-gray-400 px-4 py-2" colspan="6">
                                  Shortcode: <span class="font-normal">23232322</span>
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
                              <td class="border px-4 py-2">0</td>
                              <td class="border px-4 py-2">1212</td>
                              <td class="border px-4 py-2">32</td>
                              <td class="border px-4 py-2">43</td>
                              <td class="border px-4 py-2">433</td>
                              <td class="border px-4 py-2">832</td>
                          </tr>
                          </tbody>
                      </table>
                </div>
            <h2 class="text-2xl text-red-600">Erro</h2>
        </div>
    </div>
@endsection
