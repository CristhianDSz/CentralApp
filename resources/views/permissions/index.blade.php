
@extends('layouts.master')

@section('header-title')
    Permisos
@endsection

@section('subheader-title')
    Permisos
@endsection

@section('content')
   <div class="message is-info is-size-7">
    <p class="message-body">
        Actualmente el sistema cuenta con los siguientes permisos, estos permisos se encuentran relacionados con cada uno de los roles de la aplicación:
    </p>
   </div>

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
                <th style="width: 105.2px;">No</th>
                <th class="has-text-centered" style="width: 529.2px;">Nombre del permiso</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td class="has-text-centered">{{$permission->description}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection


 