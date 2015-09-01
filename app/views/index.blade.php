<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
	<script type="text/javascript" src="{{ asset('js/jquery-1.11.1.js') }}"></script>
</head>
<body>
<div id="head">
	
</div>
<div id="body">
	<div class="right">
		<div id="basket">
			<h3>سبد خرید</h3>
			<div>تعاد کالا : <span class="count">{{{ $basket ? $basket->productCount : 0 }}}</span></div>
			<div>قیمت : <span class="cost">{{{ $basket ? $basket->price : 0 }}}</span></div>
			<a href="">نمایش سبد خرید</a>
		</div>
			
	</div>
	<div class="left">
		<div class="slide"></div>
		<div class="last-product">
			<h3 class="section-title">جدید ترین کالاها</h3>

			@foreach(Product::limit(8)->get() as $p)

				<div class="product">{{{ $p->name }}}
					<input type="hidden" value="{{{ $p->id }}}" />
					<button>اضافه به سبد خرید</button>
				</div>

			@endforeach

			<div class="clearfix"></div>
		</div>
		<div class="top-sells">
			<h3 class="section-title">پرفروش ترین کالاها</h3>

				@foreach($ps as $p)
					<div class="product">{{{ $p->name }}}
						<input type="hidden" value="{{{ $p->id }}}" />
						<button>اضافه به سبد خرید</button>
					</div>
				@endforeach

				<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div id="foot">
	
</div>



</body>
</html>