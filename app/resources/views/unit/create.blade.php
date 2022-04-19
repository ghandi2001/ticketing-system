@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">افزودن واحد</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" class="form-control" placeholder="1234 خیابان اصلی">
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="email" class="form-control" placeholder="پست الکترونیک">
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
