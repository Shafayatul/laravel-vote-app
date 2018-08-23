@extends('layouts.app')

@section('content')

@if(session()->has('alert-success'))
    <div class="alert alert-success">
        {{ session()->get('alert-success') }}
    </div>
@endif
<input type = "hidden" name = "ajax_token" value = "{{csrf_token()}}">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Projekte anzeigen...</div>
                  <div class="card-body">
                      @foreach($projects as $project)
                          @if($project->youtube !="")
                            <p style=""> <button link="{{ $project->youtube }}" class="btn btn-primary youtube-btn">Youtube Video</button> </p>
                          @endif
                          <p style=""><b>Kategorie: {{ $project->cat_name }}
                          <p style=""><b>Projektname:  {{ $project->name }} ID: {{ $project->id }}</b></p>
                          @if ( $project->stat === 0 )
                            <p style=""><b>Projektstatus: eingereicht</b></p>
                          @elseif ( $project->stat === 2 )
                            <p style=""><b>Projektstatus: freigegeben</b></p>
                          @elseif ($project->stat === 3 )
                            <p style=""><b>Projektstatus: zurückgewiesen</b></p>
                          @endif

                          <div class="form-group">
                              <label for="comment">Projektinfos:</label>
                              <textarea class="form-control" rows="5" id="comment">{{$project->beschreibung }} {{$project->testimonial}} {{$project->extra}}
                              </textarea>
                          </div>
                          <br>
                          <div class="row">
                          	<?php $imageCount = 0;?>
                          @foreach($project->images as $image)

                          	<?php $imageCount ++; ?>

                      		  <div class="column" id = "thumb-<?php echo md5($image->filename)?>">
                      		    <img src="{{ $image->thumb_url }}" alt="{{$image->filename}}" style="width:100%;height:100%" onclick="openModal('{{$project->name}}');currentSlide(<?php echo $imageCount ?> , '<?php echo $project->name?>')" class="hover-shadow cursor">
                      		  </div>

                          @endforeach

                          </div>
                          <br>
                      <form method="POST" action="{{ route('project-change') }}">
                          @csrf
                          {{ Form::hidden('projectID', $project->id) }}
                          {{ Form::hidden('catID', $project->cat_id) }}

                          @if ($user->rolle === 0 || $user->rolle === 9)
                         <button type="submit" class="btn btn-primary" value = "delete" name="submit">
                             {{ __('Löschen') }}
                         </button>
                         <button type="submit" class="btn btn-primary" value = "change" name="submit">
                             {{ __('Ändern') }}
                         </button>
                         @endif
                       </form>

                      <div id="myModal-{{$project->name}}" class="modal">
                        <span class="close cursor" onclick="closeModal('{{$project->name}}')">&times;</span>
                        <div class="modal-content">
                          <div class = "wide_wrapper text-center big-slider-image-container" >
                            @foreach($project->images as $image)
                            <div class="mySlides-<?php echo $project->name ?>" data-responsive="true" id = "wide-<?php echo md5($image->filename)?>">
                              <img src="{{ $image->url }}" class="big-slider-image img-responsive" alt="Nature and sunrise">
                            </div>
                            @endforeach

                          </div>
                          <a class="prev" onclick="plusSlides(-1 , '<?php echo $project->name?>')">&#10094;</a>
                          <a class="next" onclick="plusSlides(1 , '<?php echo $project->name?>')">&#10095;</a>

                          <div style = "height : 30px;background : black">
                          </div>

                          <div class = "clearfix">
                          	<?php $imageCount = 0;?>
                      	    @foreach($project->images as $image)
                      	    <?php $imageCount ++; ?>
                      	    <div class="column clearfix" id = "slide-<?php echo md5($image->filename)?>">
                              <div class = "clearfix text-center" style = "background : grey">
                                <span class="glyphicon glyphicon-trash" onclick="del('{{$image->filename}}' , '<?php echo md5($image->filename)?>')"></span>
                              </div>
                              <div class = "image-wrapper">
                        	      <img id = "slideimg-<?php echo md5($image->filename)?>" class="demo-<?php echo $project->name ?> cursor" src="{{ $image->thumb_url }}" style="width:100%" onclick="currentSlide(<?php echo $imageCount ?> , '<?php echo $project->name?>')" alt="Nature and sunrise">
                              </div>
                      	    </div>
                      	    @endforeach

                      	</div>

                        </div>
                        <div style = "height : 80px"></div>
                      </div>
                      <div style="height: 50px;"></div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
    </div>

