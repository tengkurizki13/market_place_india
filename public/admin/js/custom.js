$(document).ready(function(){

    // call datatable class
    $('#sections').DataTable();
    $('#catagories').DataTable();

    $('.nav-item').removeClass("active");
    $('.nav-link').removeClass("active");

    // Check Admin Password carrect or no
    $('#current_password').keyup(function(){
        var current_password = $('#current_password').val();
        // alert(current_password);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/check-admin-password',
            data:{current_password:current_password},
            success:function(resp){
                if(resp == false){
					$("#check_password").html("<font color='red'>Current Password is Incorrect!</font>")
				}else if(resp==true){
					$("#check_password").html("<font color='green'>Current Password is Correct!</font>")
				}
            },
            error:function(){
                alert('error')
            }
        });
    });

    // update section Admin
    $(document).on('click',".updateAdminStatus",function(){
        var status = $(this).children('i').attr('status');
        var admin_id = $(this).attr('admin_id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp){
			if (resp['status'] == 1) {
                $('#admin-'+ admin_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>')
            }else if(resp['status'] == 0){
                $('#admin-'+ admin_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>')

            }
            },
            error:function(){
                alert('error')
            }
        });
    })


    // update section Status
    $(document).on('click',".updateSectionStatus",function(){
        var status = $(this).children('i').attr('status');
        var section_id = $(this).attr('section_id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp){
			if (resp['status'] == 1) {
                $('#section-'+ section_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>')
            }else if(resp['status'] == 0){
                $('#section-'+ section_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>')

            }
            },
            error:function(){
                alert('error')
            }
        });
    })


      // update catagory Status
      $(document).on('click',".updateCatagoryStatus",function(){
        var status = $(this).children('i').attr('status');
        var catagory_id = $(this).attr('catagory_id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-catagory-status',
            data:{status:status,catagory_id:catagory_id},
            success:function(resp){
			if (resp['status'] == 1) {
                $('#catagory-'+ catagory_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i>')
            }else if(resp['status'] == 0){
                $('#catagory-'+ catagory_id).html('<i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i>')

            }
            },
            error:function(){
                alert('error')
            }
        });


    })


    
    $('#section_id').change(function(){
        var section_id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'get',
            url:'/admin/append-catagories-level',
            data:{section_id:section_id},
            success:function(resp){
                $("#appendCatagoriesLevel").html(resp);
            },
            error:function(){
                alert('error')
            }
        });
    });
    

    // // Confirm Deletion Simple JS

    // $(".confirmDelete").click(function(){
    //     var title = $(this).attr('title');
    //     if (confirm("Are you sure to delete this "+title+"?")) {
    //         return true;
    //     }else{
    //         return false;
    //     }
    // })


    // Confirm Deletion SweatAlert2 library

    $(".confirmDelete").click(function(){
        var module = $(this).attr('module');
        var moduleId = $(this).attr('moduleId');
      
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              window.location = "/admin/delete-"+module+"/"+moduleId;
            }  
          })
    })
}) ;