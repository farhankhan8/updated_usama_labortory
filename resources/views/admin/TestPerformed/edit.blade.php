@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Edit Test
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("performed-test-update", [$performed->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-row">

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required" for="patient_id">Select Patient Name</label>
                            <select class="form-control" name="patient_id" id="patient_id" required>
                                @foreach($patientNames as $id => $patientName)
                                    <option value="{{ $id }}" {{ $performed->patient_id == $id ? 'selected' : '' }}>{{ $patientName }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('patient_id '))
                                <div class="invalid-feedback">
                                    {{ $errors->first('patient_id ') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>


                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required" for="available_test_id">Select Name</label>
                            <select onchange="set_test_form()" class="form-control" name="available_test_id" id="available_test_id" required>
                                @foreach($getNameFromAvailbles as $id => $getNameFromAvailble)
                                    <option value="{{ $id }}" {{ $performed->available_test_id   == $id ? 'selected' : '' }}>{{ $getNameFromAvailble }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('available_test_id '))
                                <div class="invalid-feedback">
                                    {{ $errors->first('available_test_id ') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required" for="Sname_id ">Select Status</label>
                            <select class="form-control" name="Sname_id" id="Sname_id" required>

                                @foreach($books as $id => $book)
                                    <option value="{{ $id }}" {{ $performed->Sname_id == $id ? 'selected' : '' }}>{{ $book }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('Sname_id '))
                                <div class="invalid-feedback">
                                    {{ $errors->first('Sname_id ') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <p class="required">Test Type</p>
                            <label for="urgent">Urgent</label>
                            <input type="radio" name="type" id="urgent" required {{$performed->type=="urgent" ? "checked":""}} value="urgent">
                            <label for="standard">Standard</label>
                            <input type="radio" name="type" id="standard" required {{$performed->type=="standard" ? "checked":""}} value="standard">
                        </div>
                    </div>


                    <div id="test_form" class="row col-md-12 mb-12">
                        @foreach($allAvailableTests as $test)

{{--                            @dd($performed->testReport->pluck("id")->all())--}}
{{--                            @dd($performed->availableTest)--}}
{{--                            @dd($performed->testReport)--}}



                            <div class="form-row col-md-12" id="test{{$test->id}}" class="tests">
                                <div class="col-md-12"><h4>{{$test->name}}</h4></div>
                                @if($performed->availableTest->id==$test->id)
                                    @php  $foreach_variable=$test->TestReportItems->whereIn("id",$performed->testReport->pluck("test_report_item_id")->all()); @endphp
                                @else
                                    @php  $foreach_variable=$test->TestReportItems->where("status","active"); @endphp
                                @endif




                                @foreach($foreach_variable as $report_item)
{{--                                    @if($performed->availableTest->id==$test->id)--}}
{{--                                    @dd($performed->testReport->where("test_report_item_id",$report_item->id)->first())--}}
{{--                                    @endif--}}

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="required text-capitalize" for="testResult{{$report_item->id}}">{{$report_item->title}} ({{$report_item->initialNormalValue}}{{$report_item->unit}} - {{$report_item->finalNormalValue}}{{$report_item->unit}})</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend">{{$report_item->unit}}</span>
                                                </div>
                                                <input class="form-control" type="number" name="testResult{{$report_item->id}}" id="testResult{{$report_item->id}}" value="{{$performed->availableTest->id==$test->id ? $performed->testReport->where("test_report_item_id",$report_item->id)->first()->value:""}}" required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <script> var test{{$test->id}}= document.getElementById("test{{$test->id}}").outerHTML;
                                document.getElementById("test{{$test->id}}").outerHTML = "";
                            </script>
                    </div>
                    @endforeach


                    <div class="col-md-12 mb-12 text-right">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>


                </div>


            </form>


            <script>
                function set_test_form() {
                    if (document.getElementById("available_test_id").value)
                        document.getElementById("test_form").innerHTML = eval("test" + document.getElementById("available_test_id").value);
                    else
                        document.getElementById("test_form").innerHTML = "";
                }

                set_test_form();
            </script>

@endsection