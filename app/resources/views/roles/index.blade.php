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

        let roles = [];

        function getSelectedItems(id) {
            if (roles.indexOf(id) === -1) {
                roles.push(id);
            } else {
                let index = roles.indexOf(id);
                if (index !== -1) {
                    roles.splice(index, 1);
                }
            }
            console.log(roles);
        }

        function getAllSelectedItems(id) {
            if (roles.length === 0) {
                roles = id;
            } else {
                roles = [];
            }
        }


        function deleteSelectedRoles() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('role.collective.destruction')}}",
                dataType: 'json',
                data: {'data': roles},
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
                    @if(checkAnyAccessToTemplate(['add role','delete role']))
                        <div class="dropdown-menu">
                            @if(checkAnyAccessToTemplate('add role'))
                                <a href="{{route('role.create')}}" class="dropdown-item">افزودن</a>
                            @endif
                            @if(checkAnyAccessToTemplate('delete role'))
                                <a href="javascript:void(0);" onclick="deleteSelectedRoles()"
                                   class="dropdown-item">حذف</a>
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
                                               onclick="getAllSelectedItems({{$roles->pluck('id')}})">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </div>
                            </th>
                            <th>ردیف</th>
                            <th>عنوان</th>
                            <th>زمان ساخته شده</th>
                            <th>زمان بروز شده</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    <div class="checkbox mr-0 align-self-center">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="customCheckBox{{$row}}"
                                                   required="" onclick="getSelectedItems({{$role->id}})">
                                            <label class="custom-control-label" for="customCheckBox{{$row}}"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$row++}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::fromDateTime($role->created_at)->format('%A, %d %B %Y')}}</td>
                                <td>{{\Morilog\Jalali\Jalalian::fromDateTime($role->updated_at)->format('%A, %d %B %Y')}}</td>
                                <td>
                                    <div class="d-flex">
                                        @if(checkAnyAccessToTemplate('show rolePermissions'))
                                            <form action="{{route('role.show',$role)}}" method="GET">
                                                <input type="submit" class="btn btn-info btn-sm ml-2 px-4"
                                                       value="دسترسی ها">
                                            </form>
                                        @endif
                                        @if(checkAnyAccessToTemplate('delete role'))
                                            <form action="{{route('role.destroy',$role)}}"
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
