@extends('layouts.master')

@section('styles')
    <style>
    article.post {
        margin: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #E6EAEE;
        }
    </style>
@endsection

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
                    <i class="fa fa-3x fa-book"></i>
                </span>
            </div>
            <div class="quick-stats-content">
                <h3 class="title is-4">Ovas</h3>
                <div class="inlinesparkline-bar has-text-centered">
                <span class="is-size-5">{{$countOvas}}</span>
                </div>
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
                <h3 class="title is-4">Asignaturas</h3>
                <div class="inlinesparkline-bar has-text-centered">
                    <span class="is-size-5">{{$countSubjects}}</span>

                </div>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="box quick-stats has-background-danger has-text-white">
            <div class="quick-stats-icon">
                <span class="icon is-large">
                    <i class="fa fa-3x fa-users"></i>
                </span>
            </div>
            <div class="quick-stats-content">
                <h3 class="title is-4">Usuarios</h3>
                <div class="inlinesparkline-line has-text-centered">
                    <span class="is-size-5">{{$countUsers}}</span>

                </div>
            </div>
        </div>
    </div>
    <div class="column">
        <div class="box quick-stats has-background-dark has-text-white">
            <div class="quick-stats-icon">
                <span class="icon is-large">
                    <i class="fa fa-3x fa-pencil"></i>
                </span>
            </div>
            <div class="quick-stats-content">
                <h3 class="title is-4">Cursos</h3>
                <div class="inlinesparkline-line has-text-centered">
                    <span class="is-size-5">{{$countClasses}}</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="columns">
    <div class="column">
        @if (count($ovas) > 0)
        <h3 class="is-size-7 has-text-centered">Resumen Actual de Ovas Institución</h3>
            <div class="box content">
                @foreach ($ovas as $ova)
                    <article class="post">
                    <h4>{{$ova->theme}}</h4>
                        <div class="media">
                            <div class="media-left">
                                <p class="image is-32x32">
                                <img src="https://api.adorable.io/avatars/128/{{$ova->user->name}}@adorable.pngCopy to Clipboard
                                    ">
                                </p>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                    <a href="#">{{$ova->user->name}}</a> hace {{$ova->created_at->diffForHumans()}} &nbsp;
                                    <span class="tag is-primary">{{$ova->mandatoryArea->name}}</span>
                                    <span class="tag is-info">{{$ova->subject->name}}</span>
                                    <span class="tag is-light">{{$ova->grade->name}}</span>
                                    <span class="tag is-dark">{{$ova->class->name}}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="media-right">
                                {{-- <span class="has-text-grey-light"><i class="fa fa-comments"></i> 1</span> --}}
                            </div>
                        </div>
                    </article>
                    @endforeach            
                </div>
            <div class="has-text-centered">
                {{$ovas->links()}}
            </div>
        @else
            <div class="message is-warning">
                <div class="message-body has-text-centered">
                    Actualmente no existen ovas registradas en la aplicación.
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

