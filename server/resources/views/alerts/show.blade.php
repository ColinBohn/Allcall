@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alert Details</h1>
    <div class="jumbotron">
        <h2>{{ $alert->name }}</h2>
        <p>
            <strong>Short Name:</strong> {{ $alert->shortname }}<br>
            <strong>ID:</strong> {{ $alert->id }}<br>
            <strong>Loop Delay:</strong> {{ $alert->loop_delay }} seconds<br>
            <strong>Description:</strong> {{ $alert->description }}
        </p>
    </div>
</div>
@endsection