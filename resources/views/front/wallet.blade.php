@include('front.theme.header')

<!-- =========================== Breadcrumbs =================================== -->
<div class="breadcrumbs_wrap dark">
	<div class="container">
		<div class="row align-items-center">
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-center">
					<h2 class="breadcrumbs_title">My Wallet</h2>
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Wallet</li>
					  </ol>
					</nav>
				</div>
			</div>
			
		</div>
	</div>
</div>
<!-- =========================== Breadcrumbs =================================== -->
<?php 
$strings = array('#D0EEF9','#FEEBD1','#F0D7F9','#FEE3DC','#EAF8ED','#ecd9e9','#ffcfd7');
$count = count($strings);
?>
<!-- =========================== Account Settings =================================== -->
<section class="gray">
	<div class="container">
		<div class="row">
		
			<div class="col-lg-4">
                <div class="order-payment-summary" style="background-color: #1d2738">
                    <div class="col-4 mx-auto text-center">
                        <img src='{!! asset("public/assets/images/ic_wallet.png") !!}' width="100px" alt="" class="text-center">
                    </div>
                    
                    <h2 class="text-center mt-3" style="color: #fff;">Wallet Balance</h2>
                    <h1 class="text-center" style="color: #fff;"><span>{{$getdata->currency}}{{number_format($walletamount->wallet, 2)}}</span></h1>
                </div>
            </div>
			
			<div class="col-lg-8 col-md-9">
				@foreach ($transaction_data as $orders)
				    @if ($orders->transaction_type == 1)
				    <div class="order-details-box">
				        <div class="wallet-details-img">
				            <img src='{!! asset("public/assets/images/ic_trGreen.png") !!}' alt="" class="mt-1">
				        </div>
				        <div class="order-details-name mt-3">
				            <h3> {{$orders->order_number}} <span style="color: #000; float: right;">{{$orders->date}}</span></h3>
				            <h3><span style="color: #ff0000;">Order Cancelled</span> <span style="color: #00c56a; float: right;"> {{$getdata->currency}}{{number_format($orders->wallet, 2)}}</span></h3>
				        </div>
				    </div>
				    @elseif ($orders->transaction_type == 2)

				    <div class="order-details-box">
				        <div class="wallet-details-img">
				            <img src='{!! asset("public/assets/images/ic_trRed.png") !!}' alt="" class="mt-1">
				        </div>
				        <div class="order-details-name mt-3">
				            <h3> {{$orders->order_number}} <span style="color: #000; float: right;">{{$orders->date}}</span></h3>
				            <h3><span style="color: #00c56a;">Order Confirmed</span> <span style="color: #ff0000; float: right;"> - {{$getdata->currency}}{{number_format($orders->wallet, 2)}}</span></h3>
				        </div>
				    </div>

				    @elseif ($orders->transaction_type == 3)

				        <div class="order-details-box">
				            <div class="wallet-details-img">
				                <img src='{!! asset("public/assets/images/ic_trGreen.png") !!}' alt="" class="mt-1">
				            </div>
				            <div class="order-details-name mt-3">
				                <a href="javascript:void(0)">
				                    <a href="#">
				                        <h3> {{$orders->username}} <span style="color: #000; float: right;">{{$orders->date}}</span></h3>
				                    </a>
				                </a>
				                <h3><span style="color: #00c56a;">Referral Earning</span> <span style="color: #00c56a; float: right;">{{$getdata->currency}}{{number_format($orders->wallet, 2)}}</span></h3>
				            </div>
				        </div>

				    @endif
				@endforeach

				<div class="row">
					<div class="col-lg-12">
						<nav aria-label="Page navigation example">
							@if ($transaction_data->lastPage() > 1)
						  <ul class="pagination">
							<li class="page-item left {{ ($transaction_data->currentPage() == 1) ? ' disabled' : '' }}">
							  <a class="page-link" href="{{ $transaction_data->url(1) }}" aria-label="Previous">
								<span aria-hidden="true"><i class="ti-arrow-left mr-1"></i>Prev</span>
							  </a>
							</li>
							@for ($i = 1; $i <= $transaction_data->lastPage(); $i++)
							<li class="page-item {{ ($transaction_data->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $transaction_data->url($i) }}">{{ $i }}</a></li>
							@endfor
							<li class="page-item right {{ ($transaction_data->currentPage() == $transaction_data->lastPage()) ? ' disabled' : '' }}">
							  <a class="page-link" href="{{ $transaction_data->url($transaction_data->lastPage()) }}" aria-label="Previous">
								<span aria-hidden="true"><i class="ti-arrow-right mr-1"></i>Next</span>
							  </a>
							</li>
						  </ul>
						  @endif
						</nav>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</section>
<!-- =========================== Account Settings =================================== -->
<!-- ======================== Fresh Vegetables & Fruits End ==================== -->
@include('front.theme.footer')