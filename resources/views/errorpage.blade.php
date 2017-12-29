@extends('sites.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    Something happened</h2>
                <div class="error-details">
                    Sorry, an error has occured!
                </div>
                <div class="error-actions">
                    <a href="/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
{{ Html::style('css/errpage.css') }}
@endsection
