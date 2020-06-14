<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{csrf_token()}}">
   <title>Admin Panel - @yield('title')</title>
   <!-- Favicon and touch icons -->
   <link rel="shortcut icon" href="{{asset('/admin_assets/')}}/dist/img/ico/favicon.png" type="image/x-icon">
   <link href="{{asset('/admin_assets/')}}/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/plugins/monthly/monthly.css" rel="stylesheet" type="text/css"/>
   <link href="{{asset('/admin_assets/')}}/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css">
   @toastr_css
</head>
<body class="hold-transition sidebar-mini">
   <!--preloader
   <div id="preloader">
      <div id="status"></div>
   </div>-->
   <div class="wrapper">
      @include('admin.layouts.header')
      @include('admin.layouts.sidebar')
      @yield('content')
      @include('admin.layouts.footer')
   </div>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <!--<script src="{{asset('/admin_assets/')}}/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>-->
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script>
      $(function() 
      {
         $( "#datepicker" ).datepicker({
            minDate:0,
            dateFormat:"yy-mm-dd",
         });
      });
   </script>
   <script src="{{asset('/admin_assets/')}}/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/plugins/pace/pace.min.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript">    </script>
   <script src="{{asset('/admin_assets/')}}/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/dist/js/custom.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/plugins/counterup/waypoints.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/plugins/monthly/monthly.js" type="text/javascript"></script>
   <script src="{{asset('/admin_assets/')}}/dist/js/dashboard.js" type="text/javascript"></script>
   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.js"></script>
   <script type="text/javascript">
      $(document).ready( function () {
          $('#products_table').DataTable({
              "paging":false
          });

          //Update Product Status
          $(".ProductStatus").change(function(){
              var id = $(this).attr('rel');
              if($(this).prop("checked")==true)
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-product-status',
                      data : {status:'1',id:id},
                      success:function(data)
                      {
                         $("#message_success").show();
                         setTimeout(function()
                         {
                            $("#message_success").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
              else
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-product-status',
                      data : {status:'0',id:id},
                      success:function(resp)
                      {
                         $("#message_error").show();
                         setTimeout(function()
                         {
                            $("#message_error").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
          });
          //Update Category Status
          $(".CategoryStatus").change(function(){
              var id = $(this).attr('rel');
              if($(this).prop("checked")==true)
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-category-status',
                      data : {status:'1',id:id},
                      success:function(data)
                      {
                         $("#message_success").show();
                         setTimeout(function()
                         {
                            $("#message_success").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
              else
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-category-status',
                      data : {status:'0',id:id},
                      success:function(resp)
                      {
                         $("#message_error").show();
                         setTimeout(function()
                         {
                            $("#message_error").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
          });
          //Update Category Status
          $(".BannerStatus").change(function(){
              var id = $(this).attr('rel');
              if($(this).prop("checked")==true)
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-banner-status',
                      data : {status:'1',id:id},
                      success:function(data)
                      {
                         $("#message_success").show();
                         setTimeout(function()
                         {
                            $("#message_success").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
              else
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-banner-status',
                      data : {status:'0',id:id},
                      success:function(resp)
                      {
                         $("#message_error").show();
                         setTimeout(function()
                         {
                            $("#message_error").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
          });
          //Update Coupon Status
          $(".CouponStatus").change(function(){
              var id = $(this).attr('rel');
              if($(this).prop("checked")==true)
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-coupon-status',
                      data : {status:'1',id:id},
                      success:function(data)
                      {
                         $("#message_success").show();
                         setTimeout(function()
                         {
                            $("#message_success").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
              else
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-coupon-status',
                      data : {status:'0',id:id},
                      success:function(resp)
                      {
                         $("#message_error").show();
                         setTimeout(function()
                         {
                            $("#message_error").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
          });
          //Update Category Status
          $(".FeaturedStatus").change(function(){
              var id = $(this).attr('rel');
              if($(this).prop("checked")==true)
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-featured-product-status',
                      data : {status:'1',id:id},
                      success:function(data)
                      {
                         $("#message_success").show();
                         setTimeout(function()
                         {
                            $("#message_success").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
              else
              {
                 $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      type:'post',
                      url : '/admin/update-featured-product-status',
                      data : {status:'0',id:id},
                      success:function(resp)
                      {
                         $("#message_error").show();
                         setTimeout(function()
                         {
                            $("#message_error").fadeOut("slow");
                         },1000);
                      },
                      error:function()
                      {
                         alert("Xəta");
                      }
                 });
              }
          });

          //add remove attributes
          var maxField = 10; //Input fields increment limitation
          var addButton = $('.add_button'); //Add button selector
          var wrapper = $('.field_wrapper'); //Input field wrapper
          var fieldHTML = '<div style="display:flex;"><input type="text" name="sku[]" id="sku" placeholder="Ölçü kodunu yazın" class="form-control" style="width:115px;"/>&nbsp;&nbsp;<input type="text" name="size[]" id="size" placeholder="Ölçüsünü yazın" class="form-control" style="width:115px;"/>&nbsp;&nbsp;<input type="text" name="price[]" id="price" placeholder="Qiymətini yazın" class="form-control" style="width:115px;"/>&nbsp;&nbsp;<input type="text" name="stock[]" id="stock" placeholder="Sayını yazın" class="form-control" style="width:115px;"/>&nbsp;<a style="color:red;font-weight:bold;" href="javascript:void(0);" class="remove_button">&nbsp;Sil</a></div><br/>'; //New input field html 
          var x = 1; //Initial field counter is 1
          
          //Once add button is clicked
          $(addButton).click(function(){
              //Check maximum number of input fields
              if(x < maxField){ 
                  x++; //Increment field counter
                  $(wrapper).append(fieldHTML); //Add field html
              }
          });
          
          //Once remove button is clicked
          $(wrapper).on('click', '.remove_button', function(e){
              e.preventDefault();
              $(this).parent('div').remove(); //Remove field html
              x--; //Decrement field counter
          });
        
      });
   </script>
   @toastr_js
   @toastr_render
   <script>
      function dash() {
      // single bar chart
      var ctx = document.getElementById("singelBarChart");
      var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
      labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
      datasets: [
      {
      label: "My First dataset",
      data: [40, 55, 75, 81, 56, 55, 40],
      borderColor: "rgba(0, 150, 136, 0.8)",
      width: "1",
      borderWidth: "0",
      backgroundColor: "rgba(0, 150, 136, 0.8)"
      }
      ]
      },
      options: {
      scales: {
      yAxes: [{
          ticks: {
              beginAtZero: true
          }
      }]
      }
      }
      });
            //monthly calender
            $('#m_calendar').monthly({
              mode: 'event',
              //jsonUrl: 'events.json',
              //dataType: 'json'
              xmlUrl: 'events.xml'
          });
      
      //bar chart
      var ctx = document.getElementById("barChart");
      var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
      labels: ["January", "February", "March", "April", "May", "June", "July", "august", "september","october", "Nobemver", "December"],
      datasets: [
      {
      label: "My First dataset",
      data: [65, 59, 80, 81, 56, 55, 40, 65, 59, 80, 81, 56],
      borderColor: "rgba(0, 150, 136, 0.8)",
      width: "1",
      borderWidth: "0",
      backgroundColor: "rgba(0, 150, 136, 0.8)"
      },
      {
      label: "My Second dataset",
      data: [28, 48, 40, 19, 86, 27, 90, 28, 48, 40, 19, 86],
      borderColor: "rgba(51, 51, 51, 0.55)",
      width: "1",
      borderWidth: "0",
      backgroundColor: "rgba(51, 51, 51, 0.55)"
      }
      ]
      },
      options: {
      scales: {
      yAxes: [{
          ticks: {
              beginAtZero: true
          }
      }]
      }
      }
      });
          //counter
          $('.count-number').counterUp({
              delay: 10,
              time: 5000
          });
      }
      dash();         
   </script>
   @include('sweetalert::alert')
</body>
</html>