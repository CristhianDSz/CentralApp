@extends('layouts.master')

@section('header-title')
    Información de la institución
@endsection

@section('subheader-title')
    Editar información de la institución
@endsection

@section('content')
    @include('partials.errors')
        
    
    <form action="{{route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data">
       @csrf
       @method('PATCH')
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
                    <div id="preview" style="width:150px">
                        @if ($school->logo)
                          <img src="{{ asset('storage/'.$school->logo)}}" alt="Logo">
                        @endif
                    </div>
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
            <input class="input" value="{{$school->name}}" type="text" name="name" placeholder="Nombre del colegio">
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
                <input class="input" value="{{$school->location}}" name="location" type="text" placeholder="Ciudad/Departamento">
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
                  <input class="input" name="phone" value="{{$school->phone}}" type="text" placeholder="Teléfono">
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
              <textarea class="textarea" name="address" placeholder="Dirección o direcciones">{{$school->address}}</textarea>
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
                  <input class="input" name="website" value="{{$school->website}}" type="text" placeholder="Url del sitio">
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
                Editar institución
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
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