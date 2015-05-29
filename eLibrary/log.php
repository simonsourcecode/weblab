<?php

/**
 *
 * @Class logwrite
 *
 * @Purpose: Logs text to a file
 *
 * @Author: Kevin Waterson
 *
 * @copyright PHPRO.ORG (2009)
 *
 * @example usage
 * $log = logger::getInstance();
 * $log->logfile = '/tmp/errors.log';
 * $log->write('An error has occured', __FILE__, __LINE__);
 *
 */
class log
{
    /*** Declare instance ***/
    private static $instance = NULL;
	private $filename;

    /**
     *
     * @Constructor is set to private to stop instantion
     *
     */
    private function __construct()
    {
    }

    /**
     *
     * @settor
     *
     * @access public
     *
     * @param string $name
     *
     * @param mixed $value
     *
     */
    public function __set($name, $value)
    {
        switch($name)
        {
            case 'filename':
            if(!file_exists($value) || !is_writeable($value))
            {
                throw new Exception("$value is not a valid file path");
            }
            $this->filename = $value;
            break;

            default:
            throw new Exception("$name cannot be set");
        }
    }

    /**
     *
     * @write to the logfile
     *
     * @access public
     *
     * @param string $message
     *
     * @param string $file The filename that caused the error
     *
     * @param int $line The line that the error occurred on
     *
     * @return number of bytes written, false other wise
     *
     */
    public function write($message, $file=null, $line=null)
    {
        $time=date("l dS \of F Y h:i:s A");
		$message = $time .' - '.$message;
        $message .= is_null($file) ? '' : " in $file";
        $message .= is_null($line) ? '' : " on line $line";
        $message .= "\n";
        return file_put_contents( $this->filename, $message, FILE_APPEND );
    }

    /**
    *
    * Return logwrite instance or create new instance
    *
    * @return object (PDO)
    *
    * @access public
    *
    */
    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new log;
        }
        return self::$instance;
    }


    /**
     * Clone is set to private to stop cloning
     *
     */
    private function __clone()
    {
    }

} /*** end of log class ***/

?>



<?php

try
{
    /*** a new log instance ***/
    $log = log::getInstance();
    /*** the file to write to ***/
    $log->filename = './log/elibrary.log';
	/*** message array ***/
	$message=array("0"=>"add","1"=>"modify","2"=>"delete");
	/*** get current user ***/
	$username=$_SESSION['username'];
    $log->write('\r\n An operation has occured', __FILE__, __LINE__);
}
catch(Exception $e)
{
     /*** write an error message with filename and line number ***/
    $log->write('\r\n An error has occured', __FILE__, __LINE__);
	echo $e->getMessage();
}
?>