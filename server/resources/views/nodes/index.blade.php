@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Nodes</h1>
    
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>URL</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
        @foreach($nodes as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->url }}</td>
    
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <a class="btn btn-xs btn-success" href="{{ URL::to('nodes/' . $value->id) }}">Show</a>
                    <a class="btn btn-xs btn-info" href="{{ URL::to('nodes/' . $value->id . '/edit') }}">Edit</a>
                    <form method="POST" action="/nodes/{{ $value->id }}" style="display:inline;">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input class="btn btn-xs btn-danger" type="submit" value="Delete">
                    </form>


                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn btn-primary" href="{{ URL::to('nodes/create') }}">Create Node</a>
</div>
@endsection