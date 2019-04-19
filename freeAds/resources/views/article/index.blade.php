@extends('layouts.app')

@section('content')

<div class="container">
        <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">tilte</th>
                    <th scope="col">content</th>
                    <th scope="col">picture</th>
                    <th scope="col">price</th>
                    <th scope="col">category</th>
                    <th scope="col">user</th>
                    <th scope="col">edit</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                    <td>{{ $article->title }} <a href="/article/{{$article->id}}"><button type="button" class="btn btn-warning">show</button></a> 
                        </td>
                        <td>{{ $article->content }}</td>
                        <td> <img src="{{ $article->picture }}" alt=""> </td>
                        <td>{{ $article->price }}</td>
                        <td>{{ $article->category->genre }}</td>
                        <td>{{ $article->user->firstname . " " . $article->user->lastname }}</td>
                        @if ($article->user->id == Auth::id())
                    <td><a href="/article/{{ $article->id }}/edit"><button type="button" class="btn btn-success">edit</button></a>
                        <form action="{{ route('article.destroy', $article)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                              </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                    {{ $articles->links() }}
                </tbody>
              </table>
</div>


@endsection