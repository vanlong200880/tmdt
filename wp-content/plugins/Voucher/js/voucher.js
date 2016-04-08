jQuery(document).ready(function($) {
  
  $(".form-voucher ").on('click', '.send.vald-code', function(e){
    var code = $("#voucher-code").val();
    var post_id = $("#post-voucher-id").val();
    var datacode = {
        'code': code,
        'post_id' : post_id,
        'action' : 'voucher_active_code_action'
      };
    $.ajax({
        url : ajax.url,
        type : 'POST',
        dataType : "json",
        data: datacode,
        beforeSend: function(){
          $(".submit-voucher .image-loading").css('display', 'inline-block');
        },
        success : function (data){
          $(".form-voucher h4").empty().append(data.message);
          $(".submit-voucher .image-loading").css('display', 'none');
          if(data.status == true){
            window.location.reload(true);
          }
        }
      });
      e.preventDefault();
  });
  $("ul.list-voucher-free > li p.payment a").on('click', function(){
    $code = $(this).attr('data-code');
//    alert($code);
    $('.voucher-modal').modal('show');
    $("#voucher-code").val($code);
    $('form#voucher_form').on('submit', function(e){
      var fullname = $("#voucher-fullname").val();
      var email = $("#voucher-email").val();
      var phone = $("#voucher-phone").val();
      var note = $("#voucher-note").val();
      var code = $("#voucher-code").val();
      var total = $("#voucher-total").val();
      var data = {
        'fullname': fullname,
        'email': email,
        'phone': phone,
        'note': note,
        'code': code,
        'total': total,
        'action': 'voucher_action'
      };
      $.ajax({
        url : ajax.url,
        type : 'POST',
        dataType : "json",
        data: data,
        beforeSend: function(){
          $(".image-loading").css('display', 'inline-block');
        },
        success : function (data){
          $(".image-loading").css('display', 'none');
          if(data.status == true){
            $(".voucher-error").empty();
            var templateUrl = 'http://coupon.unimedia.vn/wp-content/themes/tmdt_magazine';
            $(".form-voucher").empty().append('<h4>'+data.message+'</h4><div class="form-group"><label for="voucher-name">Nhập mã kích hoạt</label><input type="hidden" id="post-voucher-id" name="post-voucher-id" value="'+data.post_id+'"><input type="text" class="form-control active-code" id="voucher-code" name="voucher-code"></div><div class="form-group submit-voucher"><button type="submit" class="btn btn-primary send vald-code">Kích hoạt</button> <img class="image-loading" src="'+templateUrl+'/images/Floating rays-32.gif" width="20px" style="display: none;"></div>');
          }else{
            $(".voucher-error").empty().append(data.error);
          }
        }
      });
      e.preventDefault();

    });
  });
  // gen code voucher
  $(".gencode").on('click', '#submit', function(e){
    var code = $("#voucher-name").val();
    var quanlity = $("#voucher-number").val();
    var datacode = {
        'code': code,
        'quanlity' : quanlity,
        'action' : 'gen_code_action'
      };
    $.ajax({
        url : ajax.url,
        type : 'POST',
        dataType : "json",
        data: datacode,
        success : function (data){
          $("#result-code").val(data.listcode);
          $html = '';
          $.each( data.result.list, function( key, value ) {
            
            $html += '<div class="item" style="width: 120px;height: 40px;text-align: left;line-height: 40px;float: left;">'+value+'</div>';
          });
          $(".lst-code").empty().append($html);
        }
      });
      e.preventDefault();
  });
  
  // view voucher popup
  
  $("ul.list-voucher-free > li .img").on('click', function(){
    var id = $(this).attr('data-id');
//    alert($code);
//    $('.voucher-modal').modal('show');
//    $("#voucher-code").val($code);
//    $('form#voucher_form').on('submit', function(e){
//      var fullname = $("#voucher-fullname").val();
//      var email = $("#voucher-email").val();
//      var phone = $("#voucher-phone").val();
//      var note = $("#voucher-note").val();
//      var code = $("#voucher-code").val();
//      var total = $("#voucher-total").val();
      var data = {
        'id': id,
        'action': 'voucher_detail_action'
      };
      $.ajax({
        url : ajax.url,
        type : 'POST',
        dataType : "json",
        data: data,
        beforeSend: function(){
         // $(".image-loading").css('display', 'inline-block');
        },
        success : function (data){
          console.log(data);
//          $(".image-loading").css('display', 'none');
//          if(data.status == true){
//            $(".voucher-error").empty();
//            var templateUrl = 'http://coupon.unimedia.vn/wp-content/themes/tmdt_magazine';
//            $(".form-voucher").empty().append('<h4>'+data.message+'</h4><div class="form-group"><label for="voucher-name">Nhập mã kích hoạt</label><input type="hidden" id="post-voucher-id" name="post-voucher-id" value="'+data.post_id+'"><input type="text" class="form-control active-code" id="voucher-code" name="voucher-code"></div><div class="form-group submit-voucher"><button type="submit" class="btn btn-primary send vald-code">Kích hoạt</button> <img class="image-loading" src="'+templateUrl+'/images/Floating rays-32.gif" width="20px" style="display: none;"></div>');
//          }else{
//            $(".voucher-error").empty().append(data.error);
//          }
        }
      });
//      e.preventDefault();

//    });
  });
    
});