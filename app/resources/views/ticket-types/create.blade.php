@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($ticketType))ویرایش نوع تیکت@elseافزودن نوع تیکت@endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="@if(isset($ticketType)) {{route('ticket-type.update',$ticketType)}} @else {{route('ticket-type.store')}} @endif" method="POST">
                        @csrf
                        @if(isset($ticketType)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان گروهبندی" @if(isset($ticketType)) value="{{$ticketType->title}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control" placeholder="توظیحات  گروهبندی"  @if(isset($ticketType)) value="{{$ticketType->description}}" @endif>
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
