@extends('layouts.admin1')
  @section('content')
    <div class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              Dashboard
            </div>
            <div class="container-fluid">
              <div class="row mt-2 widgets">
                <div class="col-xl-3 col-sm-6 py-2">
                  <div class="card card-1 text-white h-100">
                    <div style="background-color:rgb(0,200,255);" class="card-body card-1">
                      <div class="rotate">
                        <i class="fa fa-hospital-o" style="font-size:36px;"></i>
                      </div>
                      <h5 class="mb-5">Today Verified Tests</h5>
                      <h3 class="amount-position"> {{ $today }}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                  <div class="card card-1 text-white h-100">
                    <div style="background-color:rgb(50,150,255);" class="card-body card-1">
                      <div class="rotate">
                        <i class="fa fa-user-md" style="font-size:36px;"></i>
                      </div>
                      <h5 class="mb-5">Weekly  Verified Tests</h5>
                      <h3 class="amount-position"> {{ $thisWeekPatient }}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                  <div class="card card-1 text-white h-100">
                    <div  style="background-color:rgb(200,150,255);" class="card-body card-1">
                      <div class="rotate">
                        <i class="fa fa-stethoscope" style="font-size:36px;"></i>
                      </div>
                      <h5 class="mb-5">Monthly Verified Tests </h5>
                      <h3 class="amount-position"> {{ $thisMongthPatient }}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                  <div class="card card-1 text-white h-100">
                    <div  style="background-color:rgb(200,50,90);;" class="card-body card-1">    
                      <div class="rotate">
                        <i class="fa fa-wheelchair" style="font-size:48px;color:red"></i>
                      </div>
                      <h5 class="mb-5">Critical Test Today</h5>
                      <h3>{{ count($criticalTestToday) }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <style>
              * {
                  box-sizing: border-box;
                }

              .row {
                      margin-left:-5px;
                      margin-right:-5px;
                    }
  
              .column {
                        float: left;
                        width: 50%;
                        padding: 5px;
                        }
                        .colum {
                        float: left;
                        width: 100%;
                        padding: 50px;
                        }

                        /* Clearfix (clear floats) */
              .row::after {
                        content: "";
                        clear: both;
                        display: table;
                      }

                table {
                        border-collapse: collapse;
                        border-spacing: 0;
                        width: 100%;
                        border: 1px solid #ddd;
                      }

                th, td {
                        text-align: left;
                        padding: 16px;
                      }

                tr:nth-child(even) {
                        background-color: #f2f2f2;
                      }
            </style>
            <div class="card-body">
              <div class="table-responsive">
                <div class="row">
                  <div class="column">
                    <span style="text-align: left;"><h2>All Tests Performed</h2></span>  
                    <table class="table table-bordered table-striped table-hover datatable datatable-Event">
                      <thead>
                        <tr>
                          <th>Category</th>
                          <th>Test Name</th>
                          <th>Patient Name</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($testPerformeds as $key => $testPerformed)
                          <tr>
                            <td>{{ $testPerformed->Cname ?? '' }}</td>
                            <td>{{ $testPerformed->name ?? '' }}</td>
                            <td>{{ $testPerformed->Pname  ?? '' }}</td>
                            <td>
                            @if (\Carbon\Carbon::now()->timestamp < $testPerformed->timehour + $testPerformed->created_at->timestamp && $testPerformed->Sname =='Verified')
                                <button class="btn btn-xs btn-success">Verified</button>
                              @elseif (\Carbon\Carbon::now()->timestamp < $testPerformed->timehour + $testPerformed->created_at->timestamp )
                                <button class="btn btn-xs btn-info">In Process</button>
                              @elseif ($testPerformed->Sname =='Verified')
                                <button class="btn btn-xs btn-success">Verified</button>
                              @elseif (\Carbon\Carbon::now()->timestamp > $testPerformed->timehour + $testPerformed->created_at->timestamp)
                              <button class="btn btn-xs btn-danger">Delayed</button>
                              @else
                              <button class="btn btn-xs btn-info">Delayed</button>
                            @endif
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable datatable-Event">
                          <span style="text-align: center;"><h2>Top  Tests Today </h2></span>  
                          <thead>
                            <tr>
                              <th>Test Name</th>
                              <th>No Of Tests Today</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($availableTestNameAndCountTests as $key => $availableTestNameAndCountTest)
                              <tr>
                                <td>{{ $availableTestNameAndCountTest->name }}</td>
                                <td>{{ $availableTestNameAndCountTest->test_performed_count }}</td>
                              </tr>
                            @endforeach
                          </tbody> 
                        </table>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="column">
                    <span style="text-align: left;"><h2>Critical Tests Today </h2></span>  
                    <table class="table table-bordered table-striped table-hover datatable datatable-Event">
                      <thead>
                        <tr>
                          <th>Test Name</th>
                          <th>Patient Name</th>
                          <th>Phone Number</th>
                          <th>Date</th>
                        </tr>
                      </thead> 
                      <tbody>
                        @foreach($criticalTestToday as $key => $criticalTestToda)
                          <tr>
                            <td>{{ $criticalTestToda->name ?? '' }}</td>
                            <td>{{ $criticalTestToda->Pname  ?? '' }}</td>
                            <td>{{ $criticalTestToda->phone  ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($criticalTestToda->created_at)->isoFormat('MMM Do YYYY H:m:s')}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
  
                  <div class="">
                    <span style="text-align: center;"><h2>Delayed Tests Today</h2></span>  
                    <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                      <thead>
                        <tr>
                          <th>Test Name</th>
                          <th>Patient Name</th>
                          <th>Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($todayDelayeds as $key => $todayDelayed)
                          <tr>
                            <td>{{ $todayDelayed->availableTest->name ?? '' }}</td>
                            <td>{{ $todayDelayed->patient->Pname  ?? '' }}</td>

                            <td>{{ \Carbon\Carbon::parse($todayDelayed->created_at)->isoFormat('MMM Do YYYY H:m:s')}}</td>
                            <td>
                              @if (\Carbon\Carbon::now()->timestamp < $todayDelayed->availableTest->timehour + $todayDelayed->created_at->timestamp && $todayDelayed->Sname_id =='2')
                                <button class="btn btn-xs btn-success">Verified</button>
                              @elseif (\Carbon\Carbon::now()->timestamp < $todayDelayed->availableTest->timehour + $todayDelayed->created_at->timestamp )
                                <button class="btn btn-xs btn-info">In Process</button>
                              @elseif ($todayDelayed->Sname_id =='2')
                                <button class="btn btn-xs btn-success">Verified</button>
                              @elseif (\Carbon\Carbon::now()->timestamp > $todayDelayed->availableTest->timehour + $todayDelayed->created_at->timestamp)
                              <button class="btn btn-xs btn-danger">Delayed</button>
                              @else
                              <button class="btn btn-xs btn-info">Delayed</button>
                              @endif
                            </td>
                    
                          
                            <td>
                              <a class="btn btn-xs btn-info" href="{{ route('test-performed-edit', $todayDelayed->id) }}">
                              {{ trans('global.edit') }}
                              </a>                
                              <form  method="POST" action="{{ route("performed-test-delete", [$todayDelayed->id]) }}" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"  style="display: inline-block;">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
      let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
      @can('event_delete')
      let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
      let deleteButton = {
      text: deleteButtonTrans,
      url: "{{ route('admin.events.massDestroy') }}",
      className: 'btn-danger',
      action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
  @endcan
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
  })
</script>
@endsection