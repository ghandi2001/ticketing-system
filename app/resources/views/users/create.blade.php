@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($user))
                        ویرایش واحد
                    @else
                        افزودن واحد
                    @endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if(count($errors) > 0)
                        @foreach( $errors->all() as $message )
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>{{ $message }}</span>
                            </div>
                        @endforeach
                    @endif
                    <form action="@if(isset($user)) {{route('user.update',$user)}} @else {{route('user.store')}} @endif"
                          method="POST">
                        @csrf
                        @if(isset($user))
                            @method('PUT')
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>نام</label>
                                <input type="text" name="name" class="form-control" placeholder="نام"
                                       @if(isset($user)) value="{{$user->name}}" @endif>
                            </div>
                            <div class="form-group col-md-6">
                                <label>نام خانوادگی</label>
                                <input type="text" name="surname" class="form-control" placeholder="نام خانوادگی"
                                       @if(isset($user)) value="{{$user->surname}}" @endif>
                            </div>
                            <div class="form-group col-md-6">
                                <label>شماره تلفن</label>
                                <input type="text" name="phone_number" class="form-control"
                                       placeholder="شماره تلفن"
                                       @if(isset($user)) value="{{$user->phone_number}}" @endif>
                            </div>
                            <div class="form-group col-md-6">
                                <label>کد پرسنلی</label>
                                <input type="text" name="personnel_code" class="form-control"
                                       placeholder="کد پرسنلی"
                                       @if(isset($user)) value="{{$user->personnel_code}}" @endif>
                            </div>
                            <div class="form-group col-md-6">
                                <label>گذرواژه</label>
                                <input type="text" name="password" class="form-control" placeholder="گذرواژه"
                                       @if(isset($user)) value="{{$user->password}}" @endif>
                            </div>
                            <div class="form-group col-md-6 m-auto">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="profile_picture" @if(isset($user)) value="{{$user->profile_picture}}" @endif>
                                    <label class="custom-file-label">عکس پروفایل</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary m-1">ثبت</button>
                                <button type="reset" class="btn btn-default m-1">برگشت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('attempt-scripts')
    <script type="text/javascript">
        // $(".custom-file-input").on("change", function () {
        //     var fileName = $(this).val().split("\\").pop();
        //     $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        // });
    </script>
@endsection
