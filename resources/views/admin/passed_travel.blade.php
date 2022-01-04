@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">
@endpush
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
    <div class="p-4">
        <div class="card border border-gray-500">
            <div class="card-header pb-0 border-b-5 border-gray-500">
                <div class="card-title">
                    <i class="icon fas fa-check pr-2 text-white"></i>
                    <label for="RideStat" class="card-text text-md">{{__('Evaluated Travel Pass')}}</label>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered w-full nowrap" id="datatable"></table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modal._travel_pass')
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
<script src="http://cntp.test:8080/socket.io/socket.io.js"></script>
<script src="/js/admin/passed_travel.js"></script>
@endpush