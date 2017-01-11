@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table">
        <tr>
            <th>Time</th>
            <th>User</th>
            <th>Action</th>
            <th>Location(s)</th>
        </tr>
@foreach ($logs as $log)
        <tr>
            <td>{{ date("F j, Y, g:i:s a", strtotime($log->created_at)) }}</td>
            <td>{{ $log->username }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->locations }}</td>
        </tr>
@endforeach
    </table>
</div>
@endsection