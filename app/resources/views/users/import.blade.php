@extends('master.index')

@section('contents')
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">کادر انتخاب</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">دریافت نمونه اکسل</h4>
                            </div>
                            <div class="card-body" style="text-align: center">
                                <form action="{{route('user.sample.export')}}" method="GET">
                                    <div class="basic-form">
                                        <button type="submit" class="btn btn-primary m-2">دریافت نمونه اکسل</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ورودی پرونده اکسل</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form custom_file_input">
                                    <form class="custom_file_input basic-form" action="{{route('user.import.work')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group col-md-12">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">بارگذاری</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" id="file-input"
                                                           class="custom-file-input"
                                                           name="uploaded_file">
                                                    <label class="custom-file-label">عکس پروفایل</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary m-3" type="submit">ارسال</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('attempt-scripts')
    <script type="text/javascript">
        $("#file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
