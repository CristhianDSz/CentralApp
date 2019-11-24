
@extends('layouts.master')

@section('header-title')
    Manuales de la aplicación
@endsection

@section('subheader-title')
    Manuales de la aplicación
@endsection


@section('content')
       <div class="row">
       <div class="columns">
           <div class="column is-8 is-offset-2">
                @include('partials.errors')
                <form action="{{route('manuals.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <div class="control">
                    <input class="input is-primary" type="text" name="name" value="{{old('name')}}" placeholder="Nombre del manual">
                    </div>
                </div>
                <div class="field">
                    <div class="file">
                        <label class="file-label">
                            <input class="file-input" type="file" name="file" accept="application/pdf">
                            <span class="file-cta">
                            <span class="file-icon">
                                <i class="fa fa-upload"></i>
                            </span>
                            <span class="file-label">
                            Seleccione el archivo…
                            </span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="field has-text-centered">
                    <a href="{{route('manuals.index')}}" class="button is-danger">Cancelar</a>
                    <input type="submit" class="button is-primary" value="Subir">
                </div>
            </form>
           </div>
       </div>
   </div>

@endsection