<div class="card-body">
    <div class="col-md-9"><h3>{{ $testPerformedsId->availableTest->category->Cname }}</h3></div>
    <div class="col-md-9"><h4>{{ $testPerformedsId->availableTest->name }}</h4></div>
    <div class="card-body">
        <hr>
        <div class="table-responsive dont-break-inside">
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th style="background-color:gray;">Test</th>
                    <th style="background-color:gray;">Unit</th>
                    <th style="background-color:gray;">Result</th>
                    <th style="background-color:gray;">REFERENCE RANGE</th>
                    @php $x=1; @endphp
                    @foreach($getpatient->testPerformed->where("available_test_id",$testPerformedsId->availableTest->id)->where("id","<",$testPerformedsId->id)->sortByDesc('created_at')->take(2) as $old_test)
                        <th style="background-color:gray;">History {{$x}}</th>
                        @php $x++; @endphp
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($testPerformedsId->testReport as $testReport)
                    <tr>
                        <td class="text-capitalize">{{$testReport->report_item->title}}</td>
                        <td class="">{{$testReport->report_item->unit}}</td>
                        <td>{{ $testReport->value }}</td>
                        <td>({{$testReport->report_item->normalRange}}){{$testReport->report_item->unit}}</td>
                        @foreach($getpatient->testPerformed->where("available_test_id",$testPerformedsId->availableTest->id)->where("id","<",$testPerformedsId->id)->sortByDesc('created_at')->take(2) as $old_test)
                            <td>{{ $old_test->testReport->where("test_report_item_id",$testReport->test_report_item_id)->first()->value }}&nbsp<span class="text-black-50"></span>({{ date('d-m-Y H:m:s', strtotime($old_test->created_at)) }})</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
            <div class="col-md-9"><h4>Dr Comments </h4></div>
            <div class="col-md-9"><h6>{{ $testPerformedsId->comments }}</h6></div>

        </div>
    </div>
</div>
