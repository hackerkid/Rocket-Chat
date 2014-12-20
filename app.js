var express = require('express')
  , app = express()
  , http = require('http')
  , server = http.createServer(app)
  , io = require('socket.io').listen(server);

server.listen(8080);


	var guys = ["Ron", "Harry", "Dubledore", "Hermione", "Snape", "Malfoy", "Ginny", "Mcgonagal", "Lupin", "Fred", "George"];


io.sockets.on('connection', function (socket) {
	
	// when the client emits 'adduser', this listens and executes
	socket.on('adduser', function( room){
		socket.username = guys.pop();
		socket.room = room;
		
		socket.join(room);
		// echo to client they've connected
		socket.emit('getRandomUserName', socket.username);
	//	socket.emit('updatechat', 'SERVER', 'You have been magically connected to '+room);

		socket.broadcast.to(room).emit('updatechat', 'SERVER', socket.username + ' has connected to this room');
		//socket.emit('updaterooms', rooms, 'room1');
	});
	
	// when the client emits 'sendchat', this listens and executes
	socket.on('sendchat', function (data) {
		// we tell the client to execute 'updatechat' with 2 parameters
		io.sockets.in(socket.room).emit('updatechat', socket.username, data);
	});
	
	

	// when the user disconnects.. perform this
	socket.on('disconnect', function(){
		// remove the username from global usernames list
		guys.push(socket.username);
		socket.broadcast.emit('updatechat', 'SERVER', socket.username + ' has disconnected');
		socket.leave(socket.room);
	});
});
