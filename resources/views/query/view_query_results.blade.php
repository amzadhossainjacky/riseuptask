@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="jumbotron text-center">
                <h1 class="display-4 mb-5">View Query Results</h1>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">User ID</th>
                        <th >First Name</th>
                        <th >Last Name</th>
                        <th >Email</th>
                        <th >Birthday</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $row)
                            <tr>
                                <th scope="row">{{$row->id}}</th>
                                <td>{{$row->first_name}}</td>
                                <td>{{$row->last_name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->birthday}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>

            </div>
        </div>
        <div class="col-lg-8">
           
        </div>
    </div>
</div>
@endsection
