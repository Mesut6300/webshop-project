//-------- get the count of products in basket start ------------
    function warenkorb_count(){
        $.ajax({
          url:'process.php',
          method:'post',
          data:{count:1},
          success: function(data){
            $("#warenkorb-num").html(data)
          }
        })
      }
//-------- get the count of products in basket end ------------
         
         
         
// ------------- add product to basket start ----------------

        $("body").delegate(".add-btn","click",function(event){
          event.preventDefault();
          const pid = $(this).attr('pid');
         
        
         
          $.ajax({
            url:'process.php',
            method:'post',
            data:{quantity:1,product_id:pid },
            success: function(msg){
              console.log(msg);
              warenkorb_count();

            },
            error : function(err){
              alert(err);
            }
          });
        });
 // ------------- add product to basket end ----------------

// ------------- get all  products in basket (for the loggedin user ) from database start ----------------
 function warenkorb_products_list(){
    $.ajax({
      url:'process.php',
      method:'post',
      data:{get_warenkorb_products:1},
      success: function(data){
      $("#warebkorb-content").html(data)
        
      }
    })
  }

  // ------------- get all  products in basket (for the loggedin user ) from database  end ----------------

          
 // ------------- increase products in basket start ----------------

 $("body").delegate(".add-to-warenkorb","click",function(event){
    event.preventDefault();
    const oid = $(this).attr('oid');
    console.log(oid);
     
   
  
   
    $.ajax({
      url:'process.php',
      method:'post',
      data:{qty:1,oid:oid },
      success: function(msg){
        console.log(msg);
        warenkorb_count();
        warenkorb_products_list()

      },
      error : function(err){
        alert(err);
      }
    });
  });
// ------------- decrease products from basket end ----------------

// ------------- decrease products in basket start ----------------

$("body").delegate(".remove-from-warenkorb","click",function(event){
    event.preventDefault();
    const oid = $(this).attr('oid');
    
    $.ajax({
      url:'process.php',
      method:'post',
      data:{qty:-1,oid:oid },
      success: function(msg){
        console.log(msg);
        warenkorb_count();
        warenkorb_products_list()

      },
      error : function(err){
        alert(err);
      }
    });
  });

  // ------------- decrease products in basket end ----------------

  // ------------- remove product from  basket start ----------------

$("body").delegate(".remove-product-from-warenkorb","click",function(event){
    event.preventDefault();
    const oid_remove = $(this).attr('oid_remove');
    
    $.ajax({
      url:'process.php',
      method:'post',
      data:{oid_remove },
      success: function(msg){
        console.log(msg);
        warenkorb_count();
        warenkorb_products_list();

      },
      error : function(err){
        console.log(err);
      }
    });
  });

  // -------------  remove product from  basket end ----------------