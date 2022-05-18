@extends('master.index')

@section('contents')
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo"></div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="{{asset($user->profile_picture)}}" class="img-fluid rounded-circle" alt="">
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0">{{$user->name .' - '. $user->surname}}</h4>
                            <p>{{$user->getRoleNames()->first()}}</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">{{$user->phone_number}}</h4>
                            <p>شماره موبایل</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-statistics mb-5">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="m-b-0">{{$user->getOpenTickets()}}</h3><span>تعداد تیکت های باز شده</span>
                                        </div>
                                        <div class="col">
                                            <h3 class="m-b-0">{{$user->getClosedTickets()}}</h3><span>تعداد تیکت های بسته شده</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link">پروفایل
                                                کاربر</a>
                                        </li>
                                        <li class="nav-item"><a href="#profile-settings" data-toggle="tab"
                                                                class="nav-link">تنظیمات</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content m-4">
                                        <div id="about-me" class="tab-pane fade active show">
                                            <div class="profile-skills mb-5">
                                                <h4 class="text-primary mb-2">نقش کاربر</h4>
                                                <a href="javascript:void()"
                                                   class="btn btn-primary light btn-xs mb-1">{{$user->getRoleNames()->first()}}</a>
                                            </div>
                                            <div class="profile-personal-info">
                                                <h4 class="text-primary mb-4">اطلاعات شخصی</h4>
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">نام:
                                                        </h5>
                                                    </div>
                                                    <div class="col-9">
                                                        <span>{{$user->name .' - '. $user->surname}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">شماره موبایل:
                                                        </h5>
                                                    </div>
                                                    <div class="col-9"><span>{{$user->phone_number}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">کد پرسنلی: </h5>
                                                    </div>
                                                    <div class="col-9"><span>{{$user->personnel_code}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">جنسیت:
                                                        </h5>
                                                    </div>
                                                    <div class="col-9"><span>{{$user->gender}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-3">
                                                        <h5 class="f-w-500">وظعیت دسترسی:</h5>
                                                    </div>
                                                    <div class="col-9">
                                                        <span>
                                                            @if($user->has_accessed)
                                                                <span
                                                                    class="badge badge-rounded badge-success">فعال</span>
                                                            @else
                                                                <span
                                                                    class="badge badge-rounded badge-danger">غیر فعال</span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="profile-settings" class="tab-pane fade">
                                            <div class="pt-3">
                                                <div class="settings-form m-2">
                                                    <h4 class="text-primary">تنظیمات حساب</h4>
                                                    <form class="custom_file_input basic-form"
                                                          action="{{route('user.update.profile',$user)}}" method="POST"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label>شماره موبایل:</label>
                                                                <input name="phone_number" type="text"
                                                                       value="{{$user->phone_number}}"
                                                                       placeholder="شماره موبایل:" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>نام</label>
                                                                <input name="name" type="text" placeholder="نام"
                                                                       value="{{$user->name}}" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>نام خانوادگی</label>
                                                                <input name="surname" type="text"
                                                                       placeholder="نام خانوادگی"
                                                                       value="{{$user->surname}}" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>کلمه عبور</label>
                                                                <input name="password" type="password"
                                                                       placeholder="کلمه عبور"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>کلمه عبور</label>
                                                                <input name="password_confirmation" type="password"
                                                                       value="" placeholder="کلمه عبور"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">بارگذاری</span>
                                                                    </div>
                                                                    <div class="custom-file">
                                                                        <input type="file" id="file-input"
                                                                               class="custom-file-input"
                                                                               name="profile_picture">
                                                                        <label class="custom-file-label">عکس پروفایل</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">ثبت</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('attempt-scripts')
    <script type="text/javascript">
        $("#file-input").on("change", function () {
            let fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
