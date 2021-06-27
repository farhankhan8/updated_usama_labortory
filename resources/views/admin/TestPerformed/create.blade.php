@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Performed New Test
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("test-performed") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label class="required" for="patient_id">Select Patient Name</label>
                            <select class="form-control select2 {{ $errors->has('patients') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                                @foreach($patientNames as $id => $patientName)
                                    <option value="{{ $id }}">{{ $patientName }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                </div>

                <div class="col-md-12" id="test_block">
                    <div class="form-row test_form_div">

                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="required">Select Test Name</label>
                                <select onchange="set_test_form(this)" class="form-control  {{ $errors->has('available_tests') ? 'is-invalid' : '' }}" name="available_test_id[]" required>
                                    @foreach($availableTests as $id => $availableTest)
                                        <option value="{{ $id }}">{{ $availableTest }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('available_tests'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('available_tests') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label class="required">Select Status</label>
                                <select class="form-control  {{ $errors->has('Sname_id') ? 'is-invalid' : '' }}" name="Sname_id[]" required>
                                    @foreach($stat as $id => $sta)
                                        <option value="{{ $id }}">{{ $sta }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('Sname_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('Sname_id') }}
                                    </div>
                                @endif
                                <span class="help-block"></span>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label class="required text-capitalize" for="fee_final">Charged Fee</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">Rs.</span>
                                    </div>
                                    <input class="form-control" type="number" name="fee_final[]" id="fee_final" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <div class="form-group">
                                <label class="required">Test Type</label>
                                <select class="form-control" name="type[]">
                                    <option value="urgent">Urgent<p class="urgent_fee"></p></option>
                                    <option value="standard">Standard<p class="standard_fee"></p></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 test_form">
                            @foreach($allAvailableTests as $test)

                                <div class="form-row col-md-12" id="test{{$test->id}}" class="tests">
                                    <div class="col-md-12"><h4>{{$test->name}}</h4></div>
                                    @foreach($test->TestReportItems->where("status","active") as $report_item)
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label class="required text-capitalize">{{$report_item->title}} ({{$report_item->normalRange}}){{$report_item->unit}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">{{$report_item->unit}}</span>
                                                    </div>
                                                    <input class="form-control" type="number" name="testResult{{$report_item->id}}[]" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <script>
                                    var test{{$test->id}}= document.getElementById("test{{$test->id}}").outerHTML;
                                    document.getElementById("test{{$test->id}}").outerHTML = "";
                                    var test{{$test->id}}_standard ={{$test->testFee}};
                                    var test{{$test->id}}_urgent ={{$test->urgentFee}};
                                </script>
                            @endforeach
                        </div>

                        <div class="form-group shadow-textarea col-md-12">
                            <label >Comment</label>
                            <textarea class="form-control z-depth-1" name="comments[]" rows="3" placeholder="Write comments  here..."></textarea>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p onclick="add_report()" class="btn btn-success">Add Report</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        var select_active = "";

        function set_test_form(select) {
            select_active = select;
            console.log(select);

            if (select.value) {
                select.parentElement.parentElement.parentNode.getElementsByClassName("test_form")[0].innerHTML = eval("test" + select.value);
                select.parentElement.parentElement.parentNode.getElementsByTagName("select")[2].getElementsByTagName("option")[0].innerText="Urgent"+"(" + eval("test" + select.value + "_urgent") + ")";
                select.parentElement.parentElement.parentNode.getElementsByTagName("select")[2].getElementsByTagName("option")[1].innerText="Standard"+"(" + eval("test" + select.value + "_standard") + ")";
            } else {
                select.parentElement.parentElement.parentNode.getElementsByClassName("test_form")[0].innerHTML = "";
                select.parentElement.parentElement.parentNode.getElementsByClassName("urgent_fee")[0].innerText = "";
                select.parentElement.parentElement.parentNode.getElementsByClassName("standard_fee")[0].innerText = "";
            }
        }

        function add_report() {
            document.getElementById("test_block").insertAdjacentHTML( 'beforeend', document.getElementById("test_block").getElementsByClassName("test_form_div")[0].outerHTML );
        }
    </script>
@endsection