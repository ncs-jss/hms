@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Select Roommates</div>

				<div class="card-body">

					{{-- <label class="my-1 mr-2" for="inlineFormCustomSelectPref">select roommates</label>
					<select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="year">
						<option selected>Choose...</option>
						@foreach($users as $user)
						<option value="1">{{$user->name}}</option>
						@endforeach
					</select><br><br><br> --}}
					<form method="POST" action="/searchRoommates">
						@csrf
						<label class="my-1 mr-2" for="inlineFormCustomSelectPref">select roommates</label>
						<select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="user[]" multiple="multiple">

							<option ></option>
							@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->name}}</option>
							@endforeach
						</select>

						<script type="text/javascript">
							$(document).ready(function() {
								$('.custom-select').select2({
									maximumSelectionLength: 2
								});
							});
						</script>
						<br><br>
						<button type="submit" class="btn btn-primary">
							{{ __('Register') }}
						</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
