@extends('layouts.master')

@section('header-title')
    Información de la institución
@endsection

@section('subheader-title')
    Información de la institución
@endsection

@section('content')
  @if (!$school)
    <div class="notification is-warning">
        Actualmente no ha registrado la institución. Puede realizar esta acción completando el registro en la parte inferior.
      </div>

    @include('partials.errors')
        
    
    <form action="{{route('schools.store') }}" method="POST" enctype="multipart/form-data">
       @csrf
       <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label">Logo</label>
            </div>
            <div class="field-body">
                <div class="field">
                    <div class="file">
                        <label class="file-label">
                        <input class="file-input" id="file" type="file" name="logo">
                            <span class="file-cta">
                            <span class="file-icon">
                                <i class="fa fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Seleccione archivo…
                            </span>
                            </span>
                        </label>
                        </div>
                    <p class="help">Tamaño recomendado 100x100, 150x150</p>
                    <div id="preview" style="width:150px"></div>
                </div>
            </div>
        </div>

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">Nombre *</label>
        </div>
        <div class="field-body">
          <div class="field">
            <p class="control is-expanded has-icons-left">
            <input class="input" value="{{old('name')}}" type="text" name="name" placeholder="Nombre del colegio">
              <span class="icon is-small is-left">
                <i class="fa fa-building"></i>
              </span>
            </p>
        </div>
        </div>
      </div>
      
      <div class="field is-horizontal">
        <div class="field-label is-normal">
            <label class="label">Ciudad *</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded has-icons-left">
              <input class="input" value="{{old('location')}}" name="location" type="text" placeholder="Ciudad/Departamento">
                <span class="icon is-small is-left">
                  <i class="fa fa-map"></i>
                </span>
              </p>
          </div>
          </div>
      </div>
      
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">Teléfono *</label>
        </div>
        <div class="field-body">
            <div class="field">
                <p class="control is-expanded has-icons-left">
                  <input class="input" value="{{old('phone')}}" name="phone" type="text" placeholder="Teléfono">
                  <span class="icon is-small is-left">
                    <i class="fa fa-phone"></i>
                  </span>
                </p>
            </div>
        </div>
      </div>
      
      
      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">Dirección</label>
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <textarea class="textarea" name="address" placeholder="Dirección o direcciones">{{old('address')}}</textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="field is-horizontal">
        <div class="field-label is-normal">
          <label class="label">Sitio web</label>
        </div>
        <div class="field-body">
            <div class="field">
                <p class="control is-expanded has-icons-left">
                  <input class="input" value="{{old('website')}}" name="website" type="text" placeholder="Url del sitio">
                  <span class="icon is-small is-left">
                    <i class="fa fa-cloud"></i>
                  </span>
                </p>
            </div>
        </div>
      </div>
      
      <div class="field is-horizontal">
        <div class="field-label">
          <!-- Left empty for spacing -->
        </div>
        <div class="field-body">
          <div class="field">
            <div class="control">
              <button class="button is-primary is-fullwidth" type="submit">
                Crear institución
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
    
  @else
  <div class="card article">
    <div class="card-content">
         <div class="columns">
            <div class="column">
                <div class="content article-body has-text-centered">
                    <p class="title article-title">Institución: {{$school->name}}</p>
                    <p class="subtitle is-6 article-subtitle">
                      Sitio web: <a href="{{$school->website}}" target="_blank">{{$school->website}}</a>
                    </p>
                    <p>
                        Direccion: {{$school->address}}
                    </p>
                    <p>
                        Ciudad: {{$school->location}}
                    </p>
                    <p> Teléfono: {{$school->phone}}</p>
                </div>
                <div class="edit-info has-text-centered">
                <a href="{{route('schools.edit',$school->id)}}" class="button is-outlined is-link">Editar información</a>
                </div>
              </div>
            <div class="column">
              <div class="media">
                  <div class="media-center">
                  <img width="400" height="400" src="{{$school->logo ? asset('storage/'.$school->logo) : 'https://ui-avatars.com/api/?name=Centrall+App'}}" class="author-image" alt="Placeholder image">
                  </div>
              </div>
            </div>
         </div>
    </div>
  </div>
  @endif
@endsection

@section('scripts')
    <script>
        let inputFile = document.getElementById('file')
        inputFile.addEventListener('change', (e) => {
            let reader = new FileReader()

            reader.addEventListener('load', () => {
                let preview = document.getElementById('preview')
                let image = document.createElement('img')
                image.src = reader.result

                preview.innerHTML = ''
                preview.appendChild(image)
            })
            
            reader.readAsDataURL(e.target.files[0])
        })
    </script>
@endsection