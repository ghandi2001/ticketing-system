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

        let units = [];

        function getSelectedItems(id) {
            if (units.indexOf(id) === -1) {
                units.push(id);
            } else {
                let index = units.indexOf(id);
                if (index !== -1) {
                    units.splice(index, 1);
                }
            }
            console.log(units);
        }

        function getAllSelectedItems(id) {
            if (units.length === 0) {
                units = id;
            } else {
                units = [];
            }
        }

        function changeStatusOfSelectedUnits() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('unit.collective.changeStatus')}}",
                dataType: 'json',
                data: {'data': units},
            });

            request.done(function () {
                window.location.reload(true);
            });

            request.fail(function (response) {
                alert("Request failed: " + response.responseText);
            });
        }

        function deleteSelectedUnits() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('unit.collective.destruction')}}",
                dataType: 'json',
                data: {'data': units},
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
                <h4 class="card-title">بخش بندی تیکت ها</h4>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary dropdown-toggle sharp" data-toggle="dropdown">عملیات
                    </button>
                    @if(checkAnyAccessToTemplate(['add unit','delete unit','edit unit']))
                        <div class="dropdown-menu">
                            @if(checkAnyAccessToTemplate('add unit'))
                                <a href="{{route('unit.create')}}" class="dropdown-item">افزودن</a>
                            @endif
                            @if(checkAnyAccessToTemplate('delete unit'))
                                <a href="javascript:void(0);" onclick="deleteSelectedUnits()"
                                   class="dropdown-item">حذف</a>
                            @endif
                            @if(checkAnyAccessToTemplate('edit unit'))
                                <a href="javascript:void(0);" onclick="changeStatusOfSelectedUnits()"
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
                                               onclick="getAllSelectedItems({{$units->pluck('id')}})">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </div>
                            </th>
                            <th>ردیف</th>
                            <th>عنوان</th>
                            <th>توظیحات</th>
                            <th>اولویت</th>
                            <th>وظعیت</th>
                            <th>زمان ساخته شده</th>
                        </tr>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($units as $unit)
                            <tr>
                                <td>
                                    <div class="checkbox mr-0 align-self-center">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="customCheckBox{{$row}}"
                                                   required="" onclick="getSelectedItems({{$unit->id}})">
                                            <label class="custom-control-label" for="customCheckBox{{$row}}"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$row++}}</td>
                                <td>{{$unit->title}}</td>
                                <td>{{$unit->description}}</td>
                                <td>{{$unit->ticketPriority->title}}</td>
                                <td>@if($unit->is_active)
                                        <span class="badge badge-rounded badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-rounded badge-danger">غیر فعال</span>
                                    @endif </td>
                                <td>{{\Morilog\Jalali\Jalalian::fromDateTime($unit->created_at)->format('%A, %d %B %Y')}}</td>
                                <td>
                                    <div class="d-flex">
                                        @if(checkAnyAccessToTemplate('see unit'))
                                            <form action="{{route('unit.show',$unit)}}" method="GET">
                                                <input type="submit" class="btn btn-info btn-sm ml-2 px-4"
                                                       value="جزئیات">
                                            </form>
                                        @endif
                                        @if(checkAnyAccessToTemplate('edit unit'))
                                            <form action="{{route('unit.edit',$unit)}}" method="GET">
                                                <input type="submit" class="btn btn-primary btn-sm ml-2 px-4"
                                                       value="ویرایش">
                                            </form>
                                        @endif
                                        @if(checkAnyAccessToTemplate('delete unit'))
                                            <form action="{{route('unit.destroy',$unit)}}" method="POST">
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
