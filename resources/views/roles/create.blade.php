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
                <form action="{{route('roles.store')}}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nombre del rol</label>
                        <div class="control">
                        <input name="name" value="{{old('name')}}" class="input" type="text" placeholder="Nombre del rol">
                        </div>
                        </div>
                        <div class="field">
                            <label class="label">Permisos</label>
                            <div class="control">
                            <div class="select is-multiple is-fullwidth">
                                <select name="permissions[]" multiple size="10">
                                    @foreach ($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                        </div>
                    <div class="control">
                        <button type="submit" class="button is-primary is-fullwidth">Agregar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
