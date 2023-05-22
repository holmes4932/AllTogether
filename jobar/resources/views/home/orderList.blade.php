@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">尋找團購訂單</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped" id="example-2">
                    <thead>
                        <tr>
                            <th data-name="order_list">訂單</th>
                            <th data-name="people">人數或金額</th>
                        </tr>
                    </thead>
                    @foreach ($groupHasUser as $item)
                    <tbody>
                        <tr>
                            <td>{{ $item['order_list'] }}</td>
                            <td>{{ $item['people'] }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
