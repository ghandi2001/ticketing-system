@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($ticketType))ویرایش اولویت بندی تیکت@elseافزودن اولویت بندی تیکت@endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="@if(isset($ticketPriority)) {{route('ticket-priority.update',$ticketPriority)}} @else {{route('ticket-priority.store')}} @endif" method="POST">
                        @csrf
                        @if(isset($ticketPriority)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان گروهبندی" @if(isset($ticketPriority)) value="{{$ticketPriority->title}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control" placeholder="توظیحات  گروهبندی"  @if(isset($ticketPriority)) value="{{$ticketPriority->description}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>نوع تیکت را انتخاب کنید</label>
                                <select class="form-control" id="sel1" name="ticket_type"  @if(!count($ticketTypes)) disabled @endif>
                                    @foreach($ticketTypes as $ticketType)
                                        <option value="{{$ticketType->id}}" @if($ticketType->id === $ticketPriority->id) selected @endif>{{$ticketType->title}}</option>
                                    @endforeach
                                </select>
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
