<?php
require_once 'wp-config.php';
require_once 'wp-settings.php';


class ArgParser {

  function __construct($argv) {
    $this->argv = $argv;
  }

  function command() {
    return $this->argv[1];
  }
  
  function params() { 
    return array_slice($this->argv, 2);
  }
}



$a = new ArgParser($argv);

$cmd = $a->command();

if (function_exists('worsh_' . $cmd)) {
  call_user_func('worsh_' . $cmd, $a->params());
}


function worsh_oget($params) {
  print get_option($params[0]) . "\n";
}
