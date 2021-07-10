@include('front.theme.header')

<!-- =========================== Breadcrumbs =================================== -->
<div class="breadcrumbs_wrap dark">
	<div class="container">
		<div class="row align-items-center">
			
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="text-center">
					<h2 class="breadcrumbs_title">Categories</h2>
					<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{URL::to('/')}}"><i class="ti-home"></i></a></li>
						<li class="breadcrumb-item active" aria-current="page">Categories</li>
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
						@foreach($getcategory as $key => $category)
						<!-- Single Item -->
						<li>
							<div class="woo_product_grid no-hover" style="background-color: <?php echo $strings[$key % $count]; ?>">
								<div class="woo_cat_thumb">
									<a href="{{URL::to('products/'.$category->slug)}}" style="text-align: center; padding-top: 20px;">
										<img src='{!! asset("public/images/category/".$category->image) !!}' class="img-fluid" alt=""  style="max-width: 80px" />
									</a>
								</div>
								<div class="woo_product_caption center">
									<div class="woo_title">
										<h4 class="woo_pro_title"><a href="{{URL::to('products/'.$category->slug)}}">{{$category->category_name}}</a></h4>
									</div>
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
							@if ($getcategory->lastPage() > 1)
						  <ul class="pagination">
							<li class="page-item left {{ ($getcategory->currentPage() == 1) ? ' disabled' : '' }}">
							  <a class="page-link" href="{{ $getcategory->url(1) }}" aria-label="Previous">
								<span aria-hidden="true"><i class="ti-arrow-left mr-1"></i>Prev</span>
							  </a>
							</li>
							@for ($i = 1; $i <= $getcategory->lastPage(); $i++)
							<li class="page-item {{ ($getcategory->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $getcategory->url($i) }}">{{ $i }}</a></li>
							@endfor
							<li class="page-item right {{ ($getcategory->currentPage() == $getcategory->lastPage()) ? ' disabled' : '' }}">
							  <a class="page-link" href="{{ $getcategory->url($getcategory->lastPage()) }}" aria-label="Previous">
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