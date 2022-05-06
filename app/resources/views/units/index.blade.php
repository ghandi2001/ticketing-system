@extends('master.index')

@section('contents')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">بخش بندی تیکت ها</h4>
                <a href="{{route('unit.create')}}" class="btn btn-primary  sharp mr-1">افزودن</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example5" class="table display mb-4 fs-14">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th style="padding: 2vh 15vh">عنوان</th>
                            <th style="padding: 2vh 15vh">توظیحات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($row = 1)
                        @foreach($units as $unit)
                            <tr>
                                <td>{{$row++}}</td>
                                <td style="padding: 2vh 15vh">{{$unit->title}}</td>
                                <td style="padding: 2vh 15vh">{{$unit->description}}</td>
                                <td>
                                    <div class="d-flex">
                                        <form action="{{route('unit.show',$unit)}}" method="GET">
                                            <input type="submit" class="btn btn-info btn-sm ml-2 px-4" value="جزئیات">
                                        </form>
                                        <form action="{{route('unit.edit',$unit)}}" method="GET">
                                            <input type="submit" class="btn btn-primary btn-sm ml-2 px-4"
                                                   value="ویرایش">
                                        </form>
                                        <form action="{{route('unit.destroy',$unit)}}" method="POST">
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
