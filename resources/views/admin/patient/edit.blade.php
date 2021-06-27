@extends('layouts.admin')
    @section('content')
    <div class="card">
        <div class="card-header">
            Edit Patient
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("patient-update", [$patients->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
             <div class="form-row">
                <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label  for="Pname">Patient Name</label>
                    <input class="form-control {{ $errors->has('Pname') ? 'is-invalid' : '' }}" type="text" name="Pname" id="Pname" value="{{ old('Pname', $patients->Pname) }}" required>
                    @if($errors->has('Pname'))
                        <div class="invalid-feedback">
                            {{ $errors->first('Pname') }}
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
                <label for="email">Email</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="email" name="email" id="name" value="{{ old('email', $patients->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
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
                <label for="phone">Phone</label>
                <input class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}" type="number" name="phone" id="phone" value="{{ old('phone', $patients->phone) }}" step="1">
                @if($errors->has('capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('capacity') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
        </div>
    </div>
    </div>


    <div class="card-body">
        <div class="form-row">
        <div class="col-md-4 mb-3">
        <div class="form-group">
            <label  for="start_time">Register Date</label>
            <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('phone', $patients->start_time) }}" required>
            @if($errors->has('start_time'))
                <div class="invalid-feedback">
                    {{ $errors->first('start_time') }}
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
            <label for="dob">Birthday</label>
            <input class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="date" name="dob" id="dob" value="{{ old('phone', $patients->dob) }}" required>
            @if($errors->has('dob'))
                <div class="invalid-feedback">
                    {{ $errors->first('dob') }}
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
                <label class="required" for="catagory">Select Patient Name</label>
                <select class="form-control"  name="catagory" id="catagory" required>
                    @foreach($patientCategorys as $id => $patientCategory)
                        <option value="{{ $id }}" {{ $patients->catagory == $id ? 'selected' : '' }}>{{ $patientCategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('catagory '))
                    <div class="invalid-feedback">
                        {{ $errors->first('catagory ') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

    <div class="card-body">
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <div class="form-group">
                                    <label for="gend" class= "col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" type="radio" name="gend" value="male" {{ $patients->gend == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gend" value="female" {{ $patients->gend == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>

                    </div>
                </div>

    <div class="card-body">
        <div class="form-row">
            <div class="col-md-4 mb-3">
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </div>
    </div>
    <div class="valid-feedback">
    Looks good!
    </div>
    </div>     
    </form>
    </div>
    </div>

@endsection