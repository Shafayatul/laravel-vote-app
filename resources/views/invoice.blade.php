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
					        <th>Payment</th>
					        <th>Download Invoice</th>
					      </tr>
					    </thead>
					    <tbody>
					    	@foreach($invoices as $invoice)
						      <tr>
						      	<td>{{ $invoice->id}}</td>
						        <td>{{ $users_name[$invoice->user_id] }}</td>
						        <td>{{ $users_email[$invoice->user_id] }}</td>
						        <td>
						        	@if($invoice->is_paid == 0)
						        		Not Paid
						        	@else
						        		Paid
						        	@endif
						        </td>
						        <td> 
						        	<a href="{{ url('/downlaod/pdf/'.$invoice->user_id) }}" download="download"> <button class="btn btn-primary"> Downlaod</button></a> 
						        	@if($invoice->is_paid == 0)
						        		<button class="btn btn-primary action-paid" id="{{$invoice->id}}"> Accept Payment</button>
						        	@endif

						        </td>
						      </tr>
						    @endforeach
					    </tbody>
					  </table>

					  <div class="row">
					  	<div class="col-sm-12" >
					  		{{ $invoices->links() }}
					  	</div>
					  </div>

	              </div>
                </div>
              </div>
            </div>
</div>
<input type = "hidden" name = "ajax_token" value = "{{csrf_token()}}">
<script src="http://code.jquery.com/jquery-1.5.js"></script>

<script type="text/javascript">

$(document).ready(function(){
	$('.action-paid').click(function(){
		var token = $('input[name="ajax_token"]').val();
		$.ajax({
			url: '/invoice-paid',
			type: 'POST',
			data: {
			  id : $(this).attr('id'),
			  _token : token
			},
			success: function(response){
				console.log(response);
				// alert("Project has been successfully accepted.");
				location.reload();
			}
		});
    });
});
</script>
@endsection
