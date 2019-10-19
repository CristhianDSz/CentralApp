@extends('layouts.master')

@section('header-title')
    Tablero principal
@endsection

@section('subheader-title')
    Tablero principal
@endsection

@section('content')
<div class="columns">
    <div class="column">
        <div class="box quick-stats has-background-primary has-text-white">
            <div class="quick-stats-icon">
                <span class="icon is-large">
                    <i class="fa fa-3x fa-users"></i>
                </span>
            </div>
            <div class="quick-stats-content">
                <h3 class="title is-4">Ovas</h3>
                <div class="inlinesparkline-bar"></div>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="box quick-stats has-background-info has-text-white">
            <div class="quick-stats-icon">
                <span class="icon is-large">
                    <i class="fa fa-3x fa-server"></i>
                </span>
            </div>
            <div class="quick-stats-content">
                <h3 class="title is-4">Áreas</h3>
                <div class="inlinesparkline-bar"></div>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="box quick-stats has-background-danger has-text-white">
            <div class="quick-stats-icon">
                <span class="icon is-large">
                    <i class="fa fa-3x fa-bar-chart"></i>
                </span>
            </div>
            <div class="quick-stats-content">
                <h3 class="title is-4">Docentes</h3>
                <div class="inlinesparkline-line"></div>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="box quick-stats has-background-warning has-text-white">
            <div class="quick-stats-icon">
                <span class="icon is-large">
                    <i class="fa fa-3x fa-bell"></i>
                </span>
            </div>
            <div class="quick-stats-content">
                <h3 class="title is-4">Alertas</h3>
                <div class="inlinesparkline-line"></div>
            </div>
        </div>
    </div>
</div>
<h1>Página de Inicio</h1>
@endsection

