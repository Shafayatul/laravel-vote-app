@extends('layouts.app')

@section('content')
@if(session()->has('alert-success'))
    <div class="alert alert-success">
        {{ session()->get('alert-success') }}
    </div>
@endif
<div class="container-fluid">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Projekt: "{{ $project->name }}" ändern</div>

              <div class="card-body">
                    <form method="POST" action="{{ route('change-project') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cat_name" class="col-md-4 col-form-label text-md-right">{{ __('Kategorie*') }}</label>

                            <div class="col-md-6">
                                <input id="cat_name" type="text" value="{{ $project->cat_name }}" class="form-control{{ $errors->has('cat_name') ? ' is-invalid' : '' }}" name="cat_name" value="{{ old('cat_name') }}" required readonly>

                                @if ($errors->has('cat_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cat_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name*') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="{{ $project->name }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{ Form::hidden('project_id', $project->id) }}
                        {{ Form::hidden('cat_id', $project->cat_id)}}

                        <div class="form-group row">
                            <label for="projektname" class="col-md-4 col-form-label text-md-right">{{ __('Projektnamen*') }}</label>

                            <div class="col-md-6">
                                <input id="projektname" type="text" value="{{ $project->projektname }}" class="form-control{{ $errors->has('projektname') ? ' is-invalid' : '' }}" name="projektname" value="{{ old('projektname') }}" readonly >

                                @if ($errors->has('projektname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('projektname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="beschreibung" class="col-md-4 col-form-label text-md-right">{{ __('Beschreibung*') }}</label>

                            <div class="col-md-6">

                                <textarea id="beschreibung" rows="10" class="form-control{{ $errors->has('beschreibung') ? ' is-invalid' : '' }}" name="beschreibung" value="{{ old('beschreibung') }}" required>{{ $project->beschreibung }}</textarea>
                                Erlaubte Wörter: {{ $cats->words }} - Wörter total : <span id="display_count_beschreibung">0</span> Wörter!
                                @if ($errors->has('$project->beschreibung'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('$project->beschreibung') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="extra" class="col-md-4 col-form-label text-md-right">{{ __('Ort und Datum der Hochzeit*') }}</label>

                            <div class="col-md-6">
                                <input id="extra" type="text" value="{{ $project->extra }}" class="form-control{{ $errors->has('extra') ? ' is-invalid' : '' }}" name="extra" value="{{ old('extra') }}" required>

                                @if ($errors->has('extra'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('extra') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="copyright" class="col-md-4 col-form-label text-md-right">{{ __('Copyright*') }}</label>

                            <div class="col-md-6">
                                <input id="copyright" type="text" value="{{ $project->copyright }}" class="form-control{{ $errors->has('copyright') ? ' is-invalid' : '' }}" name="copyright" value="{{ old('copyright') }}" required>

                                @if ($errors->has('copyright'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('copyright') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="check" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>

                            <div class="col-md-6">
                                <input type="checkbox" checked="checked" name="check" id="check" value="{{old('check')}}" required><label for="check"><span></span><p>Ich habe das Recht die Fotos zu verwenden!</p></label>
                                @if ($errors->has('check'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('check') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ url()->previous() }}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Projekt ändern') }}
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
</div>

<script src="http://code.jquery.com/jquery-1.5.js"></script>
    <script>
        var max = {{ $cats->words }};
        $(document).ready(function() {
          $("#beschreibung").on('keyup', function() {
      var words = this.value.match(/\S+/g).length;

      if (words > max) {
        // Split the string on first 200 words and rejoin on spaces
        var trimmed = $(this).val().split(/\s+/, max).join(" ");
        // Add a space at the end to make sure more typing creates new words
        $(this).val(trimmed + " ");
      }
      else {
        $('#display_count_beschreibung').text(words);
        $('#word_left').text(max-words);
      }
    });
  });
    </script>

    <script src="http://code.jquery.com/jquery-1.5.js"></script>
        <script>
            var max = {{ $cats->words }};
            $(document).ready(function() {
              $("#testimonial").on('keyup', function() {
          var words = this.value.match(/\S+/g).length;

          if (words > max) {
            // Split the string on first 200 words and rejoin on spaces
            var trimmed = $(this).val().split(/\s+/, max).join(" ");
            // Add a space at the end to make sure more typing creates new words
            $(this).val(trimmed + " ");
          }
          else {
            $('#display_count_referenz').text(words);
            $('#word_left').text(max-words);
          }
        });
      });
        </script>

 <script src="{{ asset('js/custom.js') }}"></script>

@endsection
