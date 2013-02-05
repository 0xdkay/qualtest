

jQuery(document).ready(function($) {
  var path = location.pathname;
  var selectedId = path.substring(path.lastIndexOf("/")+1, path.indexOf(".php"));
  $('#nav>li').each( function() {
  	if($(this).find("a").attr("href")){
			if($(this).find("a").attr("href").indexOf(selectedId)!=-1){
				$(this).addClass('selected');
			}else{
				$(this).removeClass('selected');
			}
		}
  });

	$('.notice_title').hover( function() {
		$(this).css('color', '#09D4FF');
	}, function() {
		$(this).css('color', '#444');
	});

});

function deleteCheck(no, title){
	var retConfirm = confirm("Delete '"+title+"'\nReally Delete?"); 
	if (retConfirm) {
		document.location='delete.php?no='+no;
	}
}

function deleteCheckProb(no, title){
	var retConfirm = confirm("Delete '"+title+"'\nReally Delete?"); 
	if (retConfirm) {
		document.location='probdelete.php?no='+no;
	}
}





