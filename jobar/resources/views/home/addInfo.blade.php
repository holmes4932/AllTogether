@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <div class="page-title">
            <div class="title-env">
                <h1 class="title">
                    加入資訊
                </h1>
            </div>
            
            <div class="breadcrumb-env">
                <ol class="breadcrumb bc-1">
                    <li>
                        <a href="/group/search">返回訂單列表</a>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <form action="{{ $group['form'] }}" class="form-horizontal" method="post" accept-charset="utf-8" enctype="multipart/form-data" onSubmit="return check_form(this)"> 
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="order_list">訂單</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="order_list" name="order_list" value="">
                            </div>
                        </div>

                        <div class="form-group-separator"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="people">人數或價錢</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="people" name="people" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="submit"  class="btn btn-purple" value="儲存"/>
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id" value="" />
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
