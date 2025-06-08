@extends('template.main')

@section('content')
    <h1>PROFILE Q</h1>
    
    <div class="container border" >
        <div class="row">
            <span style="font-size: 2em;"><i class="bi bi-airplane-engines"></i><i class="bi bi-airplane-engines"></i></span>
            <div class="col-sm-12 col-md-6 col-lg-4 border bg-success">Left</div>
            <div class="col-sm-12 col-md-6 col-lg-4 border bg-primary">Middle</div>
            <div class="col-sm-12 col-md-6 col-lg-4 border bg-danger">Right</div>
        </div>
        <button type="button" class="btn btn-secondary">Secondary</button>
    </div>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">@</span>
        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
    </div>
@endsection