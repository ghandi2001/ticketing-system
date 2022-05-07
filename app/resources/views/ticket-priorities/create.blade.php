@extends('master.index')

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($ticketPriority))ویرایش اولویت بندی تیکت@elseافزودن اولویت بندی
                    تیکت@endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form
                        action="@if(isset($ticketPriority)) {{route('ticket-priority.update',$ticketPriority)}} @else {{route('ticket-priority.store')}} @endif"
                        method="POST">
                        @csrf
                        @if(isset($ticketPriority)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان اولویت بندی"
                                       @if(isset($ticketPriority)) value="{{$ticketPriority->title}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control"
                                       placeholder="توظیحات اولویت بندی"
                                       @if(isset($ticketPriority)) value="{{$ticketPriority->description}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>نوع موجودیت دارای اولویت</label>
                                <select
                                    class="form-control" name="type_of_priority"
                                    onchange="showEntityOfPriority(this.value)">
                                    @foreach($type_of_priorities as $key => $value)
                                        <option value="{{$key}}"
                                                @if(isset($ticketPriority))
                                                @if(isset($ticketPriority->unit_id) && $key == 'unit') selected @endif
                                                @if(isset($ticketPriority->ticket_type_id) && $key == 'ticketType') selected @endif
                                            @endif>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12" id="ticketType" style="display: none">
                                <label>نوع تیکت مربوطه</label>
                                <select class="form-control" name="ticket_type_id">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($ticketTypes as $ticketType)
                                        <option value="{{$ticketType->id}}"
                                                @if(isset($ticketPriority) && $ticketPriority->ticket_type_id == $ticketType->id) selected @endif >{{$ticketType->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12" id="unit" style="display: none">
                                <label>بخش مربوطه</label>
                                <select class="form-control" name="unit_id">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}"
                                                @if(isset($ticketPriority) && $ticketPriority->unit_id == $unit->id) selected @endif>{{$unit->title}}</option>
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

@section('attempt-scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        @if(isset($state))
        showEntityOfPriority({!! $state !!})
        @endif

        $('#test').inputTags({
            autocomplete: {
                values: ['Pellentesque', 'habitant', 'morbi', 'tristique', 'senectus'] // autocomplete list
            }
        });

        function showEntityOfPriority(selected) {
            console.log(selected);
            let ticketType = document.getElementById('ticketType');
            let unit = document.getElementById('unit');
            if (selected === 'ticketType') {
                ticketType.style.display = "block";
                unit.style.display = "none";
            } else if (selected === 'unit') {
                ticketType.style.display = "none";
                unit.style.display = "block";
            } else {
                ticketType.style.display = "none";
                unit.style.display = "none";
            }
        }
    </script>
@endsection
