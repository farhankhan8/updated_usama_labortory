@extends('layouts.admin')
@section('content')
    <style>
        hr {
            border-top: 1px solid rgb(47 53 58);
        }
        .hr1 {
            border-top: 1px dashed #777;
        }
    </style>
    <div class="card">
        <div class="card-header">
            Create New Test
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("availale-tests-store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mb-12"><h4>Basic</h4></div>
                    <div class="col-md-3 mb-3">
                        <label for="validationCustom01">Test Category</label>
                        <select class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                            @foreach($categoryNames as $id => $categoryName)
                                <option value="{{ $id }}">{{ $categoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="" for="name">Test Name</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="timehour">Completed time</label>
                        <div class="input-group">
                            <input type="text" name="timehour" class="form-control" id="duration"> 
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationCustomUsername">Standard Charges</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">Rs</span>
                            </div>
                            <input class="form-control {{ $errors->has('testFee') ? 'is-invalid' : '' }}" type="number" name="testFee" id="testFee" value="{{ old('testFee', '') }}" step="1" required>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="urgentFee">Urgent Charges</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="urgentFee">Rs</span>
                            </div>
                            <input class="form-control {{ $errors->has('urgentFee') ? 'is-invalid' : '' }}" type="number" name="urgentFee" id="urgentFee" value="{{ old('urgentFee', '') }}" step="1" required>
                        </div>
                    </div>
          

                </div>
                <hr class="hr1">

                <div class="form-row">
                    <div class="col-md-12 mb-12"><h4>Result Values</h4></div>
                    <div class="col-md-12" id="report_item_form">
                        <div class="form-row report_item_class">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="" for="title">Title</label>
                                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title[]" id="title" value="{{ old('title[]', '') }}" required>
                                    @if($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                    <span class="help-block"></span>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <!-- <div class="col-md-4 mb-3">
                                <label for="validationCustom03">First Normal Range</label>
                                <input class="form-control {{ $errors->has('initialNormalValue') ? 'is-invalid' : '' }}" type="number" name="initialNormalValue[]" id="initialNormalValue" value="{{ old('initialNormalValue[]', '') }}" step="1" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom04">Final Normal Range</label>
                                <input class="form-control {{ $errors->has('finalNormalValue') ? 'is-invalid' : '' }}" type="number" name="finalNormalValue[]" id="finalNormalValue" value="{{ old('finalNormalValue[]', '') }}" step="1" required>
                            </div> -->

                            <div class="col-md-4 mb-3">
                                <label for="validationCustom05">Test Unit</label>
                                <input class="form-control {{ $errors->has('units') ? 'is-invalid' : '' }}" type="text" name="units[]" id="units" value="{{ old('units[]', '') }}" required>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="validationCustom05">First Critical Value</label>
                                <input class="form-control {{ $errors->has('firstCriticalValue') ? 'is-invalid' : '' }}" type="number" name="firstCriticalValue[]" id="firstCriticalValue" value="{{ old('firstCriticalValue[]', '') }}" step="1" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="validationCustom05">Final Critical Value</label>
                                <input class="form-control {{ $errors->has('finalCriticalValue') ? 'is-invalid' : '' }}" type="number" name="finalCriticalValue[]" id="finalCriticalValue" value="{{ old('finalCriticalValue[]', '') }}" step="1" required>
                            </div>
                            <div class="col-md-12 mb-0">
                                <div class="form-group">
                                    <label for="validationCustom05">Normal Range</label>
                                    <textarea class="form-control {{ $errors->has('normalRange') ? 'is-invalid' : '' }}" id="normalRange" name="normalRange[]"rows="0"placeholder="Enter Normal Range of Test As This Format 60-120"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="hr1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                                <button type="button" onclick="add_item()" class="btn btn-xs btn-success">Add Item</button>
                                <button type="button" onclick="remove_item()" class="btn btn-xs btn-danger">Remove Item</button>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="col-md-12 mb-12"><h4>Inventory</h4></div>
                    <div class="col-md-12" id="inventory_item_form">
                        <div class="form-row inventory_item_class">
                            <div class="col-md-6 mb-6">
                                <label for="inventory_id">Inventory Item</label>
                                <select class="form-control  {{ $errors->has('inventory_id') ? 'is-invalid' : '' }}" name="inventory_ids[]" id="inventory_id" required>
                                    @foreach($inventoryes as $key=>$value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-6">
                                <label for="inventory_quantity">Quantity</label>
                                <input class="form-control {{ $errors->has('inventory_quantity') ? 'is-invalid' : '' }}" type="number" name="inventory_quantity[]" id="inventory_quantity" value="" step="1" required>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                        
                         
                            <hr class="hr1">
                        
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="button" onclick="add_inventory()" class="btn btn-xs btn-success">Add Inventory</button>
                        <button type="button" onclick="remove_inventory()" class="btn btn-xs btn-danger">Remove Inventory</button>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script>
        var items = 1, item_block = 0,inventories=1,inventory_block=0;

        function add_item() {
            if (!item_block) {
                item_block = document.getElementById("report_item_form").innerHTML;
            }
            if (items >= 1) {
                $("#report_item_form").append(item_block);
                items++;
            }
        }

        function remove_item() {
            if (items > 1) {
                var index_remove = document.getElementsByClassName("report_item_class").length - 1;
                document.getElementsByClassName("report_item_class")[index_remove].outerHTML = "";
                items--;
            }
        }

        function add_inventory() {
            if (!inventory_block) {
                inventory_block = document.getElementById("inventory_item_form").innerHTML;
            }
            if (inventories >= 1) {
                $("#inventory_item_form").append(inventory_block);
                inventories++;
            }
        }

        function remove_inventory() {
            if (inventories > 1) {
                var index_remove = document.getElementsByClassName("inventory_item_class").length - 1;
                document.getElementsByClassName("inventory_item_class")[index_remove].outerHTML = "";
                inventories--;
            }
        }

        $('#duration').durationPicker({
        lang: 'en',
        formatter: function (s) {
        return s;
        },
        showSeconds: false
        });
        var langs = {
        en: {
        day: 'day',
        hour: 'hour',
        minute: 'minute',
        second: 'second',
        days: 'days',
        hours: 'hours',
        minutes: 'minutes',
        seconds: 'seconds'
        }
        };
    </script>
@endsection