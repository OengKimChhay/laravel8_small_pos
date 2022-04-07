@extends('admin.dashboard')
@section('title','Order')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if($message = Session::get('success'))
<div class="alert alert-success">
        {{$message}}
</div>
@endif
<form action="{{route('ordersDetail.store')}}" method="post">
@csrf
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
        
            <div class="card">
                <div class="card-header bg-info"><h4 class="text-white">Order Product</h4></div>
                <div class="card-body">
                    <div class="table-responsive-lg">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:1%;">No_</th>
                                    <th>Pro-Name</th>
                                    <th style="width:15%;">Qty</th>
                                    <th style="width:15%;">Price $</th>
                                    <th style="width:15%;">Dis%</th>
                                    <th>Total</th>
                                    <th><a class="addOrder btn btn-outline-success"><li class="fa fa-plus"></li></a></th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <select name="product_id[]" class="product_id form-control">
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                            <option data-price="{{$product->price}}" value="{{$product->id}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input name="quantity[]"  type="number" class="quantity form-control" ></td>
                                    <td><input name="price[]"  type="number"  class="price form-control" ></td>
                                    <td><input name="discount[]"  type="number" class="discount form-control" value="0" ></td>
                                    <td><input name="total[]"  type="number"  class="total form-control" ></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- for search product -->
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header text-white bg-secondary d-flex"><h4>Total:</h4><input type="number" name="amount" class="Subtotal form-control"></div>
                <div class="card-body p-1">
                    <div class="btn-group">
                        <button id="printBtn" type="button" class="btn btn-dark"><li class="fa fa-print"></li>Print</button>
                        <button onclick="" type="button" class="btn btn-primary"><li class="fa fa-print"></li>History</button>
                        <button onclick="" type="button" class="btn btn-danger"><li class="fa fa-print"></li>Report</button>
                    </div>
                    <div class="card-header d-flex p-2">
                        <div class="form-group  mr-1">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name"  >
                        </div>
                        <div class="form-group m-0">
                            <label for="customer_phone">Customer Phone</label>
                            <input type="text" class="form-control" name="customer_phone" >
                        </div>
                    </div>
                    <div class="card-body m-2 p-0">
                        <div class="form-group d-flex">
                            <div><input type="radio" class="mr-2" checked name="method" value="cash" ><label for="cash"><li class="fa fa-money"></li>Cash</label><div>
                            <div><input type="radio" class="mr-2" name="method" value="bank" ><label for="bank"><li class="fa fa-bank"></li>Bank</label><div>
                            <div><input type="radio" class="mr-2" name="method" value="card"><label for="card"><li class="fa fa-credit-card"></li>Credit Card</label><div>
                        </div>
                    </div>
                    <div class="card-footer d-flex p-2 m-0">
                        <div class="form-group  mr-1">
                            <label for="payment">Payment</label>
                            <input type="number" class="payment form-control" name="payment"  >
                        </div>
                        <div class="form-group m-0">
                            <label for="change">Your Cange</label>
                            <input type="number" readonly class="change form-control" name="change" >
                        </div>
                    </div>
                        <div class="form-group m-0">
                            <button type="submit" class="submit btn btn-success">Save</button>
                            <button class="btn btn-dark">Caculate</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<!-- receipt -->

<div type="button" data-toggle="modal" data-target=".modal">

</div>
<div class="modal">
    <div id="print">
        @include('reports.report')
    </div>
</div>

@endsection

<!-- javascript for add table row for order -->
@section('script')
<script>
    $(document).ready(function(){
        $('.addOrder').on('click',function(){
            var product = $('.product_id').html();
            var numRow = ($('.tbody tr').length) +1;
            var tr = '<tr>'+
                        '<td>'+ numRow +'</td>'+
                        '<td><select name="product_id[]" class="product_id form-control">'+product +'</select></td>'+
                        '<td><input name="quantity[]" type="number" class="quantity form-control" ></td>'+
                        '<td><input name="price[]" type="number" class="price form-control"></td>'+
                        '<td><input name="discount[]"  type="number" class="discount form-control" value="0" ></td>'+
                        '<td><input name="total[]"  type="number"  class="total form-control" ></td>'+
                        '<td><button class="removeRow btn btn-outline-danger"><li class="fa fa-times"></li></button></td>'+
                     '</tr>';
            $('.tbody').append(tr);
        });
        // remove row table
            $('.tbody').delegate('.removeRow','click',function(){
                $(this).parent().parent().remove();
            });
           
            // total amount
            function TOTALAMOUNT(){
                var TOTAL = 0;
                $(".total").each(function(i,e){
                    var amount = $(this).val()-0;
                    TOTAL+= amount;
                });
                $('.Subtotal').val(TOTAL);
            }
            // this will show the total price with qty and discount
            $('.tbody').delegate('.product_id','change',function(){
                var tr = $(this).parent().parent();
                var price = tr.find('.product_id option:selected').attr('data-price');
                    tr.find('.price').val(price); 
                var qty = tr.find('.quantity').val();
                var dis = tr.find('.discount').val();
                var price = tr.find('.price').val();
                var TotalAmount = (qty*price) - ((qty*price*dis)/100);
                    tr.find('.total').val(TotalAmount);
                    TOTALAMOUNT();
            });
            // for qty and disc key up
            $('.tbody').delegate('.quantity, .discount','keyup',function(){
                var tr = $(this).parent().parent();
                var price = tr.find('.product_id option:selected').attr('data-price');
                    tr.find('.price').val(price); 
                var qty = tr.find('.quantity').val();
                var dis = tr.find('.discount').val();
                var price = tr.find('.price').val();
                var TotalAmount = (qty*price) - ((qty*price*dis)/100);
                    tr.find('.total').val(TotalAmount);
                    TOTALAMOUNT();
            });

            // for cashier and for changes customer
            $('.payment').keyup(function(){
                var total = $('.Subtotal').val();
                var paid = $(this).val();
                $('.change').val(paid-total).toFixed(2);
            });

            // print 
    
            $('#printBtn').click(function(){
                var data = '<input type="button" class="btn btn-primary w-100 mt-3 mb-3" id="printPageButton" value="Print Receipt" onClick="window.print()">';
                    data += document.getElementById('print').innerHTML;
                    MyReceipt = window.open("","Mywin","left=400 ,top=150, width=600, height=700");
                    MyReceipt.screnX = 0;
                    MyReceipt.screnY = 0;
                    MyReceipt.document.write(data);
                    MyReceipt.document.title = "Print Receipt";
                    MyReceipt.focus();
            });
            
    })
</script>
@endsection