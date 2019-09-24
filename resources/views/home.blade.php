@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    
                    @if(auth()->user()->type=='admin')
                    <a href="/verifyresults">
                    <button class="btn btn-primary"> Verify Results</button></a><br><br>
                    <a href="/verifyfees">
                    <button class="btn btn-primary"> Verify fees</button></a><br><br>
                    <a href="#">
                    <button class="btn btn-primary"> Add room Details</button></a><br><br>
                    <a href="#">
                    <button class="btn btn-primary"> See Rejected users</button></a>
                    @endif
                    @if(auth()->user()->type=='default' && auth()->user()->book_room =='0' )
                    <h1>Proceed to Room Booking</h1>
                    <form method="POST" action="home/{{auth()->user()->id}}">
                        @csrf
                        


                        <button type="submit" class="btn btn-primary bookroom" id="button" >Book Room</button>


                        
                    </form>
                    @endif

                    @if(auth()->user()->type=='default' && auth()->user()->book_room =='1' &&auth()->user()->result_status =='0' )
                    <h1>Marksheet verification in process!</h1>
                    <p>Soon, you will redirected to next step</p>
                    @endif

                    @if(auth()->user()->type=='default' && auth()->user()->result_status =='1' && auth()->user()->utr_number =='0' )
                    <h1>Hostel Fee Payment Detail.</h1>
                    <form method="POST" action="selectroommates/{{auth()->user()->id}}">
                        @csrf
                        @method('POST')
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">UTR Number :</span>
                            </div>
                            <input type="text" class="form-control" name="utr_number" placeholder="Enter NEFT/RTGS UTR Number" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                        </div><br>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">IFSC code :</span>
                            </div>
                            <input type="text" class="form-control" name="ifsc_code" placeholder="Enter IFSC code" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                        </div><br>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">account_holder_name :</span>
                            </div>
                            <input type="text" class="form-control" name="account_holder_name" placeholder="Enter account_holder_name" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                        </div><br>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">bank branch and address :</span>
                            </div>
                            <input type="text" class="form-control" name="bank_address" placeholder="Enter bank branch and address" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                        </div><br>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">Deposit date :</span>
                            </div>
                            <input type="text" class="form-control" name="deposit_date" placeholder="Enter Deposit date" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                        </div><br>
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">Amount :</span>
                            </div>
                            <input type="text" class="form-control" name="amount" placeholder="Enter Amount" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <br>
                        <div class="button">

                            <button type="Submit" class="btn btn-info">Submit</button>

                        </div>
                    </form>

                    @if($errors->any())
                    <div class="alert alert-danger" style="margin-top:20px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @endif

                @if(auth()->user()->type=='default' && auth()->user()->fee_status =='0' && auth()->user()->utr_number !='0' )
                <h1>Fee verification in process</h1>
                <p>Soon, you will redirected to next step.</p>
                @endif

                @if(auth()->user()->type=='default' && auth()->user()->fee_status =='1' )
                <h1>Verification Completed!</h1>
                <a href="/searchroommates">
                    <button class="btn btn-primary">
                        Search Roommates
                    </button>
                </a>

                @endif




                
            </div>
        </div>
    </div>
</div>
</div>

@endsection
