@extends('master.index')

@section('contents')
    <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">انواع تیکت</h4>
                <a href="{{route('ticket-type.create')}}" class="btn btn-primary  sharp mr-1">افزودن</a>
            </div>
            <div class="card-body">
                <div class="table-responsive recentOrderTable">
                    <table class="table verticle-middle table-responsive-md">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th style="padding: 2vh 15vh">عنوان</th>
                            <th style="padding: 2vh 15vh">توظیحات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($ticketTypes as $ticketType)
                            <tr>
                                <td>{{$row++}}</td>
                                <td style="padding: 2vh 15vh">{{$ticketType->title}}</td>
                                <td style="padding: 2vh 15vh">{{$ticketType->description}}</td>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{route('ticket-type.show',$ticketType)}}" method="GET">
                                            <input type="submit" class="btn btn-info btn-sm ml-2 px-4" value="جزئیات">
                                        </form>
                                        <form action="{{route('ticket-type.edit',$ticketType)}}" method="GET">
                                            <input type="submit" class="btn btn-primary btn-sm ml-2 px-4"
                                                   value="ویرایش">
                                        </form>
                                        <form action="{{route('ticket-type.destroy',$ticketType)}}" method="POST">
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
