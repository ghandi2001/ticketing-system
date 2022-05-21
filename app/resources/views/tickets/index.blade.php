@extends('master.index')

@section('contents')
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
                            <th>
                                <div class="checkbox mr-0 align-self-center">
                                    <div class="custom-control custom-checkbox ">
                                        <input type="checkbox" class="custom-control-input" id="checkAll"
                                               onclick="/*getAllSelectedItems({{--{{$answers->pluck('id')}}--}}) TODO::MAKE SOME CHANGES*/">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </div>
                            </th>
                            <th>ردیف</th>
                            <th>عنوان تیکت</th>
                            <th>وظعیت</th>
                            <th>اولویت</th>
                            <th>زمان باز شده</th>
                            <th>زمان بسته شده</th>
                            <th>ساخته شده توسط</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <div class="checkbox mr-0 align-self-center">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="customCheckBox{{$row}}"
                                                   required=""
                                                   onclick="/*getSelectedItems({{--{{$answer->id}}--}}) TODO::MAKE SOME CHANGES */">
                                            <label class="custom-control-label" for="customCheckBox{{$row}}"></label>
                                        </div>
                                    </div>
                                </td>
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
