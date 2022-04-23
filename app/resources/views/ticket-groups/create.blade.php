@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($ticketGroup))ویرایش گروهبندی@else افزودن گروه بندی تیکت @endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="@if(isset($ticketGroup)) {{route('ticket-group.update',$ticketGroup)}} @else {{route('ticket-group.store')}} @endif" method="POST">
                        @csrf
                        @if(isset($ticketGroup)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان گروهبندی" @if(isset($ticketGroup)) value="{{$ticketGroup->title}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control" placeholder="توظیحات  گروهبندی"  @if(isset($ticketGroup)) value="{{$ticketGroup->description}}" @endif>
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
