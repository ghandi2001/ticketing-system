@extends('master.index')

@section('contents')
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-info">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-book"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">تعداد تیکت ها</p>
                        <h3 class="text-white">{{\App\Models\Ticket::all()->count()}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-danger">
            <div class="card-body  p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-close"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">تیکت های بسته شده</p>
                        <h3 class="text-white">{{\App\Models\Ticket::query()->whereNotNull('closed_at')->get()->count()}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-success">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-on"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">تیکت های باز</p>
                        <h3 class="text-white">{{\App\Models\Ticket::query()->whereNull('closed_at')->get()->count()}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-sm-6">
        <div class="widget-stat card bg-primary">
            <div class="card-body p-4">
                <div class="media">
                    <span class="mr-3">
                        <i class="flaticon-381-user-7"></i>
                    </span>
                    <div class="media-body text-white text-right">
                        <p class="mb-1">تعداد کاربران</p>
                        <h3 class="text-white">{{\App\Models\User::all()->count()}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">تیکت ها</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive recentOrderTable">
                    <table class="table verticle-middle table-responsive-md">
                        <thead>
                        <tr>
                            <th></th>
                            <th>ردیف</th>
                            <th>عنوان تیکت</th>
                            <th>وظعیت</th>
                            <th>اولویت</th>
                            <th>زمان باز شده</th>
                            <th>زمان بسته شده</th>
                            <th>ساخته شده توسط</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($tickets as $ticket)
                            <tr>
                                <td></td>
                                <td>{{$row++}}</td>
                                <td>{{$ticket->title}}</td>
                                <td>@if(!$ticket->closed_at)
                                        <span class="badge badge-rounded badge-success">باز</span>
                                    @else
                                        <span class="badge badge-rounded badge-danger">بسته</span>
                                    @endif </td>
                                <td>{{$ticket->ticketType->ticketPriority->title}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('%A, %d %B %Y')}}</td>
                                <td>@if($ticket->closed_at){{\Morilog\Jalali\Jalalian::fromDateTime($ticket->closed_at)->format('%A, %d %B %Y')}}@else
                                        - @endif</td>
                                <td>{{$ticket->user->name}} - {{$ticket->user->surname}}</td>
                                <td>
                                    <div class="d-flex">
                                        @if(checkAnyAccessToTemplate('see ticket'))
                                            <form action="" method="GET">
                                                <input type="submit" class="btn btn-info btn-sm ml-2 px-4"
                                                       value="جزئیات">
                                            </form>
                                        @endif
                                        @if(!isset($ticket->closed_at))
                                            @if(checkAnyAccessToTemplate('answer ticket'))
                                                <form action="{{route('messages.show',$ticket->id)}}" method="GET">
                                                    <input type="submit" class="btn btn-success btn-sm ml-2 px-4"
                                                           value="پاسخ دهی">
                                                </form>
                                            @endif
                                            @if(checkAnyAccessToTemplate('close ticket'))
                                                <form action="" method="GET">
                                                    <input type="submit" class="btn btn-danger btn-sm ml-2 px-4"
                                                           value="بستن تیکت">
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

