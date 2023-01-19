jQuery(document).ready(function(){
  jQuery(function() {
        jQuery(this).bind("contextmenu", function(event) {
            event.preventDefault();
              swal({
                  icon: 'error',
                  title: 'Không thể sử dụng chuột phải.',
                  timer: 3000,
                  className: '',
                  
              });
        });
    });
});

