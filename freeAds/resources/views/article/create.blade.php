@extends('layouts.app')

@section('content')
<div class="container">
        <form method="POST" action="{{ route("article.store") }}">
                @csrf
            
                <div class="form-group">
                  <label for="exampleInputEmail1">title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">content</label>
                  <input type="text" class="form-control" id="content" placeholder="entre content" name="content">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">picture</label>
                    <input type="text" class="form-control" id="picture" placeholder="url of your picture" name="picture">
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">price</label>
                    <input type="number" class="form-control" id="price" placeholder="enter your price" min="1" name="price">
                  </div>
                
                  <div class="form-group">
                      Category
                    <select class="form-control" id="category-select" required name="category">
                        <option value=""></option>
                        @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->genre }}</option>
            
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