<?php
require_once 'wp-config.php';

// not sure where the newline is coming from

class ArgParser {

  function __construct($argv) {
    $this->argv = $argv;
  }

  function command() {
    return str_replace('-', '_', $this->argv[1]);
  }
  
  function params() { 
    return array_slice($this->argv, 2);
  }
}



$a = new ArgParser($argv);

$cmd = $a->command();

if (function_exists('worsh_' . $cmd)) {
  call_user_func('worsh_' . $cmd, $a->params());
} else {
  print "no command found, TODO: add manual\n";
}


function worsh_oget($params) {
  print get_option($params[0]) . "\n";
}

function mysql_params() {
  return DB_NAME." --host=".DB_HOST." --user=".DB_USER." --password=".DB_PASSWORD."\n";
}

function worsh_sql_connect($params) {
  print 'mysql --database=' . mysql_params();
}

function worsh_exec($command) {
  print "executing $command\n";
  passthru($command);
}

function worsh_sql_cli() {
  print "This doesn't work as expected, yet\n";
  worsh_exec('mysql --database=' . mysql_params());
}

function worsh_sql_dump() {
  worsh_exec('mysqldump ' . mysql_params());
}
