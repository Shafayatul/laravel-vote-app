<form method="POST" action="{{ route('add-project') }}">
    @csrf

    <div class="form-group row">
        <label for="cat_name" class="col-md-4 col-form-label text-md-right">{{ __('Kategorie') }}</label>

        <div class="col-md-6">
            <input id="cat_name" type="text" value="{{ $cats->name }}" class="form-control{{ $errors->has('cat_name') ? ' is-invalid' : '' }}" name="cat_name" value="{{ old('cat_name') }}" required readonly>

            @if ($errors->has('cat_name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('cat_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{ Form::hidden('cat_id', $cats->id) }}
    {{ Form::hidden('group', $cats->group) }}

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Projektname*') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="extra" class="col-md-4 col-form-label text-md-right">{{ __('Datum und Ort der Hochzeit*') }}</label>

        <div class="col-md-6">
            <input id="extra" type="text" class="form-control{{ $errors->has('extra') ? ' is-invalid' : '' }}" name="extra" value="{{ old('extra') }}" required>

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
            <input id="copyright" type="text" class="form-control{{ $errors->has('copyright') ? ' is-invalid' : '' }}" name="copyright" value="{{ old('copyright') }}" required>

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
                {{ __('Projekt anlegen') }}
            </button>
        </div>
    </div>
</form>

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
        $('#display_count').text(words);
        $('#word_left').text(max-words);
      }
    });
  });
    </script>
