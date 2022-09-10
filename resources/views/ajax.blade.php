<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <head>

  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
</script>  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
      
      </head>

    <title>Document</title>
</head>
<body>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" style="margin-left: 40%; margin-top:20%" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal --> 
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      
        <div class="modal-body">

            <div class="form-group">
                <label for="exampleInputEmail1">pro_name</label>
                <input type="text" class="form-control " id="pro_name"  placeholder="Enter name" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">price</label>
                <input type="text" class="form-control" id="price"   placeholder="Enter name" required>
              </div>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary " id="ajaxSubmit" >Save changes</button>
        </div>
        <div id="save.errors">

        </div>
      </div>
    </div>
  </div>

  
</body>

<script>

$(document).ready(function(){


$(document).on('click','#ajaxSubmit',function(e){

  e.preventDefault();
  //console.log("hello");
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
            
            var data={

              
              'pro_name': $('#pro_name').val(),
              'price': $('#price').val(),
            
              
            }


            $.ajax({

                type:"POST",
                url:"{{route('ajax')}}",
                    data: data,
                    dataType : 'json',
                success: function(response) {
                    // 
                   // if(response.status == 400){
                    //$('save.errors').html(""),
                     // $('save.errors').addclass("alert alert-danger"),
                     // $.each(response.errors, function(key,err_values){
                     //   $('#save.errors').append('<li>'+err_values+'</li>')
                    // })
       
                    document.getElementById("save.errors").innerHTML = "<label class='alert alert-primary'>Product add successfull </label>";
                  
                    }

      
                    
                    
                  
                });




                  });
  

});




</script>
</html>