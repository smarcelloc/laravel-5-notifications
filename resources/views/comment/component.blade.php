<div class="container mt-5">
    <header class="mb-3 border-bottom">
        <h3 class="font-weight-bold d-inline">Recent Comments</h3>
        <a href="{{route('comment.create', ['post_id' => $post->id])}}" class="btn btn-success btn-sm mb-2 ml-2">Adicionar</a>
    </header>
    @forelse ($post->comments->sortByDesc('id') as $comment)
        <div class="mb-3 rounded bg-white p-3 border">
            <div>
                <h5 class="font-weight-bold">{{$comment->title}}</h5>
                @can('comment-auth', $comment)
                <a href="{{route('comment.edit', ['comment' => $comment])}}" class="btn btn-link text-secondary">Editar</a> 
                <form action="{{route('comment.destroy', ['comment' => $comment])}}" method="post" style="display: inline;">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Excluir" class="btn btn-link text-danger">
                </form>
                @endcan
                
            </div>
            
            <p class="text-muted text-justify">{{$comment->body}}</p>
            <hr>
            <small class="text-muted">By {{$comment->user->name}}</small><br>
            <small class="text-muted">Commented in {{$comment->created_at}}</small><br>
        </div>
    @empty
        <p>No comment</p>
    @endforelse
</div>