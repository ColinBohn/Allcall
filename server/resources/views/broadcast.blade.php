@extends('layouts.app')

@section('content')
        <div class="container">
            <form method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Nodes</div>
                        <ul class="list-group">
        @foreach ($nodes as $node)
                            <li class="list-group-item" data-node="{{ $node->id }}">
                            <input type="checkbox" name="nodes[]" data-toggle="toggle" data-size="small" value="{{ $node->id }}" disabled>
                                {{ $node->name }}
                                <div class="pull-right">
                                    <span class="label label-default">
                                        Checking <span class="glyphicon glyphicon-repeat glyphicon-rotate"> </span>
                                    </span>
                                </div>
                            </li>
        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
        @foreach ($alerts as $alert)
                        <button type="submit" formaction="/start/{{ $alert->id }}" class="btn btn-primary btn-block">{{ $alert->name }}</button>
        @endforeach
                        <button type="submit" formaction="/stop" class="btn btn-success btn-block btn-lg">Stop Playback</button>
                </div>
            </div>
            </form>
        </div>
@endsection

@section('scripts')
<script src="js/broadcast.js"></script>
@endsection