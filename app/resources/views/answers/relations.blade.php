@extends('master.index')

@section('attempt-heads')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('attempt-scripts')
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function setRelation(id, type) {
            let request = $.ajax({
                type: "POST",
                url: "{{route('answer.relations.store.destruct',$answer)}}",
                dataType: 'json',
                data: {"data": id, "type": type},
            });

            request.done(function () {
                window.location.reload(true);
            });

            request.fail(function (response) {
                alert("Request failed: " + response.responseText);
            });
        }

    </script>
@endsection

@section('contents')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> جواب : {{$answer->answer}}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ارتباط با اولویت بندی ها</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php($row=1)
                                    @foreach($ticketPriorities as $ticketPriority)
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="priorityCheckBox{{$row}}"
                                                       value="{{$ticketPriority->id}}"
                                                       @if(in_array($ticketPriority->id,$answerTicket->pluck('ticket_priority_id')->toArray())) checked
                                                       @endif onchange="setRelation(this.value,'priority')">
                                                <label class="custom-control-label"
                                                       for="priorityCheckBox{{$row++}}">{{$ticketPriority->title}}
                                                    @if(isset($ticketPriority->ticketType))
                                                        - {{$ticketPriority->ticketType->title}} @endif</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ارتباط با نوع تیکت ها</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php($row = 1)
                                    @foreach($ticketTypes as $ticketType)
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="typeCheckBox{{$row}}"
                                                       value="{{$ticketType->id}}"
                                                       onchange="setRelation(this.value,'type')"
                                                       @if(in_array($ticketType->id,$answerTicket->pluck('ticket_type_id')->toArray())) checked @endif>
                                                <label class="custom-control-label"
                                                       for="typeCheckBox{{$row++}}">{{$ticketType->title}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
