
         function warenkorb_product_list(){
           $.ajax({
             url:'process.php',
             method:'post',
             data:{qty:1},
             success: function(data){
               $("#warenkorb-num").html(data)
             }
           })
         }
         
        $("body").delegate(".add-btn","click",function(event){
          event.preventDefault();
          const pid = $(this).attr('pid');
         
        
         
          $.ajax({
            url:'process.php',
            method:'post',
            data:{quantity:1,product_id:pid },
            success: function(msg){
              console.log(msg);
              warenkorb_product_list();
            },
            error : function(err){
              alert(err);
            }
          });
        });
          
       
      