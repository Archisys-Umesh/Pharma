<?php declare(strict_types = 1);

namespace App\Utils;

class SFTPClient
{
    private $connectionId = null, $sftp;
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
		return $this->connectionId = @ssh2_connect($this->host, 22);
	}

	private function authenticate()
	{
		return @ssh2_auth_password($this->connectionId, $this->username, $this->password);
	}

	public function closeConnection()
	{
		$this->isConnected = false;
		return @ssh2_disconnect($this->connectionId);
	}

	public function connect()
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

			$this->sftp = @ssh2_sftp($this->connectionId);
			if (! $this->sftp) {
				echo "Could not initialize SFTP subsystem." . PHP_EOL;
				// throw new Exception("Could not initialize SFTP subsystem.");
			}

			$this->isConnected = true;
		} catch (\Exception $e) {
			echo "FTP connection has failed!" . PHP_EOL;
		}
		$this->isConnected = true;
        return $this;
	}

	public function getFile($filePath)
	{
		try {
			$sftp = $this->sftp;
			$realpath = @ssh2_sftp_realpath($sftp, $filePath);
			return is_file("ssh2.sftp://$sftp$realpath");
		} catch (\Exception $e) {
			echo "FTP: Failed to get file! File Path : " . $filePath . PHP_EOL;
			return false;
		}
	}

	public function getFileContent($filePath)
	{
		$content = null;
		try {
			$sftp = $this->sftp;
			$stream = @fopen("ssh2.sftp://".$sftp.$filePath, 'r');
			if (! $stream) {
				echo "Could not open file File Path : " . $filePath . PHP_EOL;
				// throw new \Exception("Could not open file File Path : " . $filePath);
			} else {
				$content = @stream_get_contents($stream);
			}
			@fclose($stream);
		} catch (\Exception $e) {
			echo "FTP: Failed to get file content! File Path : " . $filePath . PHP_EOL;
		}
		
		return $content;
	}

	public function setFileContent($filePath, $content)
	{
		try {
			$sftp = $this->sftp;
			$realpath = @ssh2_sftp_realpath($sftp, $filePath);
			$stream = @fopen("ssh2.sftp://$sftp$realpath", 'w');
			@fwrite($stream, $content);
			@fclose($stream);	
		} catch (\Exception $e) {
			echo "FTP: Failed to set file content! File Path : " . $filePath . PHP_EOL;
		}
	}
}