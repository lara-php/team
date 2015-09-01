<html>
<head>
	<title></title>
</head>
<body>

مبلغ سبد خرید فعلی: {{{ $basket->price }}}<br/>
تعداد کالاها: {{{ $basket->productCount }}}

@foreach($categories as $category)

	<h3>{{{ $category->name }}}</h3><br/>
	<ul>
		@foreach($category->products as $product)
			<li>{{{ $product->name }}}</li>
		@endforeach
	</ul>
@endforeach


</body>
</html>