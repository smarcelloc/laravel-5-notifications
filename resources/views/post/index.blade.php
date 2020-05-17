@extends('layouts.app')

@section('content')
<div class="container">
    <header class="mb-5 border-bottom">
        <h1 class="font-weight-bold d-inline">Postagens</h1>
        <a href="{{route('post.create')}}" class="btn btn-success btn-sm mb-2 ml-2">Adicionar</a>
    </header>
    @forelse ($posts as $post)
        <div class="mb-5 rounded bg-white p-3 shadow">
            <div>
                <h3 class="font-weight-bold">{{$post->title}}</h3>
                <a href="{{route('post.show', ['post' => $post])}}" class="btn btn-link">Ver</a> 
                @can('post-auth', $post)
                <a href="{{route('post.edit', ['post' => $post])}}" class="btn btn-link text-secondary">Editar</a> 
                <form action="{{route('post.destroy', ['post' => $post])}}" method="post" style="display: inline;">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Excluir" class="btn btn-link text-danger">
                </form>
                @endcan
                
            </div>
            
            <p>{{Str::limit($post->body,300)}}</p>
            <small class="text-muted"><strong>Actor:</strong> {{$post->user->name}}</small><br>
            <small class="text-muted"><strong>Posted:</strong> {{$post->created_at}}</small><br>
            <small class="badge-pill badge-secondary badge"><strong>Commented:</strong> {{$post->comments->count() ?: 'None'}}</small>
        </div>
    @empty
        <p>Nenhuma postagem encontrada</p>
    @endforelse
    
    @if($posts)
        {{$posts->links()}}
    @endif
</div>
@endsection
