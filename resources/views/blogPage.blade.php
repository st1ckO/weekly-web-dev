@extends('template.main')

@section('content')
    <div class="container border bg-primary-subtle mt-3">
        <h1 class="mt-4">{{ $blog->title }}</h1>
        <p class="lead">{{ $blog->description }}</p>
        
        <div class="d-flex justify-content-end pb-3">
            <form action="{{ route('blogs.softDelete', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="container mt-4">
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('blogs.comment', $blog->id) }}" method="POST">
                @csrf 
                <h5 class="card-title mb-3">Add a Comment</h5>
                <div class="mb-3">
                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Write your comment here..." required></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-2">
        <h5 class="mb-1">Comments ({{ $blog->comments->count() }})</h5>

        @forelse($blog->comments->sortByDesc('created_at') as $comment)
            <div class="mb-1">
                <div class="bg-light p-3 rounded">
                    <div class="mb-1">
                        <strong>{{ $comment->author->name ?? 'Anonymous' }}</strong>
                        <small class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <div>{{ $comment->comment }}</div>

                    @php
                        $userId = 1;
                        $hasLiked = $comment->isLikedByUserId($userId);
                    @endphp

                    <form action="{{ route('blogs.likeComment', $comment->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ $hasLiked ? 'btn-danger' : 'btn-outline-danger' }}">
                            ❤️ {{ $hasLiked ? 'Unlike' : 'Like' }} ({{ $comment->likes()->count() }})
                        </button>
                    </form>

                </div>
            </div>
        @empty
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        @endforelse
    </div>

</div>

@endsection