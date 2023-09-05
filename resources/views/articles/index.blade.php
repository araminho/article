@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Articles list</h1>
    <div class="row">
        <a href="{{route('articles.create')}}">
            <button class='btn btn-large btn-success'>Add new</button>
        </a>
    </div>

    @auth
    <div class="row">
        <form>
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control" name="search" id="search" placeholder="search" value="{{$search}}">
                <input type="submit" class="btn btn-primary" value="Search"/>
            </div>
        </form>
    </div>
    @endauth

    @foreach($articles as $article)
        <div class='row'>
            <a href="{{route('articles.edit', $article->id)}}">
                {{$article->title}}
            </a>

        </div>
    @endforeach

</div>
@endsection
