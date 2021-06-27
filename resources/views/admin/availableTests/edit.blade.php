@extends('layouts.admin')
@section('content')
    <style>
        hr {
            border-top: 1px solid rgb(47 53 58);
        }
    </style>
    <div class="card">
        <div class="card-header">
            Edit Test
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("availabel-tests-update", [$availableTest->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-row">
                    <div class="col-md-12 mb-12"><h4>Basic</h4></div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="category_id ">Test Category</label>
                            <select class="form-control" name="category_id" id="category_id" required>
                                @foreach($catagorys as $id => $catagory)
                                    <option value="{{ $id }}" {{ $availableTest->category_id  == $id ? 'selected' : '' }}>{{ $catagory }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category_id') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="name">Test Name</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $availableTest->name) }}" required>
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

                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label for="testFee">Test Fee</label>
                            <input class="form-control {{ $errors->has('testFee') ? 'is-invalid' : '' }}" type="number" name="testFee" id="testFee" value="{{ old('testFee', $availableTest->testFee) }}" step="1">
                            @if($errors->has('testFee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('testFee') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label for="urgentFee">Urgent Fee</label>
                            <input class="form-control {{ $errors->has('urgentFee') ? 'is-invalid' : '' }}" type="number" name="urgentFee" id="urgentFee" value="{{ $availableTest->urgentFee }}" step="1">
                            @if($errors->has('urgentFee'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('urgentFee') }}
                                </div>
                            @endif
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-12"><h4>Report Items</h4></div>
                    <div class="col-md-12" id="report_item_form">
                        @php $y=1; @endphp
                        @foreach($availableTest->TestReportItems->where("status","active") as $TestReportItem)
                            <div class="col-md-12 report_item_class" >
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="" for="title">Title</label>
                                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title[]" id="title" value="{{$TestReportItem->title}}" required>
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

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="units">Test Unit</label>
                                            <input class="form-control {{ $errors->has('units') ? 'is-invalid' : '' }}" type="text" name="units[]" id="units" value="{{ $TestReportItem->unit }}">
                                            @if($errors->has('units'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('units') }}
                                                </div>
                                            @endif
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="firstCriticalValue">First Critical Range</label>
                                            <input class="form-control {{ $errors->has('firstCriticalValue') ? 'is-invalid' : '' }}" type="number" name="firstCriticalValue[]" id="firstCriticalValue" value="{{ $TestReportItem->firstCriticalValue}}" step="0.01">
                                            @if($errors->has('firstCriticalValue'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('firstCriticalValue') }}
                                                </div>
                                            @endif
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="finalCriticalValue">Final Critical Range</label>
                                            <input class="form-control {{ $errors->has('finalCriticalValue') ? 'is-invalid' : '' }}" type="number" name="finalCriticalValue[]" id="finalCriticalValue" value="{{ $TestReportItem->finalCriticalValue }}" step="1">
                                            @if($errors->has('finalCriticalValue'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('finalCriticalValue') }}
                                                </div>
                                            @endif
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label for="normalRange">Final Critical Range</label>
                                            <textarea class="form-control {{ $errors->has('normalRange') ? 'is-invalid' : '' }}" type="number" name="normalRange" id="normalRange">{{ $TestReportItem->normalRange }}</textarea>
                                            @if($errors->has('normalRange'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('normalRange') }}
                                                </div>
                                            @endif
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            @php $y++; @endphp
                        @endforeach
                    </div>

                    <div class="col-md-12 text-center">
                        <button type="button" onclick="add_item()" class="btn btn-xs btn-success">Add Item</button>
                        <button type="button" onclick="remove_item()" class="btn btn-xs btn-danger">Remove Item</button>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col-md-12 mb-12"><h4>Inventory</h4></div>
                    <div class="row col-md-12" id="inventory_item_form">
                        @php $x=1; @endphp
                        @foreach($availableTest->available_test_inventories as $available_test_inventory)
                            <div class="col-md-12 inventory_item_class">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label>Inventory Item</label>
                                        <select class="form-control  {{ $errors->has('inventory_id') ? 'is-invalid' : '' }}" name="inventory_ids[]" required>
                                            @foreach($inventoryes as $key=>$value)
                                                <option value="{{ $key }}" {{ $available_test_inventory->inventory_id==$key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="inventory_quantity{{$x}}">Quantity</label>
                                        <input class="form-control {{ $errors->has('inventory_quantity') ? 'is-invalid' : '' }}" type="number" name="inventory_quantity[]" id="inventory_quantity{{$x}}" value="{{$available_test_inventory->itemUsed}}" step="1" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                            @php $x++; @endphp
                        @endforeach

                    </div>
                    <div class="col-md-12 text-center">
                        <button type="button" onclick="add_inventory()" class="btn btn-xs btn-success">Add Inventory</button>
                        <button type="button" onclick="remove_inventory()" class="btn btn-xs btn-danger">Remove Inventory</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label" for="invalidCheck3">
                        </label>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

        </div>
    </div>

    <script>
        var items = {{count($availableTest->TestReportItems->where("status","active"))}},
            item_block = 0, inventory_block = 0,
            inventories = {{count($availableTest->available_test_inventories)}};

        function add_item() {
            if (!item_block) {
                item_block = document.getElementsByClassName("report_item_class")[0].outerHTML;
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
                inventory_block =document.getElementsByClassName("inventory_item_class")[0].outerHTML;
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
    </script>
@endsection