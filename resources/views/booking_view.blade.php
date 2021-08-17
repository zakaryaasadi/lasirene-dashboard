@extends('master')
@section('content')
<div class="page-content fade-in-up">
    <div class="container">
        <div class="ibox">
            <div class="ibox-body">
                <div class="row">
                    <div class="col-sm-6 border-right mb-4">
                        <h5 class="mb-3 font-13">Customer</h5>
                        <h4 class="mb-3 font-strong">{{$b->name}}</h4>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <h5 class="mb-3 font-13">LOCATION</h5>
                        <h4 class="mb-2 font-strong">UAE Dubai</h4>
                        <h5 class="mb-3 font-14">{{$b->location}}</h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4 mb-4">
                        <h5 class="mb-3 font-13">Booking number</h5>
                        <h5 class="mb-2 font-16">{{$b->id}}</h5>
                    </div>
                    <div class="col-sm-4 mb-4">
                        <h5 class="mb-3 font-13">Payment terms</h5>
                        <h5 class="mb-2 font-16">Cash on delivery</h5>
                    </div>
                    <div class="col-sm-4 mb-4">
                        <div class="progress mt-2 mb-3">
                            @if ($b->is_approved)
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>
                        <span class="mb-2 font-16">Total services: {{$b->details->count()}}</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="ibox collapsed-mode">
            <div class="ibox-head">
                <div class="ibox-title">Details</div>
            </div>
            <div class="ibox-body">
                <div class="row">
                    <div class="col-sm-3 mb-3">
                        <form method="post" action="{{ route('approve', ['id' => $b->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label>Date</label>
                                <div class="input-group form-control-air">
                                    <input type="text" name="date" class="form-control" onfocus="(this.type='datetime-local')" value="{{$b->date}}"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-outline-primary" submit>Approve!</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <form method="post" action="{{ route('thanks', ['id' => $b->id]) }}">
                            @csrf
                            <div class="input-group" style="margin-top: 28px !important;">
                           <button class="btn btn-gradient-blue btn-animated fade-button" submit>
                                    <span class="visible-content btn-icon"><i class="fa fa-paper-plane-o"></i>Send Thanks</span>
                                    <span class="hidden-content text-white">
                                        <span class="btn-icon"><i class="fa fa-smile-o"></i>Customer Happy</span>
                                    </span>
                                </button>
                                </div>
                        </form>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <h5 class="mb-3 font-13">From Cost</h5>
                        <h5 class="mb-2 font-16">AED {{$b->min_cost}}</h5>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <h5 class="mb-3 font-13">To Cost</h5>
                        <h5 class="mb-2 font-16">AED {{$b->max_cost}}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="ibox">
            <div class="ibox-body">
                <h5 class="mb-5 font-strong">Services List</h5>
                <table class="table">
                    <thead>
                        <th>Category</th>
                        <th>Service</th>
                        <th>detail</th>
                        <th>From Price</th>
                        <th>To Price</th>
                    </thead>
                    <tbody>
                        @foreach ($b->details as $i)
                            <tr>
                                <td>{{$i->service_name}}</td>
                                <td>{{$i->product_name}}</td>
                                <td>
                                    {{$i->product_detail_name}}
                                </td>
                                <td>AED {{$i->min_price}}</td>
                                <td>AED {{$i->max_price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection