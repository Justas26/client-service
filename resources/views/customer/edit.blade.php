@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('customer.update',$customer)}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name',$customer->name)}}">
                            <small class="form-text text-muted">Customer name.</small>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="{{old('surname',$customer->surname)}}">
                            <small class="form-text text-muted">Customer surname.</small>
                        </div>
                        <div class="form-group">
                            <label>Live</label>
                            <input type="text" name="phone" class="form-control" value="{{old('phone',$customer->phone)}}">
                            <small class="form-text text-muted">Customer phone.</small>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="{{old('email',$customer->email)}}">
                            <small class="form-text text-muted">Customer email.</small>
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea type="text" name="comment" class="form-control" id="summernote"> {{old('comment',$customer->comment)}} </textarea>
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