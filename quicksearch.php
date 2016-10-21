<title>Quick Search!</title>
<?php 
	include "header.php";
?>

<iframe id="results" src="searchresult.php?SearchQuery=<?php echo $_GET["SearchQuery"] ?>" frameborder="0" scrolling="no" style="width:100%;height:100%;"></iframe>


<script type="text/javascript">

	
/*
	function searchTyped(){

	 var key = event.keyCode || event.charCode;

	    if( key == 8 || key == 46 )
	        return false;

		
	}*/

	document.getElementById('searchbox').addEventListener("keydown", KeyCheck);  //or however you are calling your method
	


	function KeyCheck(event){
		val=(document.getElementById('searchbox').value+String.fromCharCode(event.keyCode));
		if(event.keyCode==8 || event.keyCode==46){
			console.log("back");
			val=val.substring(0,val.length-2);
		}
		console.log(val);
		document.getElementById('results').src="searchresult.php?SearchQuery="+val;
	}

</script>