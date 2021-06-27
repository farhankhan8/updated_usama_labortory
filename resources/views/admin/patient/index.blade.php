@extends('layouts.admin')
    @section('content')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("patient-create") }}">
                Register New Patient
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                List of All Patients
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example"class=" table table-bordered table-striped table-hover datatable datatable-Event">
                        <thead>
                            <tr>
                                <th width="">
                                Check Box
                                </th>
                                <th>
                                Id
                                </th>
                                <th>
                                Patient Name
                                </th>
                                <th>
                                Phone
                                </th>
                                <th>
                                Email
                                </th>
                                <th>
                                Start Time
                                </th>   
                                <th>
                                Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $key => $patient)
                                <tr data-entry-id="{{ $patient->id }}">
                                    <td>
                                    </td>
                                    <td>
                                    {{ $patient->id ?? '' }}
                                    </td>
                                    <td>
                                    {{ $patient->Pname  ?? '' }}
                                    </td>
                                    <td>
                                    {{ $patient->phone ?? '' }}
                                    </td>
                                    <td>
                                    {{ $patient->email ?? '' }}
                                    </td>
                                    <td>
                                    {{ date('d-m-Y H:m:s', strtotime($patient->start_time ?? '')) }}
                                    </td>
                                    <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('patient-show', $patient->id) }}">
                                        {{ trans('global.view') }}
                                    </a>

                                    <a class="btn btn-xs btn-info" href="{{ route('patient-edit', $patient->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form  method="POST" action="{{ route("patient-delete", [$patient->id]) }}" onsubmit="return confirm('{{ trans('Are You Sure to Deleted  ?') }}');"  style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
