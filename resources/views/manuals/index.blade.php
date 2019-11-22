@extends('layouts.master')

@section('header-title')
    Manuales de la aplicación
@endsection

@section('subheader-title')
    Manuales de la aplicación
@endsection

@section('content')

@if (!$manual)
    <div class="notification is-warning">
        Actualmente no ha subido ningún Manual. Puede realizar esta acción completando el registro en la parte inferior.
    </div>

   <div class="row">
       <div class="columns">
           <div class="column is-8 is-offset-2">
                @include('partials.errors')
                <form action="{{route('manuals.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <div class="control">
                        <input class="input is-primary" type="text" name="name" placeholder="Nombre del manual">
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
                    <input type="submit" class="button is-primary" value="Subir">
                </div>
            </form>
           </div>
       </div>
   </div>

@else
   <div class="row">
       <div class="columns">
           <div class="column is-8 is-offset-2">
               <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="has-text-centered">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{$manual->name}}
                            </td>
                            <td class="has-text-centered">
                            <a href="{{route('manuals.edit',$manual->id)}}" class="button is-primary is-small">Editar</a>
                            <a href="{{asset('storage/'.$manual->file)}}" target="_blank" class="button is-info is-small">Visualizar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
           </div>
       </div>
   </div>

    
@endif
    
@endsection