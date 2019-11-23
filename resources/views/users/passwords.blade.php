@extends('layouts.master')

@section('header-title')
    Cambiar contraseña de usuario
@endsection

@section('subheader-title')
Cambiar contraseña de usuario
@endsection


@section('content')
    <div class="row">
        <div class="columns">
            <div class="column is-8 is-offset-2">
                @include('partials.errors')
            <form action="{{route('passwords.update',auth()->user()->id)}}" method="POST">
                @csrf
                @method('PATCH')
                    <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control">
                        <input name="password" class="input" type="password" placeholder="Contraseña del usuario">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Confirmar contraseña</label>
                        <div class="control">
                        <input name="password_confirmation" class="input" type="password" placeholder="Confirmar contraseña del usuario">
                        </div>
                    </div>
                    <div class="field has-text-left">
                        <button type="submit" class="button is-primary is-fullwidth">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection