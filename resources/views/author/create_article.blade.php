@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="jumbotron text-center">
                <h1 class="display-4 m-0">Write Article</h1>
            </div>
        </div>
        <div class="col-lg-7">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="post" action="{{route('store.article')}}">
                @csrf
                <div class="form-group">
                  <label for="article_title">Article title</label>
                  <input type="text" class="form-control" id="article_title" name="article_title" placeholder="Enter title">
                </div>
                <div class="form-group">
                  <label for="article_content">Article Content</label>
                  <textarea name="article_content" id="article_content" cols="76" rows="6"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
