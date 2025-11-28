@extends('layouts.app')
@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                {{-- Bazar --}}
                <div class="col-lg-5">
                    <a class="btn btn-sm btn-primary" href="{{ route('bazar.view') }}">Back</a>
                    <br>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-primary">Money Recipt</h5>
                            <br>
                            <img src="{{ asset('media/bazar/' . $bazar->money_recipt) }}" style="height: 550px; width:550px;"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
