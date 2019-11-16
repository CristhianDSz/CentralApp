@extends('layouts.master')

@section('header-title')
    Usuarios de central app
@endsection

@section('subheader-title')
Usuarios de central app
@endsection

@section('content')
    <div class="columns">
    <div class="column is-10 is-offset-1">
            <div class="card">
                <div class="card-content">
                    @include('partials.errors')
                <form action="{{route('users.update', $user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="field">
                        <label class="label">Nombre del usuario</label>
                        <div class="control">
                        <input name="name" value="{{$user->name}}" class="input" type="text" placeholder="Nombre del usuario">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Nombre del usuario</label>
                        <div class="control">
                        <input name="email" value="{{$user->email}}" class="input" type="email" placeholder="Correo del usuario">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Rol</label>
                        <div class="control">
                        <div class="select is-fullwidth">
                            <select name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}" {{$role->id == $user->role_id ? 'selected' : ''}}>{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control">
                        <input name="password" class="input" type="password" placeholder="Contraseña del usuario">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control">
                        <input name="password_confirmation" class="input" type="password" placeholder="Confirmar contraseña del usuario">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Áreas</label>
                        <div class="control">
                        <div class="select is-multiple is-fullwidth">
                            <select name="areas[]" multiple size="10">
                                @foreach ($areas as $area)
                                <option value="{{$area->id}}"
                                {{$user->existentMandatoryAreas($area->id) ? 'selected' : ''}}>{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="control has-text-right">
                        <button type="submit" class="button is-primary">Guardar cambios</button>
                        <a href="{{route('users.index')}}" class="button is-danger ">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
