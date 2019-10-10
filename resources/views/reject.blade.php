@extends('layouts.app')

@section('content')

<div class="container">
  <a href="/verifyresults"><button class="btn btn-primary">Back</button>
  </a>
</div>
<br>
<div class="container">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{$user->name}}</div>

					<div class="card-body">
						<div class=content>
							<label>Name:</label>
							<p>{{
								$user->name
							}}</p>

							<label>Admission Number:</label>
							<p>{{
								$user->admission_number
							}}</p>
							<label>Roll Number:</label>
							<p>{{
								$user->roll_number
							}}</p>
							<form method="GET" action="/verifyresults/{{$user->id}}"
							> @csrf
							<!-- @method('patch') -->
							<a ><button class="btn btn-primary" 
 								type="submit"
 								name="is_rejected"  
 								onclick="this.form.submit()"
 								>Reject</button></a></form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





@endsection