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
  // datatype: "json",
  success: function(data){
    $('#notice').html(data);
    // $("#contentArea").prepend(data);
    console.log(data);
  // if(data !== null){
  //   console.log(data);
  //   console.log("success");
  //   for(var i = 0; i < data.length;i++){
  //     $("#contentArea").prepend(data[i].content_id);
  //   }
  // }

  }
});
// console.log(id);
}

function reload(){
  window.location.reload(true);
}
