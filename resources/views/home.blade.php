@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron text-center">
                <h1 class="display-4 mb-5">Author Dashboard</h1>
                <a href="{{route('write.article')}}" class="btn btn-info">Write Article</a>
                <a href="{{route('view.all.article')}}" class="btn btn-warning">Paid History</a>
            </div>
        </div>
    </div>
</div>
@endsection
