@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Articles list</h1>
        <div class="row">
            <a href="{{ route('articles.create') }}">
                <button class='btn btn-large btn-success'>Add new</button>
            </a>
        </div>

        @auth

            <form class="mt-10">
                <div class="row form-group mt-50">
                    <!--<label for="search">Search</label>-->
                    <div class="col col-sm-4">
                        <input type="text" class="form-control" name="search" id="search" placeholder="search"
                            value="{{ $search }}">
                    </div>
                    <div class="col col-sm-2">
                        <input type="submit" class="btn btn-warning" value="Search" />
                    </div>
                </div>
            </form>
        @endauth

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

        @foreach ($articles as $article)
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                
                @method('DELETE')
                
                <div class='row'>
                    <div class="col col-sm-4">
                        {{ $article->title }}
                    </div>

                    <div class="col col-sm-1">
                        <a class="btn btn-primary" href="{{ route('articles.edit', $article->id) }}">Edit</a>
                    </div>
                    @csrf

                    <div class="col col-sm-1">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>


                </div>

            </form>
        @endforeach

    </div>
@endsection
