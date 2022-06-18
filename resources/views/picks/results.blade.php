@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
    	<div class="col-md-12 mt-4">
      		<div class="card">
          		<div class="card-header text-gray">
            		<div class="align-items-center">
              			<h2><i class="fa fa-user" aria-hidden="true"></i> {{ $picks[0]->race->name }}</h2></div>
						  <div class=" align-items-right">
						<h2> {{ \Auth::user()->name }}</h2>
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
  	</div>
</div>
@endsection


