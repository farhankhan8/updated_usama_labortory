<style>
.row {
  display: flex; /* equal height of the children */
}

.col {
  flex: 1; /* additionally, equal width */
  
  padding: 1em;
  /* border: solid gray; */
}
.hr {
    border-top: 2px solid red;

}
.h12 {
  background-color: gray;
  text-align:center;
}
</style>
<div class="card-body">
    <div class="form-row dont-break-inside">
        <div class="col">
            <div class="offset-0 col-md-6">
                <h1>Usama Laboratory</h1>
                <hr class="hr">
                    <img style="width: 5rem;" class="" src="{{ asset('images/logo_print.jpg') }}"/>
            </div>
        </div>
        <div class="col">
            <div class="offset-2 col-md-6">
            <h3 class="h12">Out-Patient</h3>
            <div class="row">
                <b class="col-md-6">MR No.</b>
                <b class="text-capitalize col-md-6 m-0">PK0-20-24-4</b>
                <strong class="col-sm-6 text-nowrap">Patient Name</strong>
                <b class="text-capitalize col-md-6 m-0"><span>{{ $getpatient->Pname }}</span></b>
            </div>
        </div>
        <div class="offset-2 col-md-6">
            <div class="row">
                <span class="col-md-6">Age/Gender</span>
                <p class="text-capitalize col-md-6 m-0 text-nowrap">{{ date('d-m-Y', strtotime($getpatient->dob)) }}/{{ $getpatient->gend }}</p>
            </div>
        </div>
        <div class="offset-2 col-md-6">
            <div class="row">
                <span class="col-md-6">Ordered By</span>
                <p class="col-md-6 m-0 text-nowrap">Dr Ali</p>
            </div>
        </div>
        <div class="offset-2 col-md-6">
            <div class="row">
                <span class="col-md-6">Ordered On</span>
                <p class="col-md-6 m-0 text-nowrap">{{ date('d-m-Y H:m:s', strtotime($getpatient->start_time)) }}</p>
            </div>
        </div>
        <div class="offset-2 col-md-6">
            <div class="row">
                <span class="col-md-6">Specimen</span>
                <p class="col-md-6 m-0 text-nowrap">{{$testPerformedsId->specimen}}</p>
            </div>
        </div>
        <div class="offset-2 col-md-6">
            <div class="row">
                <span class="col-md-6">Verified On</span>
                <p class="col-md-6 m-0 text-nowrap">{{ date('d-m-Y H:m:s', strtotime($getpatient->start_time)) }}</p>
             </div>
        </div>
        <div class="offset-2 col-md-6">
            <div class="row">
                <span class="col-md-6">Verified By</span>
                <p class="col-md-6 m-0 text-nowrap">{{ date('d-m-Y H:m:s', strtotime($getpatient->start_time)) }}</p>
            </div>
        </div>

        <!-- <div class="offset-1 col-md-6">
            <div class="row">
                <span class="col-md-6">Phone</span>
                <p class="col-md-6 m-0">{{ $getpatient->phone }}</p>
            </div>
        </div>
            
        <div class="offset-1 col-md-6">
            <div class="row">
                <span class="col-md-6">Date of Birth</span>
                <p class="col-md-6 m-0">{{ date('d-m-Y', strtotime($getpatient->dob)) }}</p>
            </div>
        </div>   

        <div class="offset-1 col-md-6">
            <div class="row">
                <p class="col-md-6">Email</b>
                <p class="col-md-6 m-0">{{ $getpatient->email }}</p>
            </div>
        </div> -->
     
        </div>
    </div>
</div>