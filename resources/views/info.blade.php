<div class="row mb-4">
    @include('info_table')
    <div class="col-lg-4 col-md-6">
        <div class="card mb-4">
            <div class="card-body flexbox-b">
                <div class="easypie mr-4" data-percent="73" data-bar-color="#18C5A9" data-size="80" data-line-width="8">
                    <span class="easypie-data text-success" style="font-size:32px;"><i class="fa fa-users"></i></span>
                </div>
                <div>
                    <h3 class="font-strong text-success">{{$today}}</h3>
                    <div class="text-muted">TODAY'S CUSTOMERS</div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body flexbox-b">
                <div class="easypie mr-4" data-percent="42" data-bar-color="#5c6bc0" data-size="80" data-line-width="8">
                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="fa fa-users"></i></span>
                </div>
                <div>
                    <h3 class="font-strong text-primary">{{$month}}</h3>
                    <div class="text-muted">MONTH'S CUSTOMERS</div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body flexbox-b">
                <div class="easypie mr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="fa fa-users"></i></span>
                </div>
                <div>
                    <h3 class="font-strong text-pink">{{$year}}</h3>
                    <div class="text-muted">YEAR'S CUSTOMERS</div>
                </div>
            </div>
        </div>
    </div>
</div>
