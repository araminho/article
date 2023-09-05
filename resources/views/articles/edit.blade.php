@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <h1>Edit an article</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method='POST' action={{route('articles.update', $article->id)}}>
            {{ method_field('PUT') }}
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$article->title}}">
              </div>
              <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control">{{$article->content}}</textarea>
              </div>
              <div class="form-group">
                <a href="{{route('articles.index')}}">
                    <button type="button" class="btn btn-secondary">Back</button>
                </a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
        </form>
    </div>

</div>
@endsection
