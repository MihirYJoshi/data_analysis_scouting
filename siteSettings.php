<?php

class siteSettings{
  /*Reads and Writes persistent settings for the website.*/
  private $dbIniFile = './db_config.ini';
  private $configKeys = array(
    'server', 'db', 'username', 'password',
    'teamNumber', 'eventCode', 'tbaKey',
    'dataTable', 'tbaTable', 'pitTable', 'strikeTable', 'LSTable'
  );
  public $settings;
  
  function __construct(){
    $this->settings = $this->readDbConfig();
  }
  
  function readDbConfig(){
    // Read dbIniFile
    // If File doesn't exist, instantiate array as empty
    try {
      $ini_arr = parse_ini_file($this->dbIniFile);
    }
    catch (Exception $e){
      $ini_arr = array();
    }
    // If required keys don't exist, instantiate them to default empty string
    foreach ($this->configKeys as $key){
      if (!isset($ini_arr[$key])){
        $ini_arr[$key] = '';
      }
    }
    return $ini_arr;
  }

  function writeDbConfig($dat){
    // Get values to write
    // If value is not in input, read from current DB config
    $currDBConfig = $this->readDbConfig();
    foreach ($dat as $key => $value){
      $currDBConfig[$key] = $value;
    }
    // Build ini file string
    $data = '';
    foreach ($currDBConfig as $key => $value){
      $data = $data . $key . '=' . $value . PHP_EOL;
    }
    // Write ini file string to actual file
    if ($fp = fopen($this->dbIniFile, 'w')){
      $startTime = microtime(True);
      do {
        $writeLock = flock($fp, LOCK_EX);
        if (!$writeLock){
          usleep(round(34760));
        }
      } while ((!$writeLock) and ((microtime(True) - $startTime) < 5));

      if ($writeLock){
        fwrite($fp, $data);
        flock($fp, LOCK_UN);
      }
      fclose($fp);
    }
  }
  
  function get($key){
    return $this->settings[$key];
  }
  
  function getSanitizedConfig(){
    $out = array();
    $out['server']          	= $this->settings['server'];
    $out['db']              	= $this->settings['db'];
    $out['username']        	= $this->settings['username'];
    $out['teamNumber']      	= $this->settings['teamNumber'];
    $out['eventCode']       	= $this->settings['eventCode'];
    $out['tbaKey']          	= substr($this->settings['tbaKey'], 0, 3) . '******';
    $out['dataTable']       	= $this->settings['dataTable'];
    $out['tbaTable']        	= $this->settings['tbaTable'];
    $out['pitTable']   	= $this->settings['pitTable'];
    $out['strikeTable']   	= $this->settings['strikeTable'];
    $out['LSTable']        	   	= $this->settings['LSTable'];
    $out['pictureFolder']       = $this->settings['pictureFolder'];
    return $out;
  }
}

?>