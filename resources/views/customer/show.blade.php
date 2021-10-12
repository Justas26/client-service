@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Member information</div>
                <div class="card-body">
                    <table class="table-responsive-xl" >
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Edit/Delete/Upload</th>       
                        </tr>
                        @foreach ($customer as $customer)
                        <tr>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->surname}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{!!$customer->comment!!}</td>
                             <td>   
                            <form action="{{route('customer.uploadPhoto',$customer)}}" method="post" enctype="multipart/form-data">
                            <input type="file" name="photo" id="">
                             @csrf
                            <button class="btn btn-success" type="submit">upload photo</button>
                            </form>
                            <a class="btn btn-primary" href="{{route('customer.edit',$customer)}}">edit</a>
                                <form method="POST" action="{{route('customer.destroy', $customer)}}">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">delete</button>
                    
                            </td>
                            <br>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection