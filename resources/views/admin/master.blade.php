<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    chrome-extension://<EXTENSIONID>/manage.html
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{ Html::style('bower/components-font-awesome/css/font-awesome.min.css') }}
    {!! Html::style('css/app.css') !!}
    {{ Html::style('css/admin/style.css') }}
    {{ Html::style('bower/toastr/toastr.min.css') }}
    {!! Html::script('bower/ckeditor_stand/ckeditor.js') !!}
    {!! Html::script('bower/ckfinder/ckfinder.js') !!}
    {{ Html::style('bower/sweetalert2/dist/sweetalert2.css') }}
    @yield('style')
</head>
<body>
    <div class="wrapper">
    @include('admin._section.header')
    @include('admin._section.aside')
    @yield('content-admin')
    </div>
    {{ Html::script('bower/jquery/dist/jquery.min.js') }}
    {!! Html::script('js/app.js') !!}
    {{ Html::script('bower/owl.carousel/docs/assets/owlcarousel/owl.carousel.min.js') }}
    {{ Html::script('bower/vue/dist/vue.min.js') }}
    {{ Html::script('bower/toastr/toastr.min.js') }}
    {{ Html::script('bower/sweetalert2/dist/sweetalert2.js') }}
    @yield('script')
</body>
</html>
