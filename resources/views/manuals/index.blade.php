@extends('layouts.master')

@section('header-title')
    Manuales de la aplicación
@endsection

@section('subheader-title')
    Manuales de la aplicación
@endsection

@section('content')

@if (!count($manuals) > 0)
    <div class="notification is-warning">
        Actualmente no ha subido ningún Manual. Puede realizar esta acción dando clic al botón en la parte inferior.
    </div>
    @can('create', App\Manual::class)
        <div class="row has-text-centered">
            <a href="{{route('manuals.create')}}" class="button is-primary">Crear Manual</a>
        </div>
    @else
        <p class="help">No cuenta con permisos para la creación de manuales. Contacte a su administrador.</p>
    @endcan
@else
   <div class="row">
       <div class="columns">
           <div class="column is-10 is-offset-1">
               <div class="has-text-centered">
                <a href="{{route('manuals.create')}}" class="button is-primary">Crear nuevo</a>
                </div>
           </div>
       </div>
       <div class="columns">
           <div class="column is-10 is-offset-1">
               <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="has-text-centered">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manuals as $manual)
                        <tr>
                            <td>
                                {{$manual->name}}
                            </td>
                            <td class="has-text-centered">
                                @can('update', $manual)
                                    <a href="{{route('manuals.edit',$manual->id)}}" class="button is-primary is-small">Editar</a>
                                @endcan

                                 <a href="{{Storage::disk('s3')->url($manual->file)}}" target="_blank" class="button is-info is-small">Visualizar</a>
                                 
                                @can('delete', $manual)
                                    <form action="{{route('manuals.destroy',$manual->id)}}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger is-small" onclick="return confirm('¿Está seguro(a)? Este proceso es irreversible!')">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
       </div>
   </div>

    
@endif
    
@endsection