<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Ova pdf</title>
    <style>
    /* @page { size: 21.59cm 27.94cm landscape; } */
    @font-face {
        font-family: SourceSansPro;
        src: url({{ storage_path('fonts\SourceSansPro-Regular.ttf') }}) format("truetype");
        }

        .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

        a {
        color: #0087C3;
        text-decoration: none;
        }

        body {
        position: relative;
        margin: 0 auto; 
        color: #555555;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        font-size: 14px; 
        font-family: SourceSansPro;
        }

        header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
        }

        #logo {
        float: left;
        margin-top: 8px;
        }

        #logo img {
        height: 70px;
        }

        #company {
        text-align: right
        }

        .ova-image {
          border-radius: 50%;
        }


        #details {
        margin-bottom: 50px;
        }

        #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
        }

        #client .to {
        color: #777777;
        }

        h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
        }

        #invoice {
        text-align: right;
        }

        #invoice h1 {
        color: #0087C3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
        }

        #invoice .date {
        font-size: 1.1em;
        color: #777777;
        }

        table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
        }

        table th,
        table td {
        padding: 20px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        table th {
        white-space: nowrap;        
        font-weight: normal;
        }

        table td {
        text-align: right;
        }

        table td h3{
        color: #0087C3;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
        }

        table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        background: #0087C3;
        }

        table .desc {
        text-align: left;
        }

        table .unit {
            background: #DDDDDD;
            text-align: center;
        }

        table .unit li {
          list-style-type: none;
        }

        table .qty {
            text-align: center;
        }
        table .qty li {
          list-style-type: none;
        }

        table .total {
        background: #0087C3;
        color: #FFFFFF;
        }

        table .total li {
          list-style-type: none;
        }

        table td.unit,
        table td.qty,
        table td.total {
        font-size: 1em;
        }

        table td.unit ul,
        table td.qty ul,
        table td.total ul {
          padding: 0;
        }

        table tbody tr:last-child td {
        border: none;
        }

        table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap; 
        border-top: 1px solid #AAAAAA; 
        }

        table tfoot tr:first-child td {
        border-top: none; 
        }

        table tfoot tr:last-child td {
        color: #0087C3;
        font-size: 1.4em;
        border-top: 1px solid #0087C3; 

        }

        table tfoot tr td:first-child {
        border: none;
        }

        #thanks{
        font-size: 2em;
        margin-bottom: 50px;
        }

        #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;  
        }

        #notices .notice {
        font-size: 1.2em;
        }

        footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
        }


    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
      <img src="{{ public_path('img/logo.jpeg')}}">
      </div>
      <div id="company">
      <h2 class="name">{{$school->name}}</h2>
      <div>{{$school->address ?? 'Sin dirección'}}</div>
      <div>{{$school->phone}}</div>
      <div>
          @if ($school->website)
            <a target="_blank" href="{{$school->website}}">{{$school->website}}</a>
          @else
            <p>Sin sitio web</p>
          @endif
      </div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">AUTOR:</div>
        <h2 class="name">{{$ova->user->name}}</h2>
        <div class="address">{{$ova->user->role->name}}</div>
        <div class="email"><a href="#">{{$ova->user->email}}</a></div>
        </div>
        <div id="invoice">
        <h1>{{$ova->theme}}</h1>
        @if ($ova->image)
        <img class="ova-image" src="{{Storage::disk('s3')->url($ova->image)}}" width="64" height="64" alt="Imagen">
        @endif
        <div class="date">Grado: {{$ova->grade->name}}</div>
        <div class="date">Clase: {{$ova->class->name}}</div>
        <div class="date">Materia: {{$ova->subject->name}}</div>
        <div class="date">Área fundamental: {{$ova->mandatoryArea->name}}</div>
        <div class="date">Fecha de creación: {{$ova->created_at->format('d-m-Y')}}</div>
        </div>
      </div>
      @if (count($ova->learningSections) > 0)
        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">#</th>
              <th class="desc">UNIDAD DE APRENDIZAJE</th>
              <th class="unit">COMPONENTES</th>
              <th class="qty">COMPETENCIAS</th>
              <th class="total">INDICADORES</th>
            </tr>
          </thead>
          <tbody>
                @foreach ($ova->learningSections as $learningSection)
                <tr>
                <td class="no">{{$loop->index + 1}}</td>
                <td class="desc"><h3>{{$learningSection->title}}</h3>{{$learningSection->context}}
                <p>Del {{$learningSection->start_date}} al {{$learningSection->end_date}}</p>
                </td>
                    <td class="unit">
                        @if (count($learningSection->components) > 0)
                            <ul>
                                @foreach ($ova->components as $component)
                                    <li>{{$component->name}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td class="qty">
                        @if (count($learningSection->components) > 0)
                            <ul>
                                @foreach ($ova->components as $component)
                                    @foreach ($component->competences as $competence)
                                        <li>{{$competence->name}}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td class="total">
                            @if (count($learningSection->components) > 0)
                            <ul>
                                @foreach ($ova->components as $component)
                                    @foreach ($component->competences as $competence)
                                       @foreach ($competence->indicators as $indicator)
                                            <li>{{$indicator->name}}</li>
                                       @endforeach
                                    @endforeach
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
             <p>
                No existen actualmente unidades de aprendizaje para esta OVA.
             </p>
          @endif
      
    @if (count($ova->learningSections) > 0)
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="unit">RECURSOS</th>
            <th class="qty">REF. BIBLIOGRÁFICAS</th>
            <th class="total">ACTIVIDADES</th>
          </tr>
        </thead>
        <tbody>
                @foreach ($ova->learningSections as $learningSection)
                <tr>
                    <td class="unit">
                        @if (count($learningSection->resources) > 0)
                            <ul>
                                @foreach ($learningSection->resources as $resource)
                                    <li>{{$resource->url}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td class="qty">
                        @if (count($learningSection->bibliographies) > 0)
                            <ul>
                                @foreach ($learningSection->bibliographies as $bibliography)
                                    <li>{{$bibliography->url}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td class="total">
                            @if (count($learningSection->homeworks) > 0)
                            <ul>
                                @foreach ($learningSection->homeworks as $homework)
                                    <li>
                                    <p>{{$homework->content}}</p>
                                    <p>Se debe presentar en: {{$homework->presentation->name}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
      @endif
    </main>
    <footer>
      Central App proyecto de grado Universidad de Investigación y Desarrollo 2019.
    </footer>
  </body>
</html>