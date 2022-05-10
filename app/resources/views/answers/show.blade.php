@extends('master.index')

@section('contents')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-9 col-sm-12">
                        <div class="product-detail-content">
                            <div class="new-arrival-content pr col-md-12">
                                <h3>جواب : {{$answer->answer}}</h3>
                                <p class="text-content">وظعیت : @if($answer->is_active)
                                        <span class="badge badge-rounded badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-rounded badge-danger">غیر فعال</span>
                                @endif</p>
                                <p class="text-content">
                                    اولویت های مرتبط :
                                </p>
                                <ul>
                                @foreach($answer->ticketPriority as $ticketPriority)
                                            <li>{{$ticketPriority->title}}</li>
                                    @endforeach
                                </ul>
                                <p class="text-content">
                                    نوع های مرتبط :
                                </p>
                                <ul>
                                    @foreach($answer->ticketType as $ticketType)
                                    <li>{{$ticketType->title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
