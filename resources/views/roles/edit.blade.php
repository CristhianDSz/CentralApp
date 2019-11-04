@extends('layouts.master')

@section('header-title')
    Roles de central app
@endsection

@section('subheader-title')
Roles de central app
@endsection

@section('content')
    <div class="columns">
    <div class="column is-10 is-offset-1">
            <div class="card">
                <div class="card-content">
                    @include('partials.errors')
                <form action="{{route('roles.update', $role->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="field">
                        <label class="label">Nombre del rol</label>
                        <div class="control">
                        <input name="name" value="{{$role->name}}" class="input" type="text" placeholder="Nombre del rol">
                        </div>
                        </div>
                        <div class="field">
                            <label class="label">Permisos</label>
                            <div class="control">
                            <div class="select is-multiple is-fullwidth">
                                <select name="permissions[]" multiple size="10">
                                    @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}"
                                    {{$role->existentPermission($permission->id) ? 'selected' : ''}}>{{$permission->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                    <div class="control has-text-right">
                        <button type="submit" class="button is-primary">Guardar cambios</button>
                        <a href="{{route('roles.index')}}" class="button is-danger ">Cancelar</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
