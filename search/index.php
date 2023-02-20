<!DOCTYPE html>
<html>
 <head>
  <title>Project</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  #result {
   position: absolute;
   width: 100%;
   max-width:870px;
   cursor: pointer;
   overflow-y: auto;
   max-height: 400px;
   box-sizing: border-box;
   z-index: 1001;
  }
  .link-class:hover{
   background-color:#f1f1f1;
  }
  </style>
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:900px;">
   <h2 align="center">JSON Live Data Search using Ajax JQuery</h2>
   <h3 align="center">Employee Data</h3>   
   <br /><br />
   <div align="center">
    <input type="text" name="search" id="search" placeholder="Search Employee Details" class="form-control" />
   </div>
   <ul class="list-group" id="result">
   </ul>
   <br>
	<input type="text" id="refnum" />
	<input type="text" id="amount" />
   <br />
  </div>
 </body>
</html>


<script>
$(document).ready(function(){
	$('#search').keyup(function(){
	  $('#result').html('');
	  $('#state').val('');
	  $('#refnum').val('');
	  $('#amount').val('')
	  var searchField = $('#search').val();
		$.ajax({
			type: "GET",
			dataType: "json",
			url: "search.php?refnum=" + searchField,
			success: function(data) {
				var output = '';
				var listGroup = $('#result');
				
				if(data.length > 0) {
					
					data.forEach(function(item) {
						output += '<li class="item" refnum="'+item.refnum+'" amount="'+item.amount+'">'+ item.refnum + '</li>';
					});
					
				} else {
					output += '<li>Did not match</li>';
				}
				listGroup.html(output);
				
				var item = $('.item');
				
				item.click(function() {
					$('#refnum').val($(this).attr("refnum"));
					$('#amount').val($(this).attr("amount"));
					
				})
			}
		});
	 });
});

</script>