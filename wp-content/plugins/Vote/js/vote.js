jQuery(document).ready(function($) {
  $('form#voted_form').on('submit', function(e){
    var user_id = $("#user_id").val();
    var post_id = $("#post_id").val();
    var position = $("#ex1").val();
    var price = $("#ex2").val();
    var quality = $("#ex3").val();
    var service = $("#ex4").val();
    var space = $("#ex5").val();
    var data = {
      'user_id': user_id,
      'post_id': post_id,
      'position': position,
      'price': price,
      'quality': quality,
      'service': service,
      'space': space,
      'action': 'voted_action'
    };
    $.ajax({
        url : ajax.url,
        type : 'POST',
        dataType : "json",
        data: data,
        success : function (data){
          $(".vote-message").empty().append(data.message);
          console.log(data);
          if(data.result.length != 0){
            $("#view-quality").empty().append(data.result.quality);
            $("#view-price").empty().append(data.result.price);
            $("#view-service").empty().append(data.result.service);
            $("#view-space").empty().append(data.result.space);
            $("#view-position").empty().append(data.result.position);
          }
          
          setTimeout(function(){
              $('.modal-vote').modal('hide');
          }, 500);
        }
    });
    e.preventDefault();
  });
    
});