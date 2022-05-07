@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ثبت تیکت</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form
                        action="{{route('ticket.store')}}"
                        method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان تیکت"
                                       @if(isset($ticket)) value="{{$ticket->title}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control" placeholder="توظیحات تیکت"
                                       @if(isset($ticket)) value="{{$ticket->description}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>نوع تیکت</label>
                                <select class="form-control" name="ticket_type">
                                    <option>انتخاب کنید</option>
                                    @foreach($ticketTypes as $ticketType)
                                        <option value="{{$ticketType->id}}">{{$ticketType->title}}</option>
                                    @endforeach
                                    <option value="other">غیره</option>
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
