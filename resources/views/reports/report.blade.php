<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
<div class="container-fluid">

<h3 class="text-center">POS System</h3>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Pro-Name</th>
                <th >Qty</th> 
                <th >Price</th> 
                <th >Dis(%)</th> 
                <th >Total</th> 
            </tr>
        </thead>
        <tbody class="tbody">
            @foreach($pro_receipt as $item)
            <tr>
                <td>{{$item->product->product_name}}</td>
                <td>{{$item->quantity}}</td>
                <td>${{number_format($item->unitprice,2)}}</td>
                <td>{{$item->discount}}</td>
                <td>${{number_format($item->amount,2)}}</td>                 
            </tr> 
            @endforeach
        </tbody>
    </table>
    <div class="amount text-right">
        Amount to pay:<p> <b class="text-dark">${{number_format($pro_receipt->sum('amount'),2)}} <br><b>រ{{$pro_receipt->sum('amount')*4000}}</b></b></p>
        
    </div>
</div>                                                                                       
</body>
</html>