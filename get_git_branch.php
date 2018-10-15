<?php
$username = $argv[1];
$password = $argv[2];
$server_name = $argv[3];
$code_dir = $argv[4];
$connection = ssh2_connect($server_name, 22);
ssh2_auth_password($connection, $username, $password);
$stream = ssh2_exec($connection, 'cd '. $code_dir .';git branch -r;');
stream_set_blocking($stream, true);
$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
$output =  stream_get_contents($stream_out);
echo "Your code is running on ".trim($output) . " branch on " . $server_name. "\n";
?>
