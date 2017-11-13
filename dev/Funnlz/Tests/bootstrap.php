<?php
namespace Funnlz\Tests;

require '../../vendor/autoload.php';

define('BASEPATH',realpath(dirname(__FILE__).'/../'));
//define('LOCK_FILE','reminder.lock');
//define('LOCK_FILE_PATH', dirname(__FILE__).'/'.LOCK_FILE);
define('LOG_FILE','tests.log');
define('LOG_FILE_PATH', dirname(__FILE__).'/'.LOG_FILE);

class Bootstrap{
	static public function autoloader($className)
	{	
		if (strpos($className, 'CI_') !== 0 && strpos($className,'PHPUnit')!==0)
		{
			
			$className = ltrim($className, '\\');
			$fileName  = '';
			$namespace = '';
			if ($lastNsPos = strrpos($className, '\\')) {
				$namespace = substr($className, 0, $lastNsPos);
				$className = substr($className, $lastNsPos + 1);
				$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			}
			$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
			$fpath = dirname(BASEPATH).DIRECTORY_SEPARATOR.$fileName;
			if(file_exists($fpath)){
                require $fpath;
            }
		}
	} 
	static public  function log_status($text){	
		$f = fopen(LOG_FILE_PATH,'a+');
		fwrite($f, TimeHelper::get_time_in_utc()." - ".$text."\r\n");
		fclose($f);
	}
	/*
	static public function run(){
		//create lock so that it only run once
		if(file_exists(LOCK_FILE_PATH)){
			self::log_status("lock file exist");
			exit(0);
		}
		$f = fopen(LOCK_FILE_PATH,'w+');
		fwrite($f,'running');
		fclose($f);
		
		$helper = new DBHelper();
		$helper->set_connection_params(DBConfig::$hostname,DBConfig::$username,DBConfig::$password,DBConfig::$dbname);

		$process = new SettingProcess($helper);
		$reminder_date = $process->get_reminder_date();
		$now = TimeHelper::get_time_in_utc();
		if(TimeHelper::compare_date_time($now,$reminder_date)=='-'){
			self::log_status('sending email');
			$userprocess = new UserProcess($helper);
			$gssprocess = new GssProcess($helper);
			
			$users = $userprocess->get_registered_users();
			if($users!=NULL){
				foreach($users as $user){
					$ret = $gssprocess->email_schedule_reminder($user->username);
					self::log_status('email sent to :'.$user->username.' status: '.$ret);
				}		
				self::log_status('done');
			}else{
				self::log_status('no user');
			}
		}else{
			echo 'not now';
		}
		unlink(LOCK_FILE_PATH);
	}*/
}	
error_reporting(E_ALL);
spl_autoload_register(__NAMESPACE__ .'\Bootstrap::autoloader');
//Bootstrap::run();
