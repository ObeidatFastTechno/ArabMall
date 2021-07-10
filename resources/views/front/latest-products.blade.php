@include('front.theme.header')

<!-- =========================== Breadcrumbs =================================== -->
<div class="breadcrumbs_wrap dark">
	<div class="container">
		<div class="row align-items-center">
			
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="text-center">
					<h2 class="breadcrumbs_title">Latest Product</h2>
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Latest Product</li>
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

<!-- =========================== Search Products =================================== -->
<section>
	<div class="container">
		
		<div class="row">
			
			<div class="col-lg-12 col-md-12">
								
				<!-- row -->
				<div class="row">						
					<ul class="product grid-5">
						@foreach($getitem as $key => $item)
						<!-- Single Item -->
						<li>
							<div class="woo_product_grid" style="background-color: <?php echo $strings[$key % $count]; ?>">
								<div class="woo_product_thumb">
									<img src='{{$item["itemimage"]->image }}' class="img-fluid" alt="" />
								</div>
								<div class="woo_product_caption center">
									<div class="woo_title">
										<h4 class="woo_pro_title"><a href="{{URL::to('product-details/'.$item->slug)}}">{{ Str::limit($item->item_name, 35) }}</a></h4>
									</div>
									<div class="woo_price">
										@foreach ($item->variation as $key => $value)
											@if ($value->stock != 0)
												<h6>{{$getdata->currency}}{{number_format($value->price, 2)}}</h6>
												@break
											@endif
										@endforeach
									</div>
								</div>
								<div class="woo_product_cart hover">
									<ul>
										<li><a href="{{URL::to('product-details/'.$item->slug)}}" class="woo_cart_btn btn_cart"><i class="ti-eye"></i></a></li>
										<li><a href="javascript:void(0)" onclick="GetProductOverview('{{$item->id}}')" class="woo_cart_btn btn_view"><i class="ti-shopping-cart"></i></a></li>
										@if ($item->is_favorite == 1)
											<li><a href="javascript:void();" class="woo_cart_btn btn_save"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
										@else
										    <li><a href="javascript:void();" onclick="MakeFavorite('{{$item->id}}','{{@Auth::user()->id}}')" class="woo_cart_btn btn_save"><i class="ti-heart"></i></a></li>
										@endif
									</ul>
								</div>								
							</div>
						</li>
						@endforeach
				
					</ul>
				</div>
				<!-- row -->
						
				<div class="row">
					<div class="col-lg-12">
						<nav aria-label="Page navigation example">
							@if ($getitem->lastPage() > 1)
						  <ul class="pagination">
							<li class="page-item left {{ ($getitem->currentPage() == 1) ? ' disabled' : '' }}">
							  <a class="page-link" href="{{ $getitem->url(1) }}" aria-label="Previous">
								<span aria-hidden="true"><i class="ti-arrow-left mr-1"></i>Prev</span>
							  </a>
							</li>
							@for ($i = 1; $i <= $getitem->lastPage(); $i++)
							<li class="page-item {{ ($getitem->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $getitem->url($i) }}">{{ $i }}</a></li>
							@endfor
							<li class="page-item right {{ ($getitem->currentPage() == $getitem->lastPage()) ? ' disabled' : '' }}">
							  <a class="page-link" href="{{ $getitem->url($getitem->lastPage()) }}" aria-label="Previous">
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
<!-- =========================== Search Products =================================== -->

<!-- ======================== Fresh Vegetables & Fruits End ==================== -->
@include('front.theme.footer')