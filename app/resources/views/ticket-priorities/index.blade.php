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

        let priorities = [];

        function getSelectedItems(id) {
            if (priorities.indexOf(id) === -1) {
                priorities.push(id);
            } else {
                let index = priorities.indexOf(id);
                if (index !== -1) {
                    priorities.splice(index, 1);
                }
            }
            console.log(priorities);
        }

        function getAllSelectedItems(id) {
            if (priorities.length === 0) {
                priorities = id;
            } else {
                priorities = [];
            }
        }

        function changeStatusOfSelectedPriorities() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('ticket.priority.collective.changeStatus')}}",
                dataType: 'json',
                data: {'data': priorities},
            });

            request.done(function () {
                window.location.reload(true);
            });

            request.fail(function (response) {
                alert("Request failed: " + response.responseText);
            });
        }

        function deleteSelectedPriorities() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('ticket.priority.collective.destruction')}}",
                dataType: 'json',
                data: {'data': priorities},
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
                <h4 class="card-title">اولویت بندی تیکت ها</h4>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary dropdown-toggle sharp" data-toggle="dropdown">عملیات
                    </button>
                    @if(checkAnyAccessToTemplate(['add ticketPriority','delete ticketPriority','edit ticketPriority']))
                        <div class="dropdown-menu">
                            @if(checkAnyAccessToTemplate('add ticketPriority'))
                                <a href="{{route('ticket-priority.create')}}" class="dropdown-item">افزودن</a>
                            @endif
                            @if(checkAnyAccessToTemplate('delete ticketPriority'))
                                <a href="javascript:void(0);" onclick="deleteSelectedPriorities()"
                                   class="dropdown-item">حذف</a>
                            @endif
                            @if(checkAnyAccessToTemplate('edit ticketPriority'))
                                <a href="javascript:void(0);" onclick="changeStatusOfSelectedPriorities()"
                                   @endif
                                   class="dropdown-item">فعال و غیر فعال کردن موجودیت ها</a>
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
                                               onclick="getAllSelectedItems({{$ticketPriorities->pluck('id')}})">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </div>
                            </th>
                            <th>ردیف</th>
                            <th>عنوان</th>
                            <th>توظیحات</th>
                            <th>شماره اولویت</th>
                            <th>وظعیت</th>
                            <th>زمان ساخته شده</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($ticketPriorities as $ticketPriority)
                            <tr>
                                <td>
                                    <div class="checkbox mr-0 align-self-center">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="customCheckBox{{$row}}"
                                                   required="" onclick="getSelectedItems({{$ticketPriority->id}})">
                                            <label class="custom-control-label" for="customCheckBox{{$row}}"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$row++}}</td>
                                <td>{{$ticketPriority->title}}</td>
                                <td>{{$ticketPriority->description}}</td>
                                <td>{{$ticketPriority->number}}</td>
                                <td>@if($ticketPriority->is_active)
                                        <span class="badge badge-rounded badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-rounded badge-danger">غیر فعال</span>
                                    @endif </td>
                                <td>{{\Morilog\Jalali\Jalalian::fromDateTime($ticketPriority->created_at)->format('%A, %d %B %Y')}}</td>
                                <td>
                                    <div class="d-flex">
                                        @if(checkAnyAccessToTemplate('see ticketPriority'))
                                            <form action="{{route('ticket-priority.show',$ticketPriority)}}"
                                                  method="GET">
                                                <input type="submit" class="btn btn-info btn-sm ml-2 px-4"
                                                       value="جزئیات">
                                            </form>
                                        @endif
                                        @if(checkAnyAccessToTemplate('edit ticketPriority'))
                                            <form action="{{route('ticket-priority.edit',$ticketPriority)}}"
                                                  method="GET">
                                                <input type="submit" class="btn btn-primary btn-sm ml-2 px-4"
                                                       value="ویرایش">
                                            </form>
                                        @endif
                                        @if(checkAnyAccessToTemplate('delete ticketPriority'))
                                            <form action="{{route('ticket-priority.destroy',$ticketPriority)}}"
                                                  method="POST">
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
