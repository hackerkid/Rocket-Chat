<script src="socket.io.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script>
	var socket = io.connect('http://localhost:8080');


	var roomId = "Babblenow Discusions";
	var fakeId = "";// would be send via server
	socket.on('connect', function(){
		
		
		socket.emit('adduser', roomId);

	});

	socket.on('getRandomUserName', function (x){
		
		
		fakeId = x;
		



	}); 

	


	socket.on('updatechat', function (username, data) {
		$('#conversation').append('<b>'+username + ':</b> ' + data + '<br>');
	});

	

	
	$(function(){
		// when the client clicks SEND
		$(document).ready(function(){
  			
  			 $.ajax({                                      
      			url: 'fetchmessage.php', 
      			type: 'POST',                 //the script to call to get data          
      			data: {room:roomId},                        //you can insert url argumnets here to pass to api.php
                dataType: 'json',                //data format      
     			success: function(data) {
     				//var obj = JSON.parse(data);
     				
					for(var i = data.length-1; i >= 0; i--) {
						var usenam = data[i]["author"];
						var mes = data[i]["message"];
						$('#conversation').append('<b>'+usenam + ':</b> ' + mes + '<br>');

					}
					
  					
  				}
  			});


		}); 

		$('#datasend').click( function() {
			var message = $('#data').val();
			$('#data').val('');
			socket.emit('sendchat', message);
			
			$.ajax({
				url: "sendmessage.php",
				type: 'POST',
				data : {name: fakeId, message: message, room: roomId},
				dataType: 'json',
				sucess:function(data) {


				}
			});

			
		});

		// when the client hits ENTER on their keyboard
		$('#data').keypress(function(e) {
			if(e.which == 13) {
				$(this).blur();
				$('#datasend').focus().click();
			}
		});
	});

</script>
<div style="float:left;width:100px;border-right:1px solid black;height:300px;padding:10px;overflow:scroll-y;">
	<b>Keep Calm and enjoy magic</b>
	<div id="rooms"></div>
</div>
<div style="float:left;width:300px;height:250px;overflow:scroll-y;padding:10px;">
	<div id="conversation"></div>
	<input id="data" style="width:200px;" />
	<input type="button" id="datasend" value="send" />
</div>
