@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
    	<div class="col-md-12 mt-4">
      		<div class="card">
          		<div class="card-header text-gray">
            		<div class="d-flex align-items-center">
              			<h2><i class="fa fa-user" aria-hidden="true"></i> <h2>{{ $race->name }} Results</h2></h2>
            		</div>
        		</div>
          		<div class="card-body text-secondary">
					<table class="table table-striped table-font">
						<thead>
							<tr>
							<th class="text-center" scope="col">Position</th>
							<th scope="col">Driver</th>
							<th scope="col">Constructor</th>
							<th scope="col">Points &nbsp;(* Fastest Lap)</th>
							</tr>
						</thead>
						<tbody>
							@foreach($results as $result)
								<tr >
									<td class="align-middle text-center">
										{{ $result->position }}</td>
									<td class="align-middle">
										{{ $result->driver->name }}
										
									</td>
									<td class="align-middle">
										{{ $result->driver->constructor->name }}
										
									</td>
									<td class="align-middle">
										{{ calcPoints($result->position) + 
										fastestLap($result->race->id, $result->driver->id) }}
										{{ fastestLapInd($result->race->id, $result->driver->id) }}
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


