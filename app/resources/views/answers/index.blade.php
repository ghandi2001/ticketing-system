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

        let readyAnswers = [];

        function getSelectedItems(id) {
            if (readyAnswers.indexOf(id) === -1) {
                readyAnswers.push(id);
            } else {
                let index = readyAnswers.indexOf(id);
                if (index !== -1) {
                    readyAnswers.splice(index, 1);
                }
            }
            console.log(readyAnswers);
        }

        function getAllSelectedItems(id) {
            if (readyAnswers.length === 0) {
                readyAnswers = id;
            } else {
                readyAnswers = [];
            }
        }

        function changeStatusOfSelectedReadyAnswers() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('answer.collective.changeStatus')}}",
                dataType: 'json',
                data: {'data': readyAnswers},
            });

            request.done(function () {
                window.location.reload(true);
            });

            request.fail(function (response) {
                alert("Request failed: " + response.responseText);
            });
        }

        function deleteSelectedReadyAnswers() {
            let request = $.ajax({
                type: "POST",
                url: "{{route('answer.collective.destruction')}}",
                dataType: 'json',
                data: {'data': readyAnswers},
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
                <h4 class="card-title">جواب های اماده برای تیکت ها</h4>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary dropdown-toggle sharp" data-toggle="dropdown">عملیات
                    </button>
                    <div class="dropdown-menu">
                        <a href="{{route('answer.create')}}" class="dropdown-item">افزودن</a>
                        <a href="javascript:void(0);" onclick="deleteSelectedReadyAnswers()" class="dropdown-item">حذف</a>
                        <a href="javascript:void(0);" onclick="changeStatusOfSelectedReadyAnswers()"
                           class="dropdown-item">فعال و غیر فعال کردن موجودیت ها</a>
                    </div>
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
                                               onclick="getAllSelectedItems({{$answers->pluck('id')}})">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </div>
                            </th>
                            <th>ردیف</th>
                            <th>جواب</th>
                            <th>وظعیت</th>
                            <th>زمان ساخته شده</th>
                            <th style="padding: 2vh 15vh">ساخته شده توسط</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($answers as $answer)
                            <tr>
                                <td>
                                    <div class="checkbox mr-0 align-self-center">
                                        <div class="custom-control custom-checkbox ">
                                            <input type="checkbox" class="custom-control-input"
                                                   id="customCheckBox{{$row}}"
                                                   required="" onclick="getSelectedItems({{$answer->id}})">
                                            <label class="custom-control-label" for="customCheckBox{{$row}}"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$row++}}</td>
                                <td>{{$answer->answer}}</td>
                                <td>@if($answer->is_active)
                                        <span class="badge badge-rounded badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-rounded badge-danger">غیر فعال</span>
                                    @endif </td>
                                <td>{{\Morilog\Jalali\Jalalian::fromDateTime($answer->created_at)->format('%A, %d %B %Y')}}</td>
                                <td  style="padding: 2vh 15vh"></td>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{route('answer.relations.view',$answer)}}" method="GET">
                                            <input type="submit" class="btn btn-success btn-sm ml-2 px-4"
                                                   value="ارتباط ها">
                                        </form>
                                        <form action="{{route('answer.show',$answer)}}" method="GET">
                                            <input type="submit" class="btn btn-info btn-sm ml-2 px-4" value="جزئیات">
                                        </form>
                                        <form action="{{route('answer.edit',$answer)}}" method="GET">
                                            <input type="submit" class="btn btn-primary btn-sm ml-2 px-4"
                                                   value="ویرایش">
                                        </form>
                                        <form action="{{route('answer.destroy',$answer)}}"
                                              method="POST">
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

@section('outrow-contents')
@endsection

