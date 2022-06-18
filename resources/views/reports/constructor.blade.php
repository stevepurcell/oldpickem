@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
        <div class="card-header text-gray">
                <div class="d-flex align-items-center">
                    <h2><i class="fa fa-cogs"></i>   Constructor Results - {{ getConstructorName($constructor_id) }}</h2>
                    <div class="ml-auto">
                            <a href="/reports" class="btn btn-lg btn-outline-secondary">Back</a>
                        </div>
                </div>
        </div>
          <div class="card-body text-secondary">
      <table class="table table-striped table-font">
        <thead>
          <tr style="background-color: #A9A9A9;">
            <th scope="col">Race Date</th>
            <th scope="col">Race</th>
            <th scope="col">Points</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($results as $result)
          <tr>
            <td class="align-middle">{{ $result['racedate'] }}</a></td>
            <td class="align-middle">{{ $result['name'] }}</a></td>
            <td class="align-middle">{{ $result['points'] }}</a></td>
        </td>
          </tr>
        @endforeach
        <tr style="background-color: #A9A9A9;">
            <td></td>
            <td><strong>Total</strong></td>
            <td><strong>{{ getConstructorPointsTotal($constructor_id) }}</strong></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
  </div>
</div>
@endsection
