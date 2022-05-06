@extends('master.index')
@section('contents')
    <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">اولویت بندی تیکت ها</h4>
                <a href="{{route('ticket-priority.create')}}" class="btn btn-primary  sharp mr-1">افزودن</a>
            </div>
            <div class="card-body">
                <div class="table-responsive recentOrderTable">
                    <table class="table verticle-middle table-responsive-md">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th style="padding: 2vh 15vh">عنوان</th>
                            <th style="padding: 2vh 15vh">توظیحات</th>
                            <th style="padding: 2vh 15vh">نوع تیکت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($ticketPriorities as $ticketPriority)
                            <tr>
                                <td>{{$row++}}</td>
                                <td style="padding: 2vh 15vh">{{$ticketPriority->title}}</td>
                                <td style="padding: 2vh 15vh">{{$ticketPriority->description}}</td>
                                <td style="padding: 2vh 15vh">{{$ticketPriority->ticketType->title}}</td>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{route('ticket-priority.show',$ticketPriority)}}" method="GET">
                                            <input type="submit" class="btn btn-info btn-sm ml-2 px-4" value="جزئیات">
                                        </form>
                                        <form action="{{route('ticket-priority.edit',$ticketPriority)}}" method="GET">
                                            <input type="submit" class="btn btn-primary btn-sm ml-2 px-4"
                                                   value="ویرایش">
                                        </form>
                                        <form action="{{route('ticket-priority.destroy',$ticketPriority)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-danger btn-sm ml-2 px-4" value="حذف">
                                        </form>
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
