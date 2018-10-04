
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
                <div class="card-header">Schritt 4: Bilder uploaden - Projektnummer: {{ $project_id }} - Max. <span id="max_img_show">{{$max_img}} </span> Fotos
                </div>


                  
                  <div class="card-body">
                    @if(count($current_images) !=0)
                      <h6>Previous Upload</h6>
                    @endif
                    <div class="row">
                      @foreach($current_images as $current_image)
                        <div class="col-md-2" id="image_{{$current_image->id}}" style="">
                          <button class="btn btn-success btn-danger btn-block btn-sm btn-delete-image" imageId="{{$current_image->id}}" thumb_url="{{$current_image->thumb_url}}" url="{{$current_image->url}}" >Delete</button>
                          <img src="{{url($current_image->thumb_url)}}" style="height:auto; width: 100%;">
                          
                        </div>
                      @endforeach
                      <hr>
                    </div>

                    <br><br>

                    @if($max_img > 0)
                      <form action="{{ url('/images-save') }}" data-count= "{{ $cats->count }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                          {{ csrf_field() }} {{ Form::hidden('cat_id', $cats->id) }} {{ form::hidden('project_id', $project_id )}}
                      </form>
                      <div class="row" id="ferting-btn" style="display: none;">
                        <div class="col-sm-4 col-sm-offset-4">
                          <a class="btn btn-success btn-block" href="{{ route('project-show') }}"><b>Fertig</b></a>
                        </div>
                      </div>
                    @else
                  </div>


                  
                    <br>
                    <br>
                    <br>
                    <h2 class="text-center">You can not add image any more.</h2>
                    <br>
                    <br>
                    <br>
                    <div class="row" id="ferting-btn">
                      <div class="col-sm-4 col-sm-offset-4">
                        <a class="btn btn-success btn-block" href="{{ route('project-show') }}"><b>Back</b></a>
                      </div>
                    </div>

                  @endif

                  
                  <br>
                </div>
              </div>

          </div>
      </div>
  </div>
</div>
<input type = "hidden" name = "ajax_token" value = "{{csrf_token()}}">
<script>
    var total_photos_counter = 0;
    var max = {{ $cats->count }};
    var maxFiles = {{ $max_img }};
    Dropzone.options.myDropzone = {
        maxFiles: '{{ $max_img }}',
        paramName: 'file',
        maxFilesize: 2, // MB
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
    $(document).ready(function(){
      $('.btn-delete-image').click(function(){

      var id = $(this).attr("imageId");
      var thumb_url = $(this).attr("thumb_url");
      var url = $(this).attr("url");

      var token = $('input[name="ajax_token"]').val();
      $.ajax({
          url: '{{url('/project/delete-image')}}',
          type: 'POST',

          data: {
              thumb_url : thumb_url,
              url : url,
              id : id,
              _token : token
          },
          success: function(response){
              location.reload();
          }
      });

        
      });
    });
    
</script>

@endsection
