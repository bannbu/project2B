$(function(){
  // getComment();
  setInterval(getComment,10000);
});

function getComment(){
var id =  $('#contentArea > .content:eq(0) > input:hidden').attr("value");
console.log(id);

$.ajax({
  type:"POST",
  url: "searchNewComment.php",
  data: 'content_id='+ id,
  success: function(data){
    $('#contentArea').prepend(data);
    console.log(data);
  }
});

}
