@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Companies list</div>
                <div class="card-body">
                    <table class="table" >
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Edit</th>
                            <th>Delete</th>         
                        </tr>
                        @foreach ($companies as $company)
                        <tr>
                            <td>{{$company->name}}</td>
                            <td>{{$company->address}}</td>
                            <td> <a class="btn btn-primary" href="{{route('company.edit',$company)}}">edit</a></td>
                            <td>
                                <form method="POST" action="{{route('company.destroy', $company)}}">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">DELETE</button>
                                </form>
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