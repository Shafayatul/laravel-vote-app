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
                <div class="card-header">Schritt 3: Daten eintragen die Kategorie: {{ $cats->name }}</div>
                  <div class="card-body">
                  @include(''.$cats->code)
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
