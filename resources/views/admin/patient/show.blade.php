@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header"> 
            Patients Detail
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <b> <label for="user_id">Patient Name</label></b>
                        <p>{{ $patient->Pname ?? '' }}</p>
                    </div>
                    <div class="col">
                        <b> <label for="user_id">Phone</label></b>
                        <p>{{ $patient->phone ?? '' }}</p>
                    </div>
                    <div class="col">
                        <b> <label for="user_id">Email</label></b>
                        <p>{{ $patient->email ?? '' }}</p>
                    </div>
                    <div class="col">
                        <b> <label for="user_id">Register Date</label></b>
                        <p>{{ date('d-m-Y H:m:s', strtotime($patient->start_time ?? '')) }}</p>
                    </div>
                    <div class="col">
                        <b> <label for="user_id">Birthday </label></b>
                        <p>{{ date('d-m-Y', strtotime($patient->dob ?? '')) }}</p>
                    </div>
                    <!-- <div class="col">
                        <b> <label for="user_id">Tests Performed</label></b>
                        <p>{{ $tests ?? '' }}</p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Tests Performed By <span>{{ $patient->Pname ?? '' }}</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Test Category
                        </th>

                        <th>
                            Test Name
                        </th>
                        <!-- <th>
                            Result
                        </th> -->
                        <!-- <th>
                            Range
                        </th> -->
                        <th>
                            Date
                        </th>
                        <th>Charged Amount</th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allTests as $key => $test)
                        <tr>
                            <td id="{{$test->id}}">

                            </td>
                            <td>
                                {{ $test->Cname  ?? '' }}
                            </td>
                            <td>
                                {{ $test->name  ?? '' }}
                            </td>
                            <td>
                            {{ date('d-m-Y H:m:s', strtotime($test->created_at ?? '')) }}
                            </td>
                            <td>
                            {{ $test->fee}}
                            </td>
                            <td>
                                @if (\Carbon\Carbon::now()->timestamp < $test->timehour + $test->created_at->timestamp && $test->Sname =='Verified')
                                    <button class="btn btn-xs btn-success">Verified</button>
                                    @elseif (\Carbon\Carbon::now()->timestamp < $test->timehour + $test->created_at->timestamp )
                                    <button class="btn btn-xs btn-info">In Process</button>
                                    @elseif ($test->Sname =='Verified')
                                    <button class="btn btn-xs btn-success">Verified</button>
                                    @elseif (\Carbon\Carbon::now()->timestamp > $test->timehour + $test->created_at->timestamp)
                                    <button class="btn btn-xs btn-danger">Delayed</button>
                                    @else
                                    <button class="btn btn-xs btn-info">Delayed</button>
                                @endif


                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('test-performed-show', $test->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('test-performed-edit', $test->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form method="POST" action="{{ route("performed-test-delete", [$test->id]) }}" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <form class="d-none" id="report" method="post" action="{{route("patient-view-multiple-report")}}">
                    @csrf
                    <div id="form_block">

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
                    {{--@can('event_delete')--}}
                    {{--  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';--}}
            let reportBtn = {
                    text: "Report",
                    url: "{{ route('patient-view-multiple-report') }}",
                    className: 'btn-primary',
                    action: function (e, dt, node, config) {
                        document.getElementById("form_block").innerHTML = "";
                        var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {

                            $(document.getElementById("form_block")).append("<input type=\"text\" name=\"report_ids[]\" value=\"" + $(entry)[0].cells[0].id + "\">");
                            return $(entry)[0].cells[0].id;
                        });

                        if (ids.length === 0) {
                            alert('No record selected');
                            return
                        }
                        document.getElementById("report").submit();
                    }
                };
            dtButtons.push(reportBtn);
            {{--@endcan--}}

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 100,
            });
            $('.datatable-Event:not(.ajaxTable)').DataTable({buttons: dtButtons});
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection