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
              <div class="card-header">Invoice Download</div>

	              <div class="card-body">

					  <table class="table table-bordered">
					    <thead>
					      <tr>
					        <th>#</th>
					        <th>Name</th>
					        <th>Email</th>
					        <th>Download Invoice</th>
					      </tr>
					    </thead>
					    <tbody>
					    	@foreach($users as $single_user)
						      <tr>
						      	<td>{{$single_user->id}}</td>
						        <td>{{$single_user->vorname}} {{$single_user->name}}</td>
						        <td>{{$single_user->email}}</td>
						        <td> <a href="{{ url('/downlaod/pdf/'.$single_user->id) }}" download="download"> <button class="btn btn-primary"> Downlaod</button></a> </td>
						      </tr>
						    @endforeach
					    </tbody>
					  </table>

					  <div class="row">
					  	<div class="col-sm-12" >
					  		{{ $users->links() }}
					  	</div>
					  </div>

	              </div>
                </div>
              </div>
            </div>
</div>

<script src="http://code.jquery.com/jquery-1.5.js"></script>


@endsection
