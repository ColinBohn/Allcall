@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a node</h1>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/nodes') }}">
        {{ csrf_field() }}
    
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>
    
            <div class="col-md-4">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
    
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    
        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <label for="url" class="col-md-4 control-label">URL</label>
    
            <div class="col-md-4">
                <input id="url" type="text" class="form-control" name="url" required>
    
                @if ($errors->has('url'))
                    <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
            <label for="key" class="col-md-4 control-label">Secret Key</label>
    
            <div class="col-md-4">
                <input id="key" type="text" class="form-control" name="key" required>
    
                @if ($errors->has('key'))
                    <span class="help-block">
                        <strong>{{ $errors->first('key') }}</strong>
                    </span>
                @endif
            </div>
        </div>        
    
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Create Node
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
