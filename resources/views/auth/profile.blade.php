@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
                <div class="card-title">{{$user->name}}</div>
            </div>
        </div>
    </div>    
</div>
    
@endsection