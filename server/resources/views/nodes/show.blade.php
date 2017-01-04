@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Node Details</h1>
    <div class="jumbotron">
        <h2>{{ $node->name }}</h2>
        <p>
            <strong>Status:</strong> {{ $node->online() ? "Online - " . $node->status() : "Offline" }}<br>
            <strong>ID:</strong> {{ $node->id }}<br>
            <strong>URL:</strong> {{ $node->url }}<br>
            <strong>Secret Key</strong> {{ $node->key }}
        </p>
    </div>
</div>
@endsection