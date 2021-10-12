@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer list</div>
                <form class="card-header" action="{{route('customer.index')}}" method="get">
                    <fieldset>
                        <legend>Filter</legend>
                        <div class="block">
                            <div class="form-group">
                                <select name="company_id">
                                    @foreach ($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Select company from the list.</small>
                            </div>
                        </div>
                        <div class="block">
                            <button type="submit" class="btn btn-info" name="filter" value="company">Filter</button>
                            <a href="{{route('customer.index')}}" class="btn btn-warning">Reset</a>
                        </div>
                    </fieldset>
                </form>
                <div class="card-body">
                     <div class="mb-3">{{$customers->links()}}</div>
                    <table class="table" >
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Comment</th>
                            <th>Photo</th>
                            <th>Show</th>         
                        </tr>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->surname}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{!!$customer->comment!!}</td>
                            <td>
                            @if($customer->photo_name!=null)    
                            <img src="{{asset('customerPhoto/'.$customer->photo_name)}}"alt="">
                            </form>
                                   <form method="POST" action="{{route('customer.deletePhoto', $customer)}}">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">delete photo</button>
                                </form>
                                @endif
                            </td>
                            <td>
                            <a class="btn btn-primary" href="{{route('customer.show',$customer)}}">show</a>
                            </td>
                            <br>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mt-3">{{$customers->links()}}</div>
            </div>
        </div>
    </div>
</div>
@endsection