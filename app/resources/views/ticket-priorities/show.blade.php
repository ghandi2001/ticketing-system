@extends('master.index')

@section('contents')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-9 col-sm-12">
                        <div class="product-detail-content">
                            <div class="new-arrival-content pr col-md-12">
                                <h3>عنوان : {{$ticketPriority->title}}</h3>
                                <p class="text-content">اولویت بر طبق شماره : {{$ticketPriority->number}}</p>
                                <p class="text-content">توظیحات : {{$ticketPriority->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
