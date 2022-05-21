@extends('master.index')

@section('attempt-heads')
    <link href="{{asset('vendor/jquery-steps/css/jquery.steps.css')}}" rel="stylesheet">
@endsection

@section('attempt-scripts')
    <script src="{{asset('vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="{{asset('js/plugins-init/jquery-steps-init.js')}}"></script>

    <script type="text/javascript">
        function stepTwoController(state) {
            if (state === 'all') {
                $("#activatedRecords").prop("checked", true);
                $("#diactivatedRecprds").prop("checked", true);
                $("#deletedRecords").prop("checked", true);
            } else {
                $("#allRecords").prop("checked", false);
            }
        }
    </script>
@endsection

@section('contents')
    <div class="col-xl-12 col-xxl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">گزارش گیر</h4>
            </div>
            <div class="card-body">
                <form action="{{route('report.wizard.make')}}" id="step-form-horizontal" class="step-form-horizontal" method="POST">
                    @csrf
                    <div>
                        <h4>اطلاعات پایه بر اساس جدول</h4>
                        <section>
                            <div class="row">
                                <div class="form-group col-12" id="base_table">
                                    <label class="text-label" for="select">جداول</label>
                                    <select class="form-control valid" name="report_table" required id="select">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($tables as $table)
                                            <option value="{{$table}}">{{__('tables.'.$table)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </section>
                        <h4>نوع رکورد های درخواستی</h4>
                        <section style="text-align: center">
                            <div class="row">
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input"
                                               id="allRecords"
                                               value="1"
                                               name="all">
                                        <label class="custom-control-label" for="allRecords"
                                               onclick="stepTwoController('all')">
                                            تمام رکورد ها
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input"
                                               id="deletedRecords"
                                               value="1"
                                               name="deleted">
                                        <label class="custom-control-label" for="deletedRecords"
                                               onclick="stepTwoController('deleted')">
                                            رکورد های پاک شده
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input"
                                               id="activatedRecords"
                                               value="1"
                                               name="activated">
                                        <label class="custom-control-label" for="activatedRecords"
                                               onclick="stepTwoController('activated')">
                                            رکورد های فعال
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input"
                                               id="diactivatedRecprds"
                                               value="1"
                                               name="diactivated">
                                        <label class="custom-control-label" for="diactivatedRecprds"
                                               onclick="stepTwoController('diactivated')">
                                            رکورد های غیر فعال
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h4>مشخصات گزارش</h4>
                        <section>
                            <div class="form-group col-md-12">
                                <label>نام گزارش</label>
                                <input type="text" name="report_name" class="form-control" placeholder="نام گزارش" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات گزارش</label>
                                <input type="text" name="report_description" class="form-control"
                                       placeholder="نام گزارش" required>
                            </div>
                        </section>
                        <h4>دریافت گزارش</h4>
                        <section style="text-align: center">
                            <div class="basic-form">
                                <button type="submit" class="btn btn-primary m-2">دریافت و ذخیره گزارش</button>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

