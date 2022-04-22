@extends('master.index')

@section('contents')
    <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">گروه بندی تیکت</h4>
                <a href="{{route('ticket-group.create')}}" class="btn btn-primary  sharp mr-1">افزودن</a>
            </div>
            <div class="card-body">
                <div class="table-responsive recentOrderTable">
                    <table class="table verticle-middle table-responsive-md">
                        <thead>
                        <tr>
                            <th scope="col">عنوان</th>
                            <th scope="col">توظیحات</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ticketGroups as $ticketGroup)
                            <tr>
                                <td>{{$ticketGroup->title}}</td>
                                <td>{{$ticketGroup->description}}</td>
                                <td>
                                    <div class="dropdown custom-dropdown mb-0">
                                        <div class="btn sharp btn-primary tp-btn" data-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px"
                                                 viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <circle fill="#000000" cx="12" cy="5" r="2"></circle>
                                                    <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                    <circle fill="#000000" cx="12" cy="19" r="2"></circle>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="{{route('ticket-group.show',$ticketGroup)}}" method="GET">
                                                <input type="submit" class="dropdown-item" value="جزئیات"/>
                                            </form>
                                            <form action="{{route('ticket-group.edit',$ticketGroup)}}" method="GET">
                                                <input type="submit" class="dropdown-item" value="ویرایش"/>
                                            </form>
                                            <form action="{{route('ticket-group.destroy',$ticketGroup)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            <input type="submit" class="dropdown-item text-danger" value="حذف"></in>
                                            </form>
                                        </div>
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
