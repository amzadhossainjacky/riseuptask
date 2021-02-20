@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="jumbotron text-center">
                <h1 class="display-4 mb-5">View All Articles</h1>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Article ID</th>
                        <th scope="col">Content</th>
                        <th scope="col">Payment Amount</th>
                        <th scope="col">Payment Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($allArticles as $row)
                            <tr>
                                <th scope="row">{{$row->id}}</th>
                                <td>{{$row->article_content}}</td>
                                <td>{{$row->payment_amount}}</td>
                                <td>
                                    @if ($row->payment_status == 0)
                                        <span class="badge badge-warning" style="font-size:14px;padding:5px;">Not Paid</span>
                                    @else 
                                        <span class="badge badge-success" style="font-size:14px;padding:5px;">Paid</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>

            </div>
        </div>
    </div>
</div>
@endsection
