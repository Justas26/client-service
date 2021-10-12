@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('company.update',$company)}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name',$company->name)}}">
                            <small class="form-text text-muted">Customer name.</small>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{old('address',$company->address)}}">
                            <small class="form-text text-muted">Customer surname.</small>
                        </div>
                        @csrf
                        <button class="btn btn-primary" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection