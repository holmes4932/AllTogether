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
                            <th data-name="name">團購名稱</th>
                            <th data-name="owner_user_name">開團者</th>
                            <th data-name="max_people">最大容量</th>
                            <th data-name="min_people">最小容量</th>
                            <th data-name="current_people">現在容量</th>
                            <th data-name="created_at">建立日期</th>
                            <th data-name="updated_at">更新日期</th>
                            <th data-name="updated_at">選項</th>
                        </tr>
                    </thead>
                    @foreach ($groups as $group)
                    <tbody>
                        <tr>
                            <td>{{ $group['name'] }}</td>
                            <td>{{ $group['owner_user_name'] }}</td>
                            <td>{{ $group['max_people'] }}</td>
                            <td>{{ $group['min_people'] }}</td>
                            <td>{{ $group['current_people'] }}</td>
                            <td>{{ $group['created_at'] }}</td>
                            <td>{{ $group['updated_at'] }}</td>
                            <td>

                            </td>
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
