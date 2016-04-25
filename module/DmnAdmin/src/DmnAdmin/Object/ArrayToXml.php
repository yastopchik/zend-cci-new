<?php

namespace DmnAdmin\Object;


class ArrayToXml {
	 
	private $writer;
	private $version = '1.0';
	private $encoding = 'UTF-8';
	private $rootName = 'root';
	private $file;
	 

	function __construct() {
		$this->writer = new \XMLWriter();
	}
	 
	public function convert($data) {
		$this->writer->openMemory();
		$this->writer->setIndent(true);
		$this->writer->startDocument($this->version, $this->encoding);
		$this->writer->startElement($this->rootName);
		if (is_array($data)) {
			$this->getXML($data);
		}
		$this->writer->endElement();
		return $this->writer->outputMemory();
	}	
	public function convertToFile($data) {
	    if(!is_null($this->file))
	    $this->writer->openURI($this->file);	    
	    $this->writer->setIndent(true);
	    $this->writer->startDocument($this->version, $this->encoding);
	    $this->writer->startElement($this->rootName);
	    if (is_array($data)) {
	        $this->getXML($data);
	    }
	    $this->writer->endElement();	    
	}
	public function flush() {	    
	    $this->writer->flush();	   
	}
	public function setFile($file) {
	    $this->file = $file;
	}
	public function setVersion($version) {
		$this->version = $version;
	}
	public function setEncoding($encoding) {
		$this->encoding = $encoding;
	}
	public function setRootName($rootName) {
		$this->rootName = $rootName;
	}
	private function getXML($data) {
		foreach ($data as $key => $val) {	
			if (is_array($val)) {
				if (!is_numeric($key)){
					$this->writer->startElement($key);
					$this->getXML($val);
					$this->writer->endElement();
				}else{
					$this->getXML($val);
				}
			}
			else {
				$this->writer->writeElement($key, str_replace('"', '\'', stripslashes($val)));
			}
		}
	}
}