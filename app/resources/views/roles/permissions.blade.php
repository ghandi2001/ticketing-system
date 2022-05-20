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

        function editPermission(permissionName) {
            let request = $.ajax({
                type: "POST",
                url: "{{route('role.edit.permissions',$role)}}",
                dataType: 'json',
                data: {"data": permissionName},
            });

            request.done(function () {
                window.location.reload(true);
            });

            request.fail(function (response) {
                alert("Request failed: " + response.responseText);
                window.location.reload(true);
            });
        }

    </script>
@endsection

@section('contents')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> نقش : {{$role->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php($row=1)
                            @foreach($permissions as $permission)
                                <div class="col-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input"
                                               id="priorityCheckBox{{$row}}"
                                               value="{{$permission->name}}"
                                               @if($role->hasPermissionTo($permission->name)) checked @endif
                                               onchange="editPermission(this.value)">
                                        <label class="custom-control-label"
                                               for="priorityCheckBox{{$row++}}">{{__('permissions.'.$permission->name)}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
