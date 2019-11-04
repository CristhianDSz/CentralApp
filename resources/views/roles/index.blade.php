@extends('layouts.master')

@section('header-title')
    Roles de central app
@endsection

@section('subheader-title')
Roles de central app
@endsection

@section('content')
      <div class="has-text-right" style="margin-bottom:1em;">
          <a href="{{route('roles.create')}}" class="button"><span class="icon is-small"><i class="fa fa-plus"></i></span> <span>Crear nuevo</span></a>
      </div>
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
                    <th class="has-text-centered">Rol</th>
                    <th class="has-text-centered">Permisos</th>
                    <th class="has-text-centered">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td class="has-text-centered">
                          {{$role->name}}
                        </td>
                        <td>
                            @if (count($role->permissions) > 0)
                                @foreach ($role->permissions as $permission)
                                  <span>{{$permission->description}}, </span>
                                @endforeach
                            @endif
                        </td>
                        <td class="has-text-centered">
                            <a href="{{route('roles.edit', $role->id)}}">
                              <i class="fa fa-edit is-size-5 has-text-primary"></i>
                            </a>
                            <a href="{{route('roles.destroy', $role->id)}}" onclick="event.preventDefault();
                            document.getElementById('destroy-form').submit()">
                              <i class="fa fa-trash is-size-5 has-text-danger"></i>
                            </a>
                            <form id="destroy-form" action="{{route('roles.destroy',    $role->id)}}" method="POST" style="display:none">
                              @csrf
                              @method('DELETE')
                            </form>
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