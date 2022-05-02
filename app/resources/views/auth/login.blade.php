<!DOCTYPE html>
<html lang="fa" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>داشبورد تیکسیا</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <h4 class="text-center mb-4">وارد حساب خود شوید</h4>
                                <form action="{{route('login')}}" method="POST">
                                    @csrf
                                    @if(count($errors) > 0)
                                        @foreach( $errors->all() as $message )
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button>
                                                <span>{{ $message }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="form-group">
                                        <label class="mb-1"><strong>شماره تلفن</strong></label>
                                        <input type="text" class="form-control" minlength="11" maxlength="11" placeholder="09123456789" style="text-align: left" name="phone_number">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>کلمه عبور</strong></label>
                                        <input type="password" class="form-control" placeholder="Password" style="text-align: left" name="password">
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="basic_checkbox_1">
                                                <label class="custom-control-label" for="basic_checkbox_1">من را بخاطر
                                                    بسپار</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">وارد شوید</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('vendor/global/global.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/custom.min.js')}}"></script>
<script src="{{asset('js/deznav-init.js')}}"></script>

</body>
</html>
