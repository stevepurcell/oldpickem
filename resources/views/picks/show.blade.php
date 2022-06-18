@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
    	<div class="col-md-8 mt-4">
      		<div class="card">
          		<div class="card-header text-gray">
            		<div class="d-flex align-items-center">
              			<h2>{{ getRaceName($picks[0]->race_id) }} Picks</h2>
            		</div>
        		</div>
          		<div class="card-body text-secondary">
					<table class="table table-striped table-font">
						<thead>
						  <tr>
							<th scope="col">Position</th>
							<th scope="col">Driver</th>
							<th scope="col">Finish</th>
							<th scope="col">Points</th>
						  </tr>
						</thead>
						<tbody>
						@foreach ($picks as $pick)
						  <tr>
							<td class="align-middle">{{ $pick->position }}</a></td>
							<td class="align-middle">{{ $pick->driver->name }}</a></td>
							<td class="align-middle">{{  getActualPosition($pick->race_id, $pick->driver_id) }}</td>
							<td class="align-middle">{{ calcPlayerPtsByPos($pick->position,
														getActualPosition($pick->race_id, $pick->driver_id)) }}</a></td>
						</td>
						  </tr>
						@endforeach
						<tr>
							<td></td>
							<td></td>
							<td class="align-right"><strong>Total</strong></td>
							<td><strong>{{ getPlayerPts($pick->race_id, $pick->user_id) }}</strong></td>
						</tr>
						</tbody>
					  </table>
    			</div>
  			</div>
		</div>
		<div class="col-md-4 mt-4">
			<div class="card">
				<div class="card-header text-gray">
				  <div class="d-flex align-items-center">
						<h2>Weekly Results</h2>
				  </div>
			  </div>
				<div class="card-body text-secondary">
				  <table class="table table-striped table-font">
					  <thead>
						<tr>
						  <th scope="col">Player</th>						  
						  <th scope="col">Points</th>
						</tr>
					  </thead>
					  <tbody>
					  @foreach ($standings as $standing)
						<tr>
						  <td class="align-middle">{{ $standing['name'] }}</a></td>
						  <td class="align-middle">{{ $standing['points'] }}</a></td>
					  </td>
						</tr>
					  @endforeach
					  </tbody>
					</table>
			  </div>
			</div>
	  </div>
  	</div>
</div>
@endsection


