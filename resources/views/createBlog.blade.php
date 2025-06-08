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
    <div class="container border bg-primary-subtle mt-3">
        <form class="m-3" action="{{ route('blog.create') }}" method="POST">
            @csrf
            <div class="mb-3 row gy-2">
                <div class="col-12 col-md flex-grow-1">
                    <label for="title" class="form-label">Title</label>
                    <input class="form-control" id="title" name="title" placeholder="My First Blog">
                </div>
                <div class="col-12 col-md-auto" style="min-width: 200px;">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" aria-label="Blog Categories" id="category" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-auto" style="min-width: 200px;">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" aria-label="Blog Statuses" id="status" name="status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
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

@endsection
