<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
		.invoice li{display:block;line-height:25px;padding-left:5px;}
		.buyer-seller li{display:block;line-height:20px;padding-left:5px;}
		.product li{display:block;}
	</style>
</head>

<body style="position:relative;">
	<table cellpadding="2px" cellspacing="0" border="0px" style="width:100%;">
		<tr>
			<td style="font-weight:bold;font-size:18px;" width="50%">Vitality Club (A Unit of Candid India)</td>
			<td style="font-weight:bold;font-size:18px;" width="50%">Retail/Tax Invoice</td>
		</tr>
		<tr>
		    <td>+91-85957 64867 / hello@vitalityclub.in</td>
		    <td>Invoice Number: CI/VC/WS/{{$invoice_Number}}</td>
		</tr>
		<tr>
		    <td>GSTIN: 07ACXPC8630R1ZP</td>
		    <td>Invoice Date: @php echo date_format($invoice['created_at'], "d M, Y") @endphp</td>
		</tr>
		<tr>
		    <td>FSSAI License No.: 10020011008074</td>
		    <td>Invoice Amount: INR @php echo number_format($orders['total_amount'], 2) @endphp</td>
		</tr>
		<tr>
		    <td>A1/76, 1st Floor, Safdarjung Enclave<br/>Delhi – 110029, India</td>
		    <td>Payment: {{$orders['payment_status']}} {{$orders['payment_mode']}}</td>
		</tr>
	</table>
	
	<table cellpadding="2px" cellspacing="0" border="0px" style="width:100%;margin-top:40px;border-top:0.5px solid black;">
	    <tr>
		    <th style="text-align:left;border-bottom:0.5px solid black;padding:7px 0;font-size:18px;">Shipping address</th>
		    <th style="text-align:left;border-bottom:0.5px solid black;padding:7px 0;font-size:18px;">Billing address</th>
		</tr>
		<tr>
		    <td>{{$orders_customers['first_name']}} {{$orders_customers['last_name']}}</td>
		    <td>{{$orders_customers['billing_first_name']}} {{$orders_customers['billing_last_name']}}</td>
		</tr>
		<tr>
		    <td>{{$orders_customers['shipping_address']}}</td>
		    <td>{{$orders_customers['billing_address']}}</td>
		</tr>
		<tr>
		    <td>{{$orders_customers['shipping_city']}}, {{$orders_customers['shipping_state']}} - {{$orders_customers['shipping_pincode']}}</td>
		    <td>{{$orders_customers['billing_city']}}, {{$orders_customers['billing_state']}} - {{$orders_customers['billing_pincode']}}</td>
		</tr>
		<tr>
		    <td>{{$orders_customers['shipping_country']}}</td>
		    <td>{{$orders_customers['billing_country']}}</td>
		</tr>
		<tr>
		    <td>{{$orders_customers['phone']}}</td>
		    <td>{{$orders_customers['billing_phone']}}</td>
		</tr>
	</table>
	
	<table cellpadding="2px" cellspacing="0" border="0px" style="width:100%;font-weight:bold;margin-top:40px;">
		<tr>
			<td>Order No. #{{$orders['id']}}</td>
		</tr>
	</table>
	
	<table cellpadding="5px" cellspacing="0" border="0px" style="width:100%;border-top:.5px solid black;margin-top:20px;">
		<tr>
			<th width="5%" style="border-bottom:0.5px solid black;"></th>
			<th width="45%" style="text-align:left;border-bottom:0.5px solid black;">Product</th>
			<th style="border-bottom:0.5px solid black;" width="15%">Price</th>
			<th style="border-bottom:0.5px solid black;" width="15%">QTY.</th>
			<th style="border-bottom:0.5px solid black;" width="20%">Amount</th>
		</tr>
		@php $i=1; @endphp
		@foreach($orders_items as $orders_item)
		    <tr>
		    	<td>{{$i}}.</td>
		    	<td>
		    		<li style="display:block;font-weight:bold;">{{$orders_item['product_name']}}</li>
		    		<li style="display:block;font-size:13px;line-height:15px;">Model No : {{$orders_item['product_modelNo']}}</li>
		    	</td>
		    	<td style="text-align:center;">INR @php echo number_format($orders_item['product_discountedPrice']) @endphp</td>
		    	<td style="text-align:center;">{{$orders_item['product_quantity']}}</td>
		    	<td style="text-align:center;">INR @php echo number_format($orders_item['product_discountedPrice'] * $orders_item['product_quantity']) @endphp</td>
		    </tr>
		@php $i++; @endphp
		@endforeach
	</table>
	<table cellpadding="5px" cellspacing="0" border="0px" style="width:100%;border-top:.5px solid black;margin-top:7px;">
		<tr>
			<td width="5%"></td>
			<td width="45%"></td>
			<td style="text-align:center;" width="15%"></td>
			<td style="text-align:center;" width="15%">Subtotal</td>
			<td style="text-align:center;" width="20%">INR @php echo number_format($orders['subtotal']) @endphp</td>
		</tr>
	</table>
	@if($orders['discount'] > 0)
	<table cellpadding="5px" cellspacing="0" border="0px" style="width:100%;">
		<tr>
			<td width="5%"></td>
			<td width="45%"></td>
			<td style="text-align:center;" width="15%"></td>
			<td style="text-align:center;" width="15%">Discount</td>
			<td style="text-align:center;" width="20%">- INR @php echo number_format($orders['discount'], 2) @endphp</td>
		</tr>
	</table>
	@endif
	<table cellpadding="5px" cellspacing="0" border="0px" style="width:100%;">
		<tr>
			<td width="5%"></td>
			<td width="45%"></td>
			<td style="text-align:center;" width="15%"></td>
			<td style="text-align:center;" width="15%">Shipping</td>
			<td style="text-align:center;" width="20%">@if($orders['shipping_cost'] > 0) INR {{$orders['shipping_cost']}} @else Free @endif</td>
		</tr>
	</table>
	@if($orders['cod_charges'] > 0)
	<table cellpadding="5px" cellspacing="0" border="0px" style="width:100%;">
		<tr>
			<td width="5%"></td>
			<td width="45%"></td>
			<td style="text-align:center;" width="15%"></td>
			<td style="text-align:center;" width="15%">COD Charges</td>
			<td style="text-align:center;" width="20%">INR @php echo number_format($orders['cod_charges'], 2) @endphp</td>
		</tr>
	</table>
	@endif
	<table cellpadding="5px" cellspacing="0" border="0px" style="width:100%;">
		<tr>
			<td width="5%"></td>
			<td width="45%"></td>
			<td style="text-align:center;" width="15%"></td>
			<td style="text-align:center;" width="15%">Tax (GST)</td>
			<td style="text-align:center;" width="20%">{{$tax['tax']}}% (inclusive)</td>
		</tr>
	</table>
	<table cellpadding="5px" cellspacing="0" border="0px" style="width:100%;border-top:.5px solid black;border-bottom:.5px solid black;margin-top:5px;font-weight:bold;">
		<tr>
			<td width="5%"></td>
			<td width="45%"></td>
			<td style="text-align:center;" width="15%"></td>
			<td style="text-align:center;" width="15%">Total</td>
			<td style="text-align:center;" width="20%">INR @php echo number_format($orders['total_amount'], 2) @endphp</td>
		</tr>
	</table>
	
	<table cellpadding="2px" cellspacing="0" border="0px" style="width:100%;margin-top:40px;">
		<tr>
			<td style="font-weight:bold;">DECLARATION:</td>
		</tr>
		<tr>
			<td>We declare that this invoice shows the actual price of the goods described inclusive of taxes and that all particulars are true and correct.</td>
		</tr>
	</table>
	
	<table cellpadding="5px" cellspacing="0" border="0px" style="position:absolute;bottom:0;width:100%;text-align:center;font-size:13px;">
		<tr>
			<td>(This is a computer generated invoice and does not require physical signature.)</td>
		</tr>
	</table>
</body>

</html>