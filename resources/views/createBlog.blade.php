@extends('template.main')

@section('content')
    <div class="card-body">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{ $error }} </div>
            @endforeach
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-3">
            <div class="container border bg-primary-subtle mt-3">
                <form class="m-3" action="{{ route('blog.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" id="title" name="title" placeholder="My First Blog">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" aria-label="Blog Categories" id="category" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" aria-label="Blog Statuses" id="status" name="status">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <div>
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}">
                                    <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="10" placeholder="Write here..."></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary" type="submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-9">
            <div class="container border bg-light mt-3">
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ str($blog->title)->limit(30) }}</td>
                                <td>{{ str($blog->author->name)->limit(30) }}</td>
                                <td>{{ $blog->category->name }}</td>
                                <td>
                                    @foreach ($blog->tags as $tag)
                                    <span>{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ str($blog->description)->limit(30) }}</td>
                                <td>{{ $blog->status->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection
