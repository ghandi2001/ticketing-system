@extends('master.index')

@section('contents')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-9 col-sm-12">
                            <div class="product-detail-content">
                                <div class="new-arrival-content pr col-md-12">
                                    <h4>{{$ticketGroup->title}}</h4>
                                    <p class="text-content">{{$ticketGroup->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
