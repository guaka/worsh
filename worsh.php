#!/usr/bin/env php
<?php

   /**
worsh is a wordpress shell tool, inspired by drush.ws

(c) 2013 Kasper Souren
See LICENSE
   */


// Report all errors as long as this is in alpha #3
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'wp-config.php';

// Not sure where the newline is coming from #4

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
function worsh_oset($params) {
  print "this doesn't work yet\n";
  var_dump($params);
  print update_option($params[0], $params[1]) . "\n";
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

function worsh_php_eval($params) {
  eval($params[0] . ";");
}

