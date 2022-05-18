@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($role)) ویرایش نقش @else افزودن نقش @endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form
                        action="@if(isset($role)) {{route('role.update',$role)}} @else {{route('role.store')}} @endif"
                        method="POST">
                        @csrf
                        @if(isset($role)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="name" class="form-control" placeholder="عنوان نقش"
                                       @if(isset($role)) value="{{$role->name}}" @endif>
                            </div>
                            <button type="submit" class="btn btn-primary m-1">ثبت</button>
                            <button type="reset" class="btn btn-default m-1">برگشت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
