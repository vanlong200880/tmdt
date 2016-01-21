jQuery(document).ready(function($) {
  $('form#voted_form').on('submit', function(e){
    var user_id = $("#user_id").val();
    var post_id = $("#post_id").val();
    var position = $("#ex1").val();
    var price = $("#ex2").val();
    var quality = $("#ex3").val();
    var service = $("#ex4").val();
    var space = $("#ex5").val();
//    alert(space);
    var data = {
      'post_id': user_id,
      'user_id': post_id,
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
            console.log(data);
        }
    });
//    console.log(data);
    e.preventDefault();
  });
    
});