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
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $user->vorname }}, Sie sind eingeloggt!

                    @if ($user->first === 0)

                     <script type="text/javascript">
    					window.location = "user-change";//here double curly bracket
					</script>
                    @else
                      <div class="links">
                        @if ($user->rolle === 0)
                          <a href="{{ route('project-insert') }}">{{ __('Projekt anlegen') }}</a><br>
                          <a href="{{ route('project-show')}}">{{ __('Projekt(e) anschauen') }}</a>
                        @elseif ($user->rolle === 1)
                          <a href="{{ route('project-bewerten') }}">{{ __('Projekt bewerten') }}</a>
                        @else ($user->rolle === 9)
                        <a href="{{ route('project-freigeben') }}">{{ __('Projekt project-freigeben') }}</a>
                        @endif
                      </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
