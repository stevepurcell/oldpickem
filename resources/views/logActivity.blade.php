@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
      <div class="card">
          <div class="card-header text-gray">
            <div class="d-flex align-items-center">
              <h2><i class="fa fa-scroll" aria-hidden="true"></i> Event Log</h2>
			  <div class="ml-auto">
			  <a href="/logActivity/clearLogs" class="btn btn-lg btn-outline-dark">Clear Logs</a>
            </div>
        </div>
          <div class="card-body text-secondary">
			<table class="table table-bordered">
				<tr>
					<th>No</th>
					<th>Description</th>
					<th>URL</th>
					<th>Method</th>
					<th>Ip</th>
					<th>User Id</th>
				</tr>
				@if($logs->count())
					@foreach($logs as $key => $log)
					<tr>
						<td></td>
						<td>{{ $log->subject }}</td>
						<td class="text-success">{{ $log->url }}</td>
						
						<td align="center"><span class="badge {{ getBadgeColor($log->method) }}">{{ $log->method }}</span></td>
						<td>{{ $log->ip }}</td>
						<td>{{ getUserName($log->user_id) }}<br><small>{{ $log->created_at->isoFormat('M/D/YY @ HH:mm') }}</small></td>
					</tr>
					@endforeach
					{{ $logs->links() }}
				@endif
			</table>
    </div>
  </div>
</div>
  </div>
</div>
@endsection