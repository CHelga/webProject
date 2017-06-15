$(document).ready(function(){
	$('#content').load('insert_data.php');
	
	$('ul#nav li a').click(function() {
		var page=$(this).attr('href');
		 $('#content').load(page + '.php');
            return false;

	});
	
});


function goBack()
 {
	window.history.back();
 }
 
  function check(){
	 if(!document.getElementById("uzenet_irasa").value)
                {
                     alert("Kérem irjon valamit a textbobxba.");
                    return (false);
                }else
                return (true);
            
 }

