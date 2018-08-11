
  <script src="{{url('js/dropzone.js')}}"></script>
  <link rel="stylesheet" href="{{url('css/dropzone.css')}}">
@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Schritt 4: Bilder uploaden - Projektnummer: {{ $project_id }} - {{ $cats->hints }}

                </div>

                  <div class="card-body">
                    <form action="{{ url('/images-save') }}" data-count= "{{ $cats->count }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                        {{ csrf_field() }} {{ Form::hidden('cat_id', $cats->id) }} {{ form::hidden('project_id', $project_id )}}
                    </form>
                  </div><a href="{{ route('project-show') }}" style="margin-left: 90%"><b style="color: black">Fertig</b></a>
                </div>
              </div>

          </div>
      </div>
  </div>
</div>

<script>
    var max = {{ $cats->count }};
    Dropzone.options.myDropzone = {
        paramName: 'file',
        maxFilesize: 2, // MB
        maxFiles: max,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
    };
</script>
@endsection
