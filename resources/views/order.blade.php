@extends('layouts.web-app')
@section('pic')
web
@endsection
@section('content')

<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
  
  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
 
  </style>
<div class="container mt-5">
    <div class="row">
    
      <div class="col-xs-12 ">
        <div class="table-responsive " data-pattern="priority-columns" >
          <table  class="form-control table table-responsive table-bordered table-hover table-striped bg-white rounded h-60">
        
            <thead>
              <tr class="bg-dark text-white" >
                <th class="w-10" >Item_no</th>
                <th class="w-15">Product_id</th>
                <th class="w-10">Name</th>
                <th class="w-10">Price</th>
                <th class="w-10">Quantity</th>
                <th class="w-10">Total</th>
                <th class="w-15">  <select class="form-select" id="customer" required>

                  <option value="">customer</option>
                </select></th>
                <th class="w-10"></th>
               
              </tr>
            </thead>
           <tbody id="txtHint">

           </tbody>
            <tbody>
           
           
       
              <tr>
              
                <td id="cou"></td>
                 
                <td>    <select class="form-select" id="proid"   name="proid">

                  @isset($pro)
         
                  @foreach ( $pro as $ord1)
                  <option 
                  @isset($pro1) 
                  @foreach( $pro1 as $ord2)
                  @if ($ord2->id == $ord1->id)
                 selected
                  @endif @endforeach @endisset 
                  value="{{$ord1->id}}" onclick="pro({{$ord1->id}})" >{{$ord1->id}} - {{$ord1->pro_name}} </option>
                  @endforeach
           
                  @endisset
                 
                
                </select></td>
        
               <td id="pro">
               </td>
               <td id="pron">
              </td>
              <td id="proq">
              </td>
              <td>  
               
              </td>
                <td>
                
                </td>
                <td>
                  
                  <button type="submit" class="btn btn-primary" name="btn-total" id="btn-total"  >+</button>  
                
                </td>
             

            </tr>
           
         
 <div>
            </tbody>
            <tfoot >
              <tr class="bg-dark text-white">
                <td colspan="8"  class="text-center font-weight-bold fs-3"> <button type="submit" class="btn btn-primary mt-3" name="btn-total"  data-bs-toggle="modal"  data-bs-target="#exampleModal">Total</button> : <span id="total"></span> </td>
                </tr>
              
            </tfoot>
          </table>
        </div><!--end of .table-responsive-->
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      
        <div class="modal-body">

            <div class="form-group" id="customers">
                
              </div>
              <div class="form-group" id="totals">
               
              </div>
              <div class="form-group" id="paids">
                <label >Paid</label>
                <input type="number" class="form-control " id="Paid"  onkeyup="status(this.value)" required>
              </div>
              <div class='form-group' id='remains'>
              
              </div>

              <div class='form-group' id='statuss'>
           
              </div>
             
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary " id="ajaxSubmit" onclick="total1()">Save changes</button>
        </div>
@endsection

@section('scripts')
<script>

      const new_fetch = new fetch();
      function status(str) {

       
        
             var total= $('#totals1').val();

        var remains= total - str;
   
        if (remains<=0) {
          document.getElementById("remains").innerHTML ="";
          document.getElementById("statuss").innerHTML ="";
          document.getElementById("remains").innerHTML = "<label >Remain</label>\
                <input type='text' class='form-control' id='remain' value='0'  readonly required>";
                document.getElementById("statuss").innerHTML = "<label >Status</label>\
                <input type='text' class='form-control' id='Status' value='Done' readonly required>";
             
        }
        else{  document.getElementById("remains").innerHTML ="";
          document.getElementById("statuss").innerHTML =""; 
           document.getElementById("remains").innerHTML = "<label >Remain</label>\
                <input type='text' class='form-control' id='remain' value='"+remains+"'  readonly required>";
                document.getElementById("statuss").innerHTML = "<label >Status</label>\
                <input type='text' class='form-control' id='Status' value='progress' readonly  required>";}
        

        
      }

      function total1(){
        $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data={
  
                
  'statuss': $('#Status').val(),
  'remians': $('#remain').val(),
  'Paids': $('#Paid').val(),
  'customer': $('#customers1').val(),

}
       $.ajax({
  
                  type:"POST",
                  url:"{{route('total')}}",
                  data: data,
                      dataType : 'json',
                 
                  success: function(response) {
              
                    document.getElementById("statuss").innerHTML = "";
                    document.getElementById("remains").innerHTML = "";
                    document.getElementById("paids").innerHTML = "";
                    document.getElementById("customers").innerHTML = "";
                      fetch(1);
                  }})
                }

      

       function fetch(str) {
      $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
       $.ajax({
  
                  type:"Get",
                  url:"{{route('fetch')}}",
                    
                      dataType : 'json',
                  success: function(response) {
               
                    document.getElementById("cou").innerHTML = "";
                    document.getElementById("total").innerHTML = "";
                    document.getElementById("totals").innerHTML = "";
                    document.getElementById("txtHint").innerHTML = "";
                  
                    $('#totals').append('<label >Total</label>\
                <input type="text" class="form-control" id="totals1"  value="'+response.sums+'" readonly required>')
                 
                    if (str==0) {
                   
                    }
                else  if (str==1) {
                    document.getElementById("totals").innerHTML = "";
                    document.getElementById("totals").innerHTML = "<lable class='form-control bg-success'> Saved successfully";
                  }
                    else{   document.getElementById("customer").innerHTML = "";
                      $('#customer').append(' <option  value="" >customer</option>')
                    $.each(response.customers,function (key,customers){
                      $('#customer').append('<option  value="'+customers.name+'" onclick="customer(this.value)">'+customers.name+'</option>')
                    })}
                    
                    $('#cou').append('<input class="form-control text-center w-100" type="text" name="item_id" id="item_id"  value="'+response.count+'"required>')
                      $('#total').append(' '+response.sums+'')
                    
                    $.each(response.orders,function (key,orders) {
                      $('#txtHint').append('  <tr id="txt'+orders.id+'">\
<td><label class="form-control">'+orders.item_id+'</label></td>\
<td><label class="form-control">'+orders.prodectid+'</label></td>\
<td><label class="form-control">'+orders.product+'</label></td>\
<td><input class="form-control w-60" value="'+orders.price+'" name="price'+orders.id+'" onkeyup="btn_up('+orders.id+')" id="price'+orders.id+'"></td>\
<td><input class="form-control w-60" value="'+orders.qty+'" name="qty'+orders.id+'" onkeyup="btn_up('+orders.id+')" id="qty'+orders.id+'"></td>\
<td> <input class="form-control w-60" value="'+orders.total+'" disabled ></td>\
<td><input class="form-control w-100" value="'+orders.customer+'" disabled ></td>\
<td><button class="btn btn-danger"   name="del"  type="submit" onclick="btn_del('+orders.id+')" value="'+orders.id+'"  >-</button></td>\
</tr>')
                    })
                    
                      }
  
        
                      
                      
                    
                  });
    }
  $(document).ready(function(){
   
  $(document).on('click','#btn-total',function(e){
  
    e.preventDefault();
    //console.log("hello");
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
              
              var data={
  
                
                'item_id': $('#item_id').val(),
                'proname': $('#proname').val(),
                'proid': $('#proid').val(),
                'proprice': $('#proprice').val(),
                'proqty': $('#proqty').val(),
                'customer': $('#customer').val(),
              }
  
  
              $.ajax({
  
                  type:"POST",
                  url:"{{route('addorder')}}",
                      data: data,
                      dataType : 'json',
                  success: function(response) {
               
                    location.href = "http://localhost/blog/public/order#total";

                      document.getElementById("cou").innerHTML = "";
                      document.getElementById("total").innerHTML = "";
                      document.getElementById("totals").innerHTML = "";
                      document.getElementById("customers").innerHTML = "";
                      document.getElementById("customers").innerHTML = "<label >Customer</label>\
                <input type='text' class='form-control' value='"+$('#customer').val()+"' id='customers1' required>";
                      $.each(response.id,function (key,orders) {
                      $('#txtHint').append('  <tr id="txt'+orders.id+'">\
<td><label class="form-control">'+orders.item_id+'</label></td>\
<td><label class="form-control">'+orders.prodectid+'</label></td>\
<td><label class="form-control">'+orders.product+'</label></td>\
<td><input class="form-control w-60" value="'+orders.price+'" name="price'+orders.id+'" onkeyup="btn_up('+orders.id+')" id="price'+orders.id+'"></td>\
<td><input class="form-control w-60" value="'+orders.qty+'" name="qty'+orders.id+'" onkeyup="btn_up('+orders.id+')" id="qty'+orders.id+'"></td>\
<td> <input class="form-control w-60" value="'+orders.total+'" disabled ></td>\
<td><input class="form-control w-100" value="'+orders.customer+'" disabled ></td>\
<td><button class="btn btn-danger"   name="del"  type="submit" onclick="btn_del('+orders.id+')" value="'+orders.id+'"  >-</button></td>\
</tr>')
                    })
                    document.getElementById("paids").innerHTML = "<label >Paid</label>\
                <input type='number' class='form-control' id='Paid'  onkeyup='status(this.value)' required>";
                    $('#totals').append('<label >Total</label>\
                <input type="text" class="form-control" id="totals1"  value="'+response.sums+'" readonly required>')
                    $('#total').append(''+response.sums+'')
                    $('#cou').append('<input class="form-control text-center w-100" type="text" name="item_id" id="item_id"  value="'+response.count+'"required>')

                      }
  
        
                      
                      
                    
                  });
  
  
  
  
                    });
    
  
  });
  
  
  function customer(str){
  
        $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    var data={

      'customers': str,
    }
       $.ajax({
  
                  type:"POST",
                  url:"{{route('customer')}}",
                  data: data,
                      dataType : 'json',
                  success: function(response) {
                    document.getElementById("customers").innerHTML = "";
                      document.getElementById("customers").innerHTML = "<label >Customer</label>\
                <input type='text' class='form-control' value='"+$('#customer').val()+"' id='customers1' required>";
           fetch(0);
                  }})
                }
  
  
  function btn_up(str) {
   
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
                
                var data={
    
                  
                  'up':str,
                  'price': $('#price'+str).val(),
                  'qty': $('#qty'+str).val(),
                }
                $.ajax({
    
    type:"POST",
    url:"{{route('update')}}",
        data: data,
        dataType : 'json',
    success: function(response) {
    
       
        
        document.getElementById('txt'+str+'').innerHTML = "";
        document.getElementById("total").innerHTML = "";
        document.getElementById("totals").innerHTML = "";
        $('#totals').append('<label >Total</label>\
                <input type="text" class="form-control" id="totals1"  value="'+response.sums+'" readonly required>')
        $.each(response.orders,function (key,orders) {
          $('#txt'+str+'').append('<td> <label class="form-control">'+orders.item_id+'</label></td>\
<td><label class="form-control">'+orders.prodectid+'</label></td>\
<td><label class="form-control">'+orders.product+'</label></td>\
<td><input class="form-control w-60" value="'+orders.price+'" onkeyup="btn_up('+orders.id+')" name="price'+orders.id+'" id="price'+orders.id+'"></td>\
<td><input class="form-control w-60" value="'+orders.qty+'" onkeyup="btn_up('+orders.id+')" name="qty'+orders.id+'" id="qty'+orders.id+'"></td>\
<td><input class="form-control w-60" value="'+orders.total+'" disabled ></td>\
<td><input class="form-control w-100" value="'+orders.customer+'" disabled ></td>\
<td><button class="btn btn-danger"   name="del"  type="submit" onclick="btn_del('+orders.id+')" value="'+orders.id+'"  >-</button></td>\
</tr>')})
$('#total').append(''+response.sums+'')
        }


        
        
      
    });
    

    }

    
    function btn_del(str) {
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
                
                var data={
    
                  
                  'del': str,
                }
                $.ajax({
    
    type:"POST",
    url:"{{route('delorder')}}",
        data: data,
        dataType : 'json',
    success: function(response) {

      document.getElementById("totals").innerHTML = "";
        $('#totals').append('<label >Total</label>\
                <input type="text" class="form-control" id="totals1"  value="'+response.sums+'" readonly required>')
        document.getElementById("cou").innerHTML = "";
        document.getElementById('txt'+str+'').innerHTML = "";
        document.getElementById("total").innerHTML = "";
        $('#total').append(' '+response.sums+'')
        $('#cou').append('<input class="form-control text-center w-100" type="text" name="item_id" id="item_id"  value="'+response.count+'"required>')
        }


        
        
      
    });

    }

    function pro(str) {
      $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    var data={
      'proid': str,

    }
       $.ajax({
  
                  type:"POST",
                  url:"{{route('pro')}}",
                    data:data,
                      dataType : 'json',
                  success: function(response) {
                    
                  
                    document.getElementById("pro").innerHTML = "";
                    document.getElementById("pron").innerHTML = "";
                    document.getElementById("proq").innerHTML = "";
                    $.each(response.pro,function (key,pro) {
                    $('#pro').append('<td><input  class="form-control w-100"  type=" text" name="proname" id="proname" value="'+pro.pro_name+'" required> </td>'),
                    $('#pron').append('<td><input  class="form-control w-100" type="number" name="proprice" id="proprice"  value="'+pro.price+'" required></td>'),
                    $('#proq').append('<td><input class="form-control w-100 " type="number" name="proqty" id="proqty"  value="1"  required  ></td>')

                    })
                    
                      }
  
        
                      
                      
                    
                  });
    }

    function rotateTable() {
  var newTable = [];
  var newTableStruct = "<tr>";

  $("table.table").find("th, td").each(function() {
    var trIndex = $(this).closest("table").find("tr").index($(this).closest("tr"));
    var tdIndex = $(this).closest("tr").find("td, th").index($(this))
    newTable[tdIndex] = newTable[tdIndex] || [];
    newTable[tdIndex][trIndex] = $(this).html();
  });

  for (i = 0; i < newTable.length; i++) {
    for (j = 0; j < newTable[0].length; j++) {
      newTableStruct += "<td>" + newTable[i][j] + "</td>";
    }
    newTableStruct += "</tr><tr>";
  }
  newTableStruct += "</tr>";
  $("table.table").empty().append(newTableStruct);
}




  </script>

   
@endsection

