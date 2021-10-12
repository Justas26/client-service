@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer create</div>
                <div class="card-body">
                    <form method="POST" action="{{route('customer.store')}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            <small class="form-text text-muted">Customer name.</small>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="{{old('surname')}}">
                            <small class="form-text text-muted">Customer surname.</small>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                            <small class="form-text text-muted">Customer phone.</small>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{old('email')}}">
                            <small class="form-text text-muted">Customer email.</small>
                        </div>
                       <div class="form-group">
                            <label>Comment</label>
                            <textarea type="text" name="comment" class="form-control" id="summernote"> {!!old('comment')!!} </textarea>
                            <small class="form-text text-muted">Customer comment.</small>
                        </diV>
                        <select name="company_id">
                            @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                        @csrf
                        <button class="btn btn-primary" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection