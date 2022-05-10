@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($answer))ویرایش جواب آماده@else افزودن جواب آماده@endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="@if(isset($answer)) {{route('answer.update',$answer)}} @else {{route('answer.store')}} @endif" method="POST">
                        @csrf
                        @if(isset($answer)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>جواب</label>
                                <input type="text" name="answer" class="form-control" placeholder="جواب" @if(isset($answer)) value="{{$answer->answer}}" @endif>
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
