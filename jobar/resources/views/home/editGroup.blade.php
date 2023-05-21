@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <div class="page-title">
            <div class="title-env">
                <h1 class="title">
                    {{ $group['submit'] }} 編輯團購訂單資訊
                </h1>
            </div>
            
            <div class="breadcrumb-env">
                <ol class="breadcrumb bc-1">
                    <li>
                        <a href="/group/own">返回訂單列表</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <form action="{{ '/group/updateOrCreate/'.$group['id'] }}" class="form-horizontal" method="post" accept-charset="utf-8" enctype="multipart/form-data" onSubmit="return check_form(this)"> 
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="name">團購訂單名稱名稱</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $group['name'] }}">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="max_people">最大人數或價錢</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="max_people" name="max_people" value="{{ $group['max_people'] }}">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="min_people">最小人數或價錢</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="min_people" name="min_people" value="{{ $group['min_people'] }}">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="current_people">初始人數或價錢</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="current_people" name="current_people" value="{{ $group['current_people'] }}">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="deadline">截止時間</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="deadline" name="deadline" value="{{ $group['deadline'] }}">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="submit"  class="btn btn-purple" value="儲存"/>     
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
