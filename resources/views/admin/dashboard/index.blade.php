@extends('layouts.admin')

@section('title', 'لوحة التحكم العامة')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">جميع الطلبات (جدول demandes)</div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>الموظف</th>
                            <th>المنحة</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allRequests as $req)
                        <tr>
                            <td>{{ $req->employee->nom_ar }}</td>
                            <td>{{ $req->grant->name }}</td>
                            <td>{{ $req->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">الطلبات المدروسة (جدول traitement)</div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>الطلب</th>
                            <th>القرار</th>
                            <th>بواسطة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allTreatments as $tr)
                        <tr>
                            <td>{{ $tr->request->grant->name }} - {{ $tr->request->employee->nom_ar }}</td>
                            <td>{{ $tr->action }}</td>
                            <td>{{ $tr->user_id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
