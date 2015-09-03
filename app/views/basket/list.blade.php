@extends('layouts.master')

@section('content')
<style type="text/css">

.product-list{
	border: 1px solid #ccc;
	text-align: center;
	width: 700px;
	margin: 150px auto;
}

.product-list table{
	width: 100%;
}

.product-list table tr:nth-of-type(2n){
	background-color: #EEE;
}

.product-list table tr:nth-of-type(2n-1){
	background-color: #F8F8F8;
}

.product-list table tr td{
	padding: 10px;
}

</style>

<body>

<div class="product-list">

	<table>
		<tr>
			<th>عملیات</th>
			<th>قیمت کل</th>
			<th>تعداد</th>
			<th>قیمت واحد</th>
			<th>نام کالا</th>
			<th>#</th>
		</tr>
	<?php $i = 0; ?>
	@foreach($basket->products as $product)
		<tr>
			<td><a href="" class="delete" data-id="{{{ $product->id }}}">حذف</a></td>
			<td>{{{ $product->price * $product->count }}}</td>
			<td>{{{ $product->count }}}</td>
			<td>{{{ $product->price }}}</td>
			<td>{{{ $product->name }}}</td>
			<td>{{{ ++$i }}}</td>

		</tr>
	@endforeach

	</table>
		<div>قیمت نهایی: <h3 class="res">{{{ $basket->price }}}</h3></div>

</div>

<script type="text/javascript">
	
$(function()
{

	$('.product-list .delete').click(function()
	{

		var id = $(this).data('id');

		var self = this;

		$.get('delete_from_basket.php', {id:id}, function(data)
		{
				$('.product-list .res').html(data.cost);

				
				$(self).closest('tr').fadeOut();
			
		}, 'json');

		return false;
	});

})

</script>
@stop