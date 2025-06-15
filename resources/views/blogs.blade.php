@extends('template.main')

@section('content')
    <div class="card-body">
        @if(session('delete'))
            <div class="alert alert-success">
                {{ session('delete') }}
            </div>
        @elseif(session('restore'))
            <div class="alert alert-success">
                {{ session('restore') }}
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row">
            @foreach ($blogs as $blog)
            <div class="card m-1" style="width: 18rem;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ str($blog->title)->limit(50) }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $blog->category->name }}</h6>
                    <p class="card-text">{{ str($blog->description)->limit(50) }}</p>
                    <div class="mt-auto">
                        @if ($blog->status->name == 'Published')
                            <a href="/blogs/{{ $blog->id }}" class="card-link">Go to blog</a>
                            <a href="#" class="card-link">Edit blog (temp)</a>
                        @elseif ($blog->status->name == 'Deleted')
                            <span class="text-danger">Deleted</span>
                            <form action="{{ route('blogs.restore', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to restore this blog?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">(restore)</button>
                            </form>
                        @else
                            <span>{{ $blog->status->name }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection