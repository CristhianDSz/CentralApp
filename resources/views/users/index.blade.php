@extends('layouts.master')

@section('header-title')
    Usuarios de central app
@endsection

@section('subheader-title')
Usuarios de central app
@endsection

@section('content')
     @can('create', App\User::class)
     <div class="has-text-right" style="margin-bottom:1em;">
      <a href="{{route('register')}}" class="button"><span class="icon is-small"><i class="fa fa-plus"></i></span> <span>Crear nuevo</span></a>
    </div>
     @endcan
      <div class="card">
      <div class="card-content">
        <div id="datatable_wrapper" class="dataTables_wrapper dt-bulma no-footer">
          <div class="columns table-wrapper">
            <div class="column is-12">
              <table
                class="table is-hoverable is-bordered is-fullwidth dataTable no-footer"
                id="datatable"
                role="grid"
                aria-describedby="datatable_info"
              >
                <thead>
                  <tr role="row">
                    <th>No</th>
                    <th class="has-text-centered">Nombre</th>
                    <th class="has-text-centered">Correo</th>
                    <th class="has-text-centered">Rol</th>
                    <th class="has-text-centered">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td class="has-text-centered">
                          {{$user->name}}
                        </td>
                        <td class="has-text-centered">
                          {{$user->email}}
                        </td>
                        <td class="has-text-centered">{{$user->role->name}}</td>
                        <td class="has-text-centered">
                            @can('update', App\User::class)
                              <a href="{{route('users.edit', $user->id)}}">
                                <i class="fa fa-edit is-size-5 has-text-primary"></i>
                              </a>
                            @else
                              <span class="fa fa-edit is-size-5 has-text-grey-light"></span>
                            @endcan
                             @can('delete', App\User::class)
                                <form class="destroy-form" action="{{route('users.destroy',    $user->id)}}" method="POST" style="display:inline" onsubmit="return confirm('Está seguro(a)? Este cambio no se podrá revertir')">
                                  @csrf
                                  @method('DELETE')
                                  <button class="fa fa-trash is-size-5 has-text-danger"  type="submit" style="border:none;background:none;cursor:pointer"></button>
                                </form>
                             @else
                              <span class="fa fa-trash is-size-5 has-text-grey-light"></span>
                             @endcan
                        </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection