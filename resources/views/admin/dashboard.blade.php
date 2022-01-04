@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-3"></div>
    <div class="col-3"></div>
    <div class="col-3"></div>
    <div class="col-3 px-4">
        @if(auth()->user()->role == 1)
        <select class="form-select form-select" aria-label=".form-select-sm example" id="municipality"
            name="municipality">
            <option value="all">All</option>
            <option value="Basud">Basud</option>
            <option value="Capalonga">Capalonga</option>
            <option value="Daet">Daet</option>
            <option value="Jose Panganiban">Jose Panganiban</option>
            <option value="Labo">Labo</option>
            <option value="Mercedes">Mercedes</option>
            <option value="Paracale">Paracale</option>
            <option value="San Lorenzo Ruiz">San Lorenzo Ruiz</option>
            <option value="San Vicente">San Vicente</option>
            <option value="Santa Elena">Santa Elena</option>
            <option value="Talisay">Talisay</option>
            <option value="Vinzons">Vinzons</option>
        </select>
        @elseif(auth()->user()->role == 2)
        <input type="hidden" class="form-control" id="municipality" name="municipality" aria-describedby="municipality"
            value="{{auth()->user()->municipality}}" disabled>
        @endif
    </div>

    <div class="col-lg-12 col-xs-12 col-md-12">
        <div class="p-2">
            <div class="card border border-gray-500">
                <div class="card-header pb-0 border-b-5 border-gray-500">
                    <div class="card-title">
                        <i class="icon fas fa-chart-bar pr-2 text-white"></i>
                        <label for="SiteStat" class="card-text text-md">{{__('Travel Pass Records')}}</label>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="small-box bg-info">
                                <div class="inner px-3">
                                    <h3 id="total">000</h3>
                                    <p>Total Records</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-biking"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="small-box bg-danger">
                                <div class="inner px-3">
                                    <h3 id="evaluated">000</h3>
                                    <p>Total Travel Pass Evaluated</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-car-alt"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="small-box bg-warning">
                                <div class="inner px-3">
                                    <h3 id="not_evaluated">000</h3>
                                    <p>Total Travel Pass Booked</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-biking"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="small-box bg-success">
                                <div class="inner px-3">
                                    <h3> 609.69</h3>
                                    <p>Total </p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-md-12">
    </div>
</div>

@endsection


@push('scripts')
<script src="http://cntp.test:8080/socket.io/socket.io.js"></script>
<script src="/js/admin/dashboard.js"></script>
@endpush