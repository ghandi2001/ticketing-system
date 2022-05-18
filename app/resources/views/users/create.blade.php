@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($user))
                        ویرایش کاربر
                    @else
                        افزودن کاربر
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
                        @if(isset($user))
                            @method('PUT')
                        @endif
                        @csrf
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
                                       @if(isset($user)) value="{{$user->personnel_code}}" disabled @endif>
                            </div>
                            @if(!isset($user))
                                <div class="form-group col-md-6">
                                    <label>گذرواژه</label>
                                    <input type="text" name="password" class="form-control" placeholder="گذرواژه">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>تایید گذرواژه</label>
                                    <input type="text" name="password_confirmation" class="form-control" placeholder="تایید گذرواژه">
                                </div>
                            @endif
                            <div class="form-group col-md-6">
                                <label>نقش</label>
                                <select class="form-control" name="role_name">
                                    <option value="none">انتخاب کنید</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}"
                                                @if(isset($user) && $user->getRoleNames()->first() == $role->name) selected @endif>
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
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
