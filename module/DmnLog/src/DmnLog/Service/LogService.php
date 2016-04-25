<?php

namespace DmnLog\Service;


use Zend\Log\LoggerInterface;
use Zend\Log\Writer\Stream;

class LogService 
{
    /**
     * Logger
     *
     * @var string
     */
    protected $logger;
    /**
     * Stream
     *
     * @var string
     */
    protected $stream;
    /**     
     * @var file
     */
    protected $file;
    
    /**
     * Constructor
     *
     * Set directory for a logger. 
     * @param  string $directory
     * @return directory
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($directory = null)
    {
    	if (!is_string($directory)) {
    		throw new \InvalidArgumentException('Directory must be a sting value');
    	}
    	$this->directory=$directory;
    }
    
    /**     
     * @param Logger $logger
     */
    public function setLogger(LoggerInterface $logger){
    	 
    	$this->logger = $logger;
    }
    /**
     *
     * @return $logger
     */
    public function getLogger(){
    
    	return $this->logger;
    } 
    
    protected function setStream($writer){
    	
    	if (!is_string($writer)) {
    		throw new \InvalidArgumentException('The writer must be a sting value');
    	}
    
    	$this->stream=new Stream($writer);
    	
    	return $this->stream;
    	 
    }
    protected function getStream(){
    
    	return $this->stream;
    	 
    }     
    /**
     *Open Stream for Write
     *
     * @param  string $file
     * @return Logger
     * @throws Exception\InvalidArgumentException
     */
    public function openStream($file){
    	
    		if (!is_string($file)) {
    			throw new \InvalidArgumentException('The file must be set before calling function openStream');
    		}
    		
    		$this->logger->addWriter($this->setStream($this->directory.'/'.$file));
    
    	return $this->logger;
    }
    /**
     *Close Stream
     *
     * @param  string $file
     * @return Logger     
     */
    public function closeStream(){
    	
    	$this->stream->shutdown();    	
    	
    }
    
}