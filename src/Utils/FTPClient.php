<?php declare(strict_types = 1);

namespace App\Utils;

class FTPClient
{
    private $connectionId = null; 
	public $isConnected = false;
	private $host = null; 
	private $username = null; 
	private $password = null;

    public function __construct($host, $username, $password)
    {
        if(!extension_loaded('ftp')) {
			echo "Please enable FTP extension!" . PHP_EOL;
            // throw new \Exception("Please enable FTP extension!");
        }
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
    }
    
    private function createConnection()
	{
		return $this->connectionId = ftp_connect($this->host);
	}

	private function authenticate()
	{
		return ftp_login($this->connectionId, $this->username, $this->password);
	}

	private function passiveMode($passiveMode)
	{
		return ftp_pasv($this->connectionId, $passiveMode);
	}

	public function closeConnection()
	{
		$this->isConnected = false;
		return ftp_close($this->connectionId);
	}

	public function connect($isPassive = true)
	{
		try {
			$this->createConnection();
			if(!$this->connectionId) {
				echo "FTP connection has failed!" . PHP_EOL;
				// throw new \Exception("FTP connection has failed!");
			}
			
			$result =  $this->authenticate();
			if (!$result) {
				echo "Failed to connect to " . $this->host . " for user " . $this->username . PHP_EOL;
				// throw new \Exception("Failed to connect to " . $server . " for user " . $user);
			}

			ftp_set_option($this->connectionId,FTP_TIMEOUT_SEC,60000);
			$this->passiveMode($isPassive);

			$this->isConnected = true;
		} catch (\Exception $e) {
			echo "FTP connection has failed!" . PHP_EOL;
		}

        return $this;
	}

	public function getFile($filePath)
	{
        try {
			$fileName = basename($filePath);

			if (strpos($fileName,'\\') !== false) {
				$tmp = preg_split("[\\\]",$fileName);
				$fileName = $tmp[count($tmp) - 1];
			}

			$fileFolder = str_replace(['/' . $fileName, '\\' . $fileName], '', $filePath);
			$files = ftp_nlist($this->connectionId, $fileFolder);
		
			if(!$files || !in_array($filePath, $files)) {
				return false;
			}

			return true;
		} catch (\Exception $e) {
			echo "FTP: Failed to get file! File Path : " . $filePath . PHP_EOL;
			return false;
		}
	}

	public function getFileContent($filePath)
	{
		$content = null;

		try {
			$file = fopen('php://temp', 'r+');

			ftp_fget($this->connectionId, $file, $filePath, FTP_BINARY, 0);

			$fstats = fstat($file);
			fseek($file, 0);
			$contents = fread($file, $fstats['size']);
			fclose($file);
		} catch (\Exception $e) {
			echo "FTP: Failed to get file content! File Path : " . $filePath . PHP_EOL;
		}

		return $contents;
	}

	public function setFileContent($filePath, $content)
	{
		try {
			$file = tmpfile();
			$path = stream_get_meta_data($file)['uri'];
			file_put_contents($path, $content);
			ftp_put($this->connectionId, $filePath, $path, FTP_BINARY);
			fclose($file);
		} catch (\Exception $e) {
			echo "FTP: Failed to set file content! File Path : " . $filePath . PHP_EOL;
		}
	}
}