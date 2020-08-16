use std::fs; // library used for allowing rust to use a file in the code
use std::io::prelude::*; // library used for importing on and off traits 
use std::net::TcpListener; // library used for listening to responses of local TCP connection
use std::net::TcpStream; // library used for helping rust to respond to the responses of the local TCP connection
use std::sync::mpsc; // uses library to allow the library and the main file to message each other to make the server work with multiple processes
use std::sync::Arc; // uses library to make sure the threads used in the server are carefully maintained 
use std::sync::Mutex; // uses library to protect the communication between each file between communicating
use std::collections::HashMap; 

let mut username = HashMap::new();
let mut password = HashMap::new();
let mut date = HashMap::new();

fn main() {
	let listener = TcpListener::bind("127.0.0.1:7878").unwrap();

	for stream in  listener.incoming() {
		let stream = stream.unwrap();

		handle_connection(stream);
	}

	username.insert(

	);
}

fn handle_connection(mut stream: TcpStream) {
	let mut buffer = [0; 1024];

	stream.read(&mut buffer).unwrap();

	println!("Request: {}", String::from_utf8_lossy(&buffer[..]));
}