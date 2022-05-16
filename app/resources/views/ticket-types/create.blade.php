@extends('master.index')

@section('attempt-heads')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('attempt-scripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getPriority(id) {
            console.log(id);
            let request = $.ajax({
                type: "POST",
                url: "{{route('ticket.type.get.unit.priority')}}",
                dataType: "json",
                data: {"unit_id": id}
            });

            request.done(function (data) {
                document.getElementById('ticketPriority').style.display = 'block';
                let select = document.getElementById('ticketPrioritySelector');
                for(let i = 0;i < select.length;i++){
                    if(select[i].value == data.ticket_priority_id){
                        select[i].selected = 'selected';
                    }
                }
                // let selected = select.value = data.ticket_priority_id;
                // selected.selected = 'selected';
            });

            function getMethods(obj)
            {
                var res = [];
                for(var m in obj) {
                    if(typeof obj[m] == "function") {
                        res.push(m)
                    }
                }
                return res;
            }

            /*request.fail(function (response) {
                alert("Request failed: " + response.responseText);
            });*/
        }

    </script>
@endsection

@section('contents')
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@if(isset($ticketType))ویرایش نوع تیکت@elseافزودن نوع تیکت@endif</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form
                        action="@if(isset($ticketType)) {{route('ticket-type.update',$ticketType)}} @else {{route('ticket-type.store')}} @endif"
                        method="POST">
                        @csrf
                        @if(isset($ticketType)) @method('PUT') @endif
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>عنوان</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان گروهبندی"
                                       @if(isset($ticketType)) value="{{$ticketType->title}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>توظیحات</label>
                                <input type="text" name="description" class="form-control"
                                       placeholder="توظیحات  گروهبندی"
                                       @if(isset($ticketType)) value="{{$ticketType->description}}" @endif>
                            </div>
                            <div class="form-group col-md-12">
                                <label>بخش مربوطه</label>
                                <select class="form-control" name="unit_id" onchange="getPriority(this.value)">
                                    <option value="none">انتخاب کنید</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}"
                                                @if(isset($ticketType) && $ticketType->unit_id == $unit->id) selected @endif>{{$unit->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12" @if(!isset($ticketType)) style="display: none" @endif id="ticketPriority">
                                <label>اولویت</label>
                                <select class="form-control" name="ticket_priority_id" onchange="" id="ticketPrioritySelector">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($ticketPriorities as $ticketPriority)
                                        <option value="{{$ticketPriority->id}}"
                                                @if(isset($ticketType) && $ticketType->ticket_priority_id == $ticketPriority->id) selected @endif>
                                            {{$ticketPriority->title}}
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
