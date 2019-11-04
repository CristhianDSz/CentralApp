@extends('layouts.master')

@section('header-title')
    Registrar usuario
@endsection

@section('subheader-title')
Registrar usuario
@endsection

@section('content')
    <div class="columns">
        <div class="column is-10 is-offset-1">
          <div class="card">
            <div class="card-content">
                @include('partials.errors')
                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nombre</label>
                        <div class="control">
                        <input name="name" value="{{old('name')}}" class="input" type="text" placeholder="Nombre completo">
                        </div>
                      </div>
                      
                      <div class="field">
                        <label class="label">Correo</label>
                        <div class="control">
                        <input name="email" value="{{old('email')}}" class="input" type="email" placeholder=" nombre@correo.com">
                        </div>
                      </div>
                      <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control">
                          <input name="password" class="input" type="password" placeholder="Contraseña">
                        </div>
                      </div>
                      <div class="field">
                        <label class="label">Confirmar contraseña</label>
                        <div class="control">
                          <input name="password_confirmation" class="input" type="password" placeholder="Contraseña">
                        </div>
                      </div>
                      <div class="field">
                        <label class="label">Rol</label>
                        <div class="control">
                        <div class="select is-fullwidth">
                            <select name="role_id">
                                @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                      </div>
                      <div class="field">
                        <label class="label">Áreas</label>
                        <small class="help">Mantenga presionado la tecla ctrol para seleccionar más de un aŕea.</small>
                        <div class="control">
                        <div class="select is-multiple is-fullwidth">
                            <select name="areas[]" multiple size="9">
                                @foreach ($areas as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
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