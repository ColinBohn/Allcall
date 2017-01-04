@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create an alert</h1>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/alerts') }}">
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

        <div class="form-group{{ $errors->has('shortname') ? ' has-error' : '' }}">
            <label for="shortname" class="col-md-4 control-label">Short Name</label>
    
            <div class="col-md-4">
                <input id="shortname" type="text" class="form-control" name="shortname" value="{{ old('shortname') }}" required>
    
                @if ($errors->has('shortname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('shortname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    
        <div class="form-group{{ $errors->has('loop_delay') ? ' has-error' : '' }}">
            <label for="loop_delay" class="col-md-4 control-label">Loop Delay</label>
    
            <div class="col-md-4">
                <input id="loop_delay" type="number" class="form-control" name="loop_delay" value="{{ old('loop_delay') }}" required>
    
                @if ($errors->has('loop_delay'))
                    <span class="help-block">
                        <strong>{{ $errors->first('loop_delay') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Description</label>
    
            <div class="col-md-4">
                <textarea id="description" type="text" class="form-control" name="description" required>{{ old('description') }}</textarea>
    
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Edit Alert
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
