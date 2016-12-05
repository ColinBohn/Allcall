@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Current Nodes Status</div>
                <ul class="list-group">
                @foreach ($nodes as $node)
                    <li class="list-group-item">
                        <span class="pull-right label {{ $node->online() ? "label-success" : "label-danger" }}">
                            {{ $node->online() ? "Online" : "Offline" }}
                        </span>
                        {{ $node->name }}
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
