
  <script src="{{url('js/dropzone.js')}}"></script>
  <link rel="stylesheet" href="{{url('css/dropzone.css')}}">
@extends('layouts.app')

@section('content')
@if(session()->has('alert-success'))
    <div class="alert alert-success">
        {{ session()->get('alert-success') }}
    </div>
@endif
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
                  </div>

                  <div class="row" id="ferting-btn" style="display: none;">
                    <div class="col-sm-4 col-sm-offset-4">
                      <a class="btn btn-success btn-block" href="{{ route('project-show') }}"><b>Fertig</b></a>
                    </div>
                  </div>

                  
                  <br>
                </div>
              </div>

          </div>
      </div>
  </div>
</div>

<script>
    var total_photos_counter = 0;
    var max = {{ $cats->count }};
    Dropzone.options.myDropzone = {
        maxFiles: 5,
        paramName: 'file',
        maxFilesize: 2, // MB
        maxFiles: max,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,

      success: function (file, done) {
          total_photos_counter++;
          $("#counter").text("# " + total_photos_counter);
          if(total_photos_counter>0){
            $('#ferting-btn').show();
          }else{
            $('#ferting-btn').hide();
          }
      }
    };
</script>
@endsection
