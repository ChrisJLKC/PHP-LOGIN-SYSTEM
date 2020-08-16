<?php

$socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));

socket_bind($socket, '127.0.0.1', 7878);

while(true) {
    socket_listen($socket, 1);
}

?>