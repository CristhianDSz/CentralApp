@extends('layouts.master')

@section('header-title')
    Áreas obligatorias y asignaturas
@endsection

@section('subheader-title')
    Áreas obligatorias y asignaturas
@endsection

@section('content')
<div class="card">
    <div class="card-filter">
        <div class="field">
            <div class="control has-icons-left has-icons-right">
                <input class="input" id="table-search" type="text" placeholder="Buscar registros">
                <span class="icon is-left">
                    <i class="fa fa-search"></i>
                </span>
            </div>
        </div>
        <div class="field has-addons">
            <p class="control">
                <a class="button" href="#">
                    <span class="icon is-small">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span>Crear nueva</span>
                </a>
            </p>
        </div>
    </div>
    <div class="card-content">
        <div id="datatable_wrapper" class="dataTables_wrapper dt-bulma no-footer"><div class="columns table-wrapper">
            <div class="column is-12"><table class="table is-hoverable is-bordered is-fullwidth dataTable no-footer" id="datatable" role="grid" aria-describedby="datatable_info">
            <thead>
                <tr role="row">
                    <th style="width: 105.2px;">No</th>
                    <th style="width: 529.2px;">Name</th>
                    <th style="width: 198.2px;">Action</th>
                </tr>
            </thead>
            <tbody>
            <tr role="row" class="odd">
                    <td class="sorting_1">1</td>
                    <td>Matemáticas</td>
                    <td class="has-text-centered">
                        <div class="field is-grouped action">
                            <p class="control">
                                <a href="/countries/edit/1" class="button is-rounded is-text">
                                    <span class="icon">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                </a>
                            </p>
                            <p class="control">
                                <a class="button is-rounded is-text action-delete" data-id="1">
                                    <span class="icon">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </a>
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
</div>
</div>
@endsection