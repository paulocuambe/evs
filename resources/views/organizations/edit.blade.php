@extends('users._layout')
@section('page')
    Actualizar Organização
@endsection

@section('content')
    @isset($organization)
        <div class="w-full md:max-w-lg ">
            <form method="POST" action="{{ route('organizations.update', ['id' => $organization->id]) }}">
                @csrf
                @method('PUT')
                <div class="grid gap-2">
                    <div class="form-group">
                        <label class="label-base" for="name">Organização</label>
                        <input class="input-base" value="{{ $organization->name }}" placeholder="Maputo Sul" type="text" name="name" id="name" required>
                        @if(isset($errors) && $errors->has('name'))
                            <p class="form-input-error">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="label-base" for="description">Descrição</label>
                        <textarea class="h-48 input-base" name="description" id="description" rows="50">{{ $organization->description }}</textarea>
                        @if(isset($errors) && $errors->has('description'))
                            <p class="form-input-error">{{ $errors->first('description') }}</p>
                        @endif
                    </div>

                    <div class="flex justify-between items-end">
                        <button type="submit" class="w-24 btn-primary">Actualizar</button>
                        <a href="{{ route('organizations')}}" class="text-lg text-dashboard">Voltar</a>
                    </div>
                </div>

            </form>
        </div>
    @endisset
@endsection


