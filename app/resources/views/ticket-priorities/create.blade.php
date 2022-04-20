@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">افزودن اولویت بندی تیکت</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{route('ticket-priority.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان اولویت بندی">
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control"
                                       placeholder="توظیحات اولویت بندی">
                            </div>
                            <div class="form-group col-md-12">
                                <label>نوع تیکت را انتخاب کنید</label>
                                <select class="form-control" id="sel1" name="ticket-type"  @if(!count($ticketTypes)) disabled @endif>
                                    @foreach($ticketTypes as $ticketType)
                                        <option value="{{$ticketType->id}}">{{$ticketType->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
