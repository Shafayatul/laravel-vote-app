                      @foreach($projects as $project)
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
                              <textarea class="form-control" rows="5" id="comment">
Projektname: {{$project->name}}
Projectbeschreibung: {{$project->beschreibung }}
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
