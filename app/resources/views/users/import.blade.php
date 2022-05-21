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
                                    <form action="#">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">بارگذاری</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input">
                                                <label class="custom-file-label">انتخاب فایل</label>
                                            </div>
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
@endsection

@section('attempt-scripts')
    <script type="text/javascript">
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
