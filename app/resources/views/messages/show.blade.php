@extends('master.index')

@section('attempt-scripts')
    <script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('js/plugins-init/select2-init.js')}}"></script>
    <script>
        function setAnswer(answer) {
            if (answer === 'none') {
                let answerTextBox = $("#answerTextBox");
                answerTextBox.innerHTML = "";
                answerTextBox.prop('disabled', false);
            } else {
                $("#answerTextBox").prop('disabled', true);
            }
        }
    </script>
@endsection


@section('contents')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">پیام ها</h4>
            </div>
            <div class="card-body">
                <div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1" style="height:370px;">
                    <ul class="timeline">
                        @foreach($messages as $message)
                            <li>
                                <div class="timeline-badge @if($message->is_served) danger @else dark @endif">
                                </div>
                                <a class="timeline-panel text-muted" href="#">
                                    <span>{{ \Illuminate\Support\Carbon::parse($message->created_at)->diffInMinutes(\Illuminate\Support\Carbon::now()) }} دقیقه پیش </span>
                                    <h6 class="mb-0">{{$message->message}}</h6>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if(!isset($ticket->closed_at))
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">ثبت پیام</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form
                            action="{{route('messages.store')}}"
                            method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>پیام</label>
                                    <input type="text" name="message" class="form-control" placeholder="پیام"
                                           id="answerTextBox" style="border-radius: 2rem">
                                    <input type="hidden" value="{{$ticket}}" name="ticket">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>جواب های آماده</label>
                                    <select id="single-select" class="form-control" style="border-radius: 2rem"
                                            onchange="setAnswer(this.value)" name="readyAnswer">
                                        <option value="none">انتخاب</option>
                                        @foreach($answers as $answer)
                                            <option
                                                value="{{$answer->answer->answer}}">{{$answer->answer->answer}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary m-2">ثبت</button>
                            </div>
                        </form>
                        @if(checkAnyAccessToTemplate('close ticket'))
                            <form action="{{route('ticket.edit',$ticket)}}">
                                <button type="submit" class="btn btn-danger m-1">بستن تیکت</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('attempt-heads')
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
@endsection

