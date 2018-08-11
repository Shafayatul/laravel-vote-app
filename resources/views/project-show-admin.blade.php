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



                    <section class="projects endless-pagination" data-next-page="{{ $projects->nextPageUrl() }}">
                      @foreach($projects as $project)
                      <br>
                      <form method="POST" action="{{ route('email-senden')}}">
                        @csrf
                        {{ Form::hidden('project_id', $project->id) }}
                        {{ Form::hidden('user_id', $project->user_id )}}

                        <button type="submit" class="btn btn-primary">
                            {{ __('E-Mail senden') }}
                        </button>
                      </form><br>
                          <p style=""><b>Kategorie: {{ $project->cat_name }}
                          <p style=""><b>Projektname:  {{ $project->projektname }} ID: {{ $project->id }}</b></p>
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


                          <form method="POST" action="{{ route('project-freigegeben') }}">
                              @csrf
                                {{ Form::hidden('project_id', $project->id) }}
                                <label for="Cat"></label>
                                    <select class="form-control" name="counts" id="counts" data-parsley-required="true" onchange='this.form.submit()'>
                                      <option value="2">Freigeben</option>
                                      <option value="3">Zurückweisen</option>
                                      <option value="1">Löschen</option>
                                    </select>
                              </form>

                      <div id="myModal-{{$project->name}}" class="modal">
                        <span class="close cursor" onclick="closeModal('{{$project->name}}')">&times;</span>
                        <div class="modal-content">
                          <div class = "wide_wrapper" >
                          	@foreach($project->images as $image)
                            <div class="mySlides-<?php echo $project->name ?>" data-responsive="true" style = "width : 100%;height : 100%;" id = "wide-<?php echo md5($image->filename)?>">
                              <img src="{{ $image->url }}" alt="Nature and sunrise" style="width: 100%; ">
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
                            @if ($user->rolle === 0)
                      	    <div class="column clearfix" id = "slide-<?php echo md5($image->filename)?>">
                              <div class = "clearfix text-center" style = "background : grey">
                                <span class="glyphicon glyphicon-trash" onclick="del('{{$image->filename}}' , '<?php echo md5($image->filename)?>')"></span>
                              </div>
                              <div class = "image-wrapper">
                        	      <img id = "slideimg-<?php echo md5($image->filename)?>" class="demo-<?php echo $project->name ?> cursor" src="{{ $image->thumb_url }}" style="width:100%" onclick="currentSlide(<?php echo $imageCount ?> , '<?php echo $project->name?>')" alt="Nature and sunrise">
                              </div>
                      	    </div>
                            @endif
                      	    @endforeach

                      	</div>

                        </div>
                        <div style = "height : 80px"></div>
                      </div>
                      <div style="height: 50px;"></div>
                      @endforeach
                    </section>
                    <div class="ajax-load text-center" style="display:none">
                        <p><img src="{{asset('images/loading.gif')}}">Loading More post</p>
                    </div>


                  </div>
              </div>
          </div>
      </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">


$(document).ready(function() {


    $(window).scroll(fetchtickets);

    function fetchtickets() {

        var page = $('.endless-pagination').data('next-page');

        if(page !== null) {

            clearTimeout( $.data( this, "scrollCheck" ) );

            $.data( this, "scrollCheck", setTimeout(function() {
                var scroll_position_for_tickets_load = $(window).height() + $(window).scrollTop() + 100;
                $('.ajax-load').show();

                if(scroll_position_for_tickets_load >= $(document).height()) {
                    $.get(page, function(data){
                      $('.ajax-load').hide();
                        $('.projects').append(data.projects);
                        $('.endless-pagination').data('next-page', data.next_page);
                    });
                }
            }, 350))

        }else{
          $('.ajax-load').show();
          $('.ajax-load').html('<h2>No more post left</h2>');
        }
    }
});
</script>

<script>
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
  top: 50%;
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

</style>
@endsection
