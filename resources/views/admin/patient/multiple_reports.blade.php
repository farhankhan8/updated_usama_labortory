@extends('layouts.admin')
@section('content')



    @php $previous_category_id=""; @endphp
    @foreach($tests as $testPerformedsId)

        <div style="page-break-after: always;" class="card {{($testPerformedsId->category_id!=$previous_category_id && $previous_category_id!="") ? "page-break-before":""}}">
            @if($testPerformedsId->category_id!=$previous_category_id)
                @include("admin.TestPerformed.partial_patient")
            @endif
            @include("admin.TestPerformed.partial_report")
        </div>
        @php
            $previous_category_id=$testPerformedsId->category_id;
        @endphp
    @endforeach

    <div class="col-md-12 mb-12 noprint">
        <button class="btn btn-primary" onclick="window.print()">Print Report</button>
    </div>


@endsection