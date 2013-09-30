$(document).ready(function() {
	$("ul#nav li a").addClass("js");
	$("ul#nav li a").hover(
      function () {
        $(this).stop(true,true).animate({backgroundPosition:"(0 0)"}, 200);
        $(this).animate({backgroundPosition:"(0 -5px)"}, 150);
      }, 
      function () {
        $(this).animate({backgroundPosition:"(0 -112px)"}, 200);

      }
    );

});

function selectTag(selfObj){
	// 标签
	var tag = document.getElementById("worktt").getElementsByTagName("li");
	var taglength = tag.length;
	for(i=0; i<taglength; i++){
	tag[i].className = "";
	}
	selfObj.className = "liover";
	}