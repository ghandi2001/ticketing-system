@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($unit))ویرایش واحد@else افزودن واحد@endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="@if(isset($unit)) {{route('unit.update',$unit)}} @else {{route('unit.store')}} @endif"
                          method="POST">
                        @csrf
                        @if(isset($unit)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان گروهبندی"
                                       @if(isset($unit)) value="{{$unit->title}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control"
                                       placeholder="توظیحات  گروهبندی"
                                       @if(isset($unit)) value="{{$unit->description}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>اولویت</label>
                                <select class="form-control" name="ticket_priority_id" onchange="">
                                    @foreach($ticketPriorities as $ticketPriority)
                                        <option value="{{$ticketPriority->id}}"
                                                @if(isset($unit) && $unit->ticket_priority_id == $ticketPriority->id) selected @endif> {{$ticketPriority->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary m-1">ثبت</button>
                            <button type="reset" class="btn btn-default m-1">ریست</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
