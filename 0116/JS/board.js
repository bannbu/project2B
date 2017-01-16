$(function(){
  getComment();
  setInterval(getComment,3000);

});

function getComment(){
var id =  $('#contentArea > .content:eq(0) > input:hidden').attr("value");
// $(".showError > span").remove();
// $('.showError > span').html("");
$.ajax({
  type:"POST",
  url: "searchNewComment.php",
  data: 'content_id='+ id,
  success: function(html){
    $('.showError').html(html);
    // $("#contentArea").prepend(html);

  }
});
console.log(id);
}