<!-- Youtube Modal -->
<div class="modal fade" id="myYoutube" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      
        <iframe id="iframeYoutube" width="100%" height="300px" src="" frameborder="0" allowfullscreen></iframe> 
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

  $(document).ready(function(){
    // Youtube popup
    $(document).on("click",".youtube-btn",function(){
      var link = $(this).attr('link');
      showYoutube(link);
    });
    $("#myYoutube").on("hidden.bs.modal",function(){
      $("#iframeYoutube").attr("src","#");
    });

    function showYoutube(src){
      src = src.replace('watch?v=','embed/');
      $("#iframeYoutube").attr("src",src);
      $("#myYoutube").modal("show");
      $('.modal-backdrop').css('position', 'relative');
    }  
  });


function openModal(projectName) {
  document.getElementById('myModal-' + projectName).style.display = "block";
}

function del(imageName , md5){
  var token = $('input[name="ajax_token"]').val();
  $.ajax({
      url: '/show-delete',
      type: 'POST',

      data: {
          fileName : imageName,
          _token : token
      },
      success: function(response)
      {
        $('#thumb-'+md5).remove();
        // $('#wide-'+md5).remove();
        $('#slide-'+md5).remove();
      }
  });
}

function closeModal(projectName) {
  document.getElementById('myModal-' + projectName).style.display = "none";
}
var slideIndex = {};
<?php foreach($projects as $project){ ?>
	slideIndex['<?php echo $project->name ?>'] = 1;
	showSlides(slideIndex['<?php echo $project->name ?>'] , '<?php echo $project->name ?>');
<?php }?>


function plusSlides(n , projectName) {
  showSlides(slideIndex[projectName] += n , projectName);
}

function currentSlide(n , projectName) {
  showSlides(slideIndex[projectName] = n , projectName);
}

function showSlides(n , projectName) {
  var i;
  var slides = document.getElementsByClassName("mySlides-" + projectName);
  var dots = document.getElementsByClassName("demo-" + projectName);

  if (n > slides.length) {slideIndex[projectName] = 1}
  if (n < 1) {slideIndex[projectName] = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex[projectName]-1].style.display = "block";
  dots[slideIndex[projectName]-1].className += " active";

}


</script>

@endsection

@section('additional-styles')
<style>
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}
.wide_wrapper{
 width : 1200px;
 /*max-height : 400px;
/* min-height : 400px;*/
  overflow : hidden;
}
.image-wrapper{
  border : solid 5px white;
  overflow : hidden;
}
.glyphicon{
  padding : 10px;
  color : #474747;
  font-size : 16px;
  cursor : pointer;
}
.glyphicon:hover{
  color : #c9c9c9;
}
.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 20%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
  data-responsive: true;
}

.cursor {
  cursor: pointer
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 30%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

@media only screen and (min-width: 900px) {

  .big-slider-image-container{
    max-width : 500px; 
    margin: 0 auto;
  }
  .big-slider-image{
    width: auto; 
    max-height: 600px;
  }
}
@media only screen and (max-width: 899px) {

  .big-slider-image-container{
    width : 100%; 
    height : 100%; 
    margin: 0 auto
  }
/*  .big-slider-image{
    max-width: 100%; 
    height: 100%;
  }*/
}
</style>
@endsection
