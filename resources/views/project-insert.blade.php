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
                <div class="card-header">Schritt 1: Kategorie auswählen</div>

                <div class="card-body">

                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                    </div>
                  @endif

                  <form method="POST" action="{{ route('project-insert') }}">
                      @csrf

                        <label for="Cat"></label>
                            <select class="form-control" name="cat_id" id="cat_id" data-parsley-required="true" onchange='this.form.submit()'>
                                @foreach ($cats as $sn)
                                  {
                                      <option value="{{ $sn->id }}">{{ $sn->name }}</option>
                                      }
                                @endforeach
                            </select>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>


 <script src="{{ asset('js/custom.js') }}"></script>
@endsection
