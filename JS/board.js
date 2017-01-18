$(function(){
  // getComment();
  setInterval(getComment,10000);

});

function getComment(){
var id =  $('#contentArea > .content:eq(0) > input:hidden').attr("value");
console.log(id);
// $(".showError > span").remove();
// $('.showError > span').html("");
$.ajax({
  type:"POST",
  url: "searchNewComment.php",
  data: 'content_id='+ id,
  // datatype: "json",
  success: function(data){
    $('#contentArea').prepend(data);
    // $("#contentArea").prepend(data);
    console.log(data);
  }
});
// console.log(id);
}

function reload(){
  window.location.reload(true);
}
