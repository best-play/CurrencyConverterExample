<?php


namespace Logger;


class Logger
{
    /**
     * @var string
     */
    private $logger_string;

    /**
     * @var string
     */
    private $user_remote_addr;

    /**
     * @var array
     */
    private $result;


    /**
     * Constructor.
     * @param $user_addr string
     */
    public function __construct($user_addr)
    {
        $this->logger_string = "";
        $this->user_remote_addr = $user_addr;
    }

    /**
     * Main function.
     *
     * @return Logger.
     */
    public function log()
    {
        $this->logger_string = "User: ".date("j F Y, H:i:s").' - '.$this->user_remote_addr.PHP_EOL.
            $this->getResult()['amount']." ".$this->getResult()['from']." -> ".$this->getResult()['result']." ".$this->getResult()['to'].PHP_EOL.
            "-------------------------".PHP_EOL;

        file_put_contents('currency.txt', $this->logger_string, FILE_APPEND);

        return $this;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param array $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

}
