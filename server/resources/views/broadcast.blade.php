@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nodes</div>
                @foreach ($nodes as $node)
                <div class="panel-body">
                    {{ $node->name }}
                    <span class="pull-right"> 
                        <a href="/node/{{ $node->id }}/test">Test</a> | 
                        <a href="/node/{{ $node->id }}/stop">Stop</a>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
