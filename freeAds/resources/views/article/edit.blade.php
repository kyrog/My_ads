@extends('layouts.app')

@section('content')
<div class="container">
        <form action="{{ route("article.update", $article) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                <label for="exampleInputEmail1">title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ $article->title }}">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">content</label>
                <input type="text" class="form-control" id="content" name="content" placeholder="entre content" value="{{ $article->content }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">picture</label>
                    <input type="text" class="form-control" id="picture" name="picture" placeholder="url of your picture" value="{{ $article->picture }}">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword1">price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="enter your price" min="1" value="{{ $article->price }}">
                </div>
                
                <div class="form-group">
                    <select id="pet-select" name="category" required>
                        <option value="{{ $article->category->id }}">{{ $article->category->genre }}</option>
                        @foreach ($categories as $categorie)
                        @if ($categorie->genre !== $article->category->genre)
                            <option value="{{ $categorie->id }}">{{ $categorie->genre }}</option>
                        @endif
                        @endforeach            
                    </select>
                </div>
            
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
</div>
   

@endsection