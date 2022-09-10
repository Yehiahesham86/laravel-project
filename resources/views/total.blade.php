@extends('layouts.web-app')
@section('pic')
web
@endsection
@section('content')

<div class="container mt-5">
    <div class="row">
    
      <div class="col-s-10 ">
        <div class="col-s-10 d-flex mt-4  form-control "  >
        <div class="col-s-10 d-flex  w-100" style="margin-left: 20%">     <label class="form-control w-7 m-2" >From</label>
          <input class="form-control w-15 m-2" type="date"  id="from">

          <label class="form-control w-5 m-2" >To</label>
          <input class="form-control w-15 m-2" type="date"  id="to">

          <button type="submit" class="btn btn-success m-2" onclick="total1()" id="search">Search</button></div>
     
        </div>
     
        </div>

      </div>
      
        
    </div>
 
   
@endsection
@section('content2')
<div class="container w-80" style="margin-left: 20%">
  <div class="row ml-10  mt-3" >
    <div class="w-100 mt-5">
    </div>
  
  </div>
  <div id="showmore">
   
    
  </div>
 
  
</div>

@endsection

@section('scripts')
  <script>
    function show2(str) {
  var x = document.getElementById('details'+str+'');
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
    
  
  function total1(){
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var data={
  
                
  'from': $('#from').val(),
  'to': $('#to').val(),

  
}
       $.ajax({
        
          
                  type:"POST",
                  url:"{{route('totalpage1')}}",
                    data:data,
                      dataType : 'json',
                  success: function(response) {
               
                    document.getElementById("showmore").innerHTML = "";
                 //  console.log(response);
                    
                    $.each(response.total,function (key,totals) {
                      $('#showmore').append( '<div class="row ml-10 w-100   mt-3"  onclick="show2('+totals.okey+')">\
      <div class="dropdown w-100">\
        <a class="btn btn-secondary dropdown-toggle w-100" href="#details'+totals.okey+'" >\
          <div class="d-flex" >\
            <label class="form-control w-100" >'+totals.user_id+'</label>\
            <label class="form-control w-100" >'+totals.created_at+'</label>\
            <label class="form-control w-100" >costumer</label>\
            <label class="form-control w-100" >'+totals.total+'</label>\
          </div>\
        </a>\
      <div  id="details'+totals.okey+'">\
       </div>\
      </div>\
    </div>')  
    showmore(totals.okey);
    show2(totals.okey);    
  })
  
    
                      }
  
        
                      
                      
                    
                  });
  }

  function showmore(str){
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var data={
  
                
  'okey': str,


  
}
       $.ajax({
  
                  type:"POST",
                  url:"{{route('showmore')}}",
                    data:data,
                      dataType : 'json',
                  success: function(response) {
               
        // console.log(response);
                 
                    $.each(response.details,function (key,done) {
                      $('#details'+str+'').append(' <div class="d-flex" >\
          <label class="form-control w-100" >'+done.prodectid+'</label>\
          <label class="form-control w-100" >'+done.product+'</label>\
          <label class="form-control  w-100" >'+done.price+'</label>\
          <label class="form-control  w-100" >'+done.qty+'</label>\
          <label class="form-control w-100" >'+done.total+'</label>\
           </div>')  })
                    
                      }
  
        
                      
                      
                    
                  });
  }
</script>
@endsection



