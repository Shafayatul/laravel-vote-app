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
                <div class="card-header">Top Five In Each Group...</div>
                  <div class="card-body">
                    <section class="projects">
                      @foreach($cats as $key => $value)
                        <h1>Category: {{$value}}</h1> 
                        <hr>
                        <ol>
                          {{-- // project_id => number of vote --}}
                          @foreach($point[$value] as $single_key => $single_val)
                            <li><a href="{{ url('/project/single/admin/'.$single_key) }}" target="_blank">{{$projects[$single_key]}}({{$single_val}})</a></li>
                          @endforeach
                        </ol>
                        <br>
                        <br>
                        <br>
                      @endforeach
                    </section>
                  </div>
              </div>
          </div>
      </div>
    </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Reason of rejection</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form">
                    <i class="fa fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="form8" class="md-textarea form-control email-body" rows="4"></textarea>
                    {{-- <label data-error="wrong" data-success="right" for="form8">Your message</label> --}}
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-deep-orange" id="model-send-email">Send Email & Reject Project</button>
                <button class="btn btn-deep-orange" id="model-cancel">Cancel</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">


$(document).ready(function() {

    $(window).scroll(fetchtickets);

    function fetchtickets() {

        var page = $('.endless-pagination').data('next-page');
        var doWork = $('#do_work').val();

        if((page !== null) && (doWork=='1')) {

            clearTimeout( $.data( this, "scrollCheck" ) );

            $.data( this, "scrollCheck", setTimeout(function() {
                var scroll_position_for_tickets_load = $(window).height() + $(window).scrollTop() + 300;
                $('.ajax-load').show();

                if(scroll_position_for_tickets_load >= $(document).height()) {
                    $.get(page, function(data){
                      $('.ajax-load').hide();
                        $('.projects').append(data.projects);
                        $('.endless-pagination').data('next-page', data.next_page);
                    });
                }
            }, 1000))

        }else{
          $('.ajax-load').show();
          $('.ajax-load').html('<h2>No more post left</h2>');
        }
    }
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
    var token = $('input[name="ajax_token"]').val();
    $('.action-accept').click(function(){
      $.ajax({
          url: '/project-accept-admin',
          type: 'POST',

          data: {
              id : $(this).attr('id'),
              _token : token
          },
          success: function(response){
            // alert("Project has been successfully accepted.");
            location.reload();
          }
      });
    });

    $('.action-delete').click(function(){
      $.ajax({
          url: '/project-delete-admin',
          type: 'POST',

          data: {
              id : $(this).attr('id'),
              _token : token
          },
          success: function(response){
            // alert("Project has been successfully accepted.");
            location.reload();
          }
      });
    });

    $('.action-jury').click(function(){

      $.ajax({
          url: '/project-jury-admin',
          type: 'POST',

          data: {
              id : $(this).attr('id'),
              _token : token
          },
          success: function(response){
            // alert("Project has been successfully accepted.");
            location.reload();
          }
      });
    });


    var rejectionId = 0;
    $('.action-reject').click(function(){
      rejectionId = $(this).attr('id');
      $('#myModal').modal('toggle');
      $('.modal-backdrop').css('position', 'relative');

    });
    $('#model-cancel').click(function(){
      $('#myModal').modal('toggle');
      $('#email-body').val('');
    });

    $('#model-send-email').click(function(){
      $('#myModal').modal('toggle');
      var emailBody = $(".email-body").val();
      $.ajax({
          url: '/project-reject-admin',
          type: 'POST',
          data: {
              id : rejectionId,
              emailBody : emailBody,
              _token : token
          },
          success: function(response){
            // alert("Project has been rejected.");
            location.reload();
          }
      });
    });


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
