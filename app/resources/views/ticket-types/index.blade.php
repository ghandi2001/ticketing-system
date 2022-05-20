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

        let types = [];

        function getSelectedItems(id) {
            if (types.indexOf(id) === -1) {
                types.push(id);
            } else {
                let index = types.indexOf(id);
                if (index !== -1) {
                    types.splice(index, 1);
                }
            }
            console.log(types);
        }

        function getAllSelectedItems(id) {
            if (types.length === 0) {
                types = id;
            } else {
                types = [];
            }
        }

        function changeStatusOfSelectedTypes() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('ticket.type.collective.changeStatus')}}",
                dataType: 'json',
                data: {'data': types},
            });

            request.done(function () {
                window.location.reload(true);
            });

            request.fail(function (response) {
                alert("Request failed: " + response.responseText);
            });
        }

        function deleteSelectedTypes() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('ticket.type.collective.destruction')}}",
                dataType: 'json',
                data: {'data': types},
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
    <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">انواع تیکت</h4>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary dropdown-toggle sharp" data-toggle="dropdown">عملیات
                    </button>
                    @if(checkAnyAccessToTemplate(['add ticketType','delete ticketType','edit ticketType']))
                        <div class="dropdown-menu">
                            @if(checkAnyAccessToTemplate('add ticketType'))
                                <a href="{{route('ticket-type.create')}}" class="dropdown-item">افزودن</a>
                            @endif
                            @if(checkAnyAccessToTemplate('delete ticketType'))
                                <a href="javascript:void(0);" onclick="deleteSelectedTypes()"
                                   class="dropdown-item">حذف</a>
                            @endif
                            @if(checkAnyAccessToTemplate('edit ticketType'))
                                <a href="javascript:void(0);" onclick="changeStatusOfSelectedTypes()"
                                   class="dropdown-item">فعال و غیر فعال کردن موجودیت ها</a>
                            @endif
                        </div>
                    @endif
                </div>
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
                                               onclick="getAllSelectedItems({{$ticketTypes->pluck('id')}})">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </div>
                            </th>
                            <th>ردیف</th>
                            <th>عنوان</th>
                            <th>توظیحات</th>
                            <th>وظعیت</th>
                            <th>زمان ساخته شده</th>
                            <th>اولویت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($ticketTypes as $ticketType)
                            <tr>
                                <td>
                                    <div class="checkbox mr-0 align-self-center">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="customCheckBox{{$row}}"
                                                   required="" onclick="getSelectedItems({{$ticketType->id}})">
                                            <label class="custom-control-label" for="customCheckBox{{$row}}"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$row++}}</td>
                                <td>{{$ticketType->title}}</td>
                                <td>{{$ticketType->description}}</td>
                                <td>@if($ticketType->is_active)
                                        <span class="badge badge-rounded badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-rounded badge-danger">غیر فعال</span>
                                    @endif </td>
                                <td>{{\Morilog\Jalali\Jalalian::fromDateTime($ticketType->created_at)->format('%A, %d %B %Y')}}</td>
                                <td>{{$ticketType->ticketPriority->title}}</td>
                                <td>
                                    <div class="d-flex">
                                        @if(checkAnyAccessToTemplate('see ticketType'))
                                            <form action="{{route('ticket-type.show',$ticketType)}}" method="GET">
                                                <input type="submit" class="btn btn-info btn-sm ml-2 px-4"
                                                       value="جزئیات">
                                            </form>
                                        @endif
                                        @if(checkAnyAccessToTemplate('edit ticketType'))
                                            <form action="{{route('ticket-type.edit',$ticketType)}}" method="GET">
                                                <input type="submit" class="btn btn-primary btn-sm ml-2 px-4"
                                                       value="ویرایش">
                                            </form>
                                        @endif
                                        @if(checkAnyAccessToTemplate('delete ticketType'))
                                            <form action="{{route('ticket-type.destroy',$ticketType)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" class="btn btn-danger btn-sm ml-2 px-4"
                                                       value="حذف">
                                            </form>
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
