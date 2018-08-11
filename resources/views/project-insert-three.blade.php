@extends('layouts.app')

@section('content')

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
