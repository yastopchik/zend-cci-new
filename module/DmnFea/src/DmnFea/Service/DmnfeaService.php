<?php

namespace DmnFea\Service;

use DmnDatabase\Service\Exception\RuntimeException;
use Zend\Dom\Query;
use Zend\Http\Client as HttpClient;
use Zend\Validator\File\Extension;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Mime;
use DmnFea\Options\FeaOptions;
use DmnFea\Options\FeaVisitOptions;
use DmnFea\Options\FeaTranslateOptions;


class DmnfeaService{
    /**
     *
     * @var $directory
     */
    protected $directory;
    /**
     *
     * @var $config
     */
    protected $config;
    /**
     *
     * @var $fileName
     */
    protected $fileName;
    /**
     *
     * @var $mailService
     */
    protected $mailService;
    /**
     *
     * @var $feaOptions
     */
    protected $feaOptions;
    /**
     *
     * @var $feaOptions
     */
    protected $feaVisitOptions;
    /**
     *
     * @var $feaTranslateOptions
     */
    protected $feaTranslateOptions;
    /**
     *
     * @var $visit
     */
    protected $visit;
    /**
     *
     * @var $translate
     */
    protected $translate;
    /**
     *Get Fea Visit Options
     *@return feaVisitOptions
     */
    public function getFeaVisitOptions()
    {
        return $this->feaVisitOptions;
    }
    /**
     *Set Fea Visit Options
     *@return feaVisitOptions
     */
    public function setFeaVisitOptions(FeaVisitOptions $feaVisitOptions)
    {
        $this->feaVisitOptions = $feaVisitOptions;
    
        return $this;
    }
    /**
     *Get Fea Options
     *@return feaOptions
     */
    public function getFeaOptions()
    {
        return $this->feaOptions;
    }
    /**
     *Set Fea Options
     *@return feaOptions
     */
    public function setFeaOptions(FeaOptions $feaOptions)
    {
        $this->feaOptions = $feaOptions;
    
        return $this;
    }
     /**
     *Get Fea Translate Options
     *@return feaTranslateOptions
     */
    public function getFeaTranslateOptions()
    {
        return $this->feaTranslateOptions;
    }
    /**
     *Set Fea Options
     *@return feaOptions
     */
    public function setFeaTranslateOptions(FeaTranslateOptions $feaTranslateOptions)
    {
        $this->feaTranslateOptions = $feaTranslateOptions;
    
        return $this;
    }
    /**
     *Get $fileName
     *@return fileName
     */
    public function getFileName()
    {
        return $this->fileName;
    }
    /**
     *@param array $fileName
     *@return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    
        return $this;
    }
    /**
     *Get $visit
     *@return visit
     */
    public function getVisit()
    {
        return $this->visit;
    }
    /**
     *@param string $visit
     *@return $this
     */
    public function setVisit($visit)
    {
        $this->visit = $visit;
    
        return $this;
    }
    /**
     *Get $translate
     *@return translate
     */
    public function getTranslate()
    {
        return $this->translate;
    }
    /**
     *@param string $translate
     *@return $this
     */
    public function setTranslate($translate)
    {
        $this->translate = $translate;
    
        return $this;
    }
    /**
     *Get mailService
     *@return mailService
     */
    public function getMailService()
    {
        return $this->mailService;
    }
    /**
     *@param string mailService
     *@return $this
     */
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;
    
        return $this;
    }
    /**
     *Get COnfig
     *@return config
     */
    public function getConfig()
    {
        return $this->config;
    }
    /**
     *Set Config
     *@return config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    
        return $this;
    }
    /**
     *Get Directory
     *@return directory
     */
    public function getDirectory()
    {        
        if(null===$this->directory)
            $this->directory=$this->setDirectory();
        return $this->directory;
    }  
    /**
     *Set Directory
     *@return $this->directory
     */
    public function setDirectory()
    {
        $date=new \DateTime('NOW');
        if(is_null($this->directory)){ 
            if(array_key_exists('directory',$this->config)){                     
               $this->directory=$this->config['directory']['fea'].'/'.$date->format('d_m_Y_H_i_s'); 
                if(!is_dir($this->directory))                      
                mkdir($this->directory, 0777, true);
            }
        }    
        return $this->directory;
    }    
	
    public function parseMainSite($url){
        if(!empty($url)){
          $client = new HttpClient();
          $client->setAdapter('Zend\Http\Client\Adapter\Curl');  
          $url='http://cci.mogilev.by/index.php/ru/sobitiya/'.$url;
          $client->setUri($url);
          $result                 = $client->send();
          //content of the web
          $body                   = $result->getBody();        
          $dom = new Query($body);
          $results = $dom->execute('.article-head');        
          $count = count($results); 
          foreach ($results as $result) {      
          return $result->getElementsByTagName("h2")->item(0)->textContent;             
          } 
        }else{
            return $url;
        }       
    }
    /**
     *@param array $data, string $fileName
     *@return adapter
     */
    public function getAdapter(array $data)
    {
        if(!is_null($this->fileName)){
             
            $adapter = new \Zend\File\Transfer\Adapter\Http();
             
            $size = new \Zend\Validator\File\Size(array('max'=>100000));            
    
            $extension = new Extension(array('extension' => array('doc', 'docx'),
    
                    'messages' => array( Extension::FALSE_EXTENSION => "The correct file extension is 'doc', 'docx'" )));    
    
            $adapter->setValidators(array($size, $extension), $this->fileName);
             
        }else{
    
            return null;
        }
        return $adapter;
    }
    /**
     *@param array $data, string $fileName
     *@return adapter
     */
    public function feaReqToDatabase($data)
    {
        $this->sendMail($data);
    }
    
    public function sendMail(array $data)
    {        
        if(!is_null($data['fileupload'])){
            if (!is_array($data['fileupload'])) {
                throw new \InvalidArgumentException('Form upload isn\'t a multiple');
            }
            $current_dir=getcwd();
            chdir($this->directory);            
            foreach ($data['fileupload'] as $key => $value) {                 
                $fileContent = fopen($value['name'], 'r');
                $attachment = new MimePart($fileContent);        
                $attachment->type = "application/octet-stream";
                $attachment->encoding    = Mime::ENCODING_BASE64;
                $attachment->filename = $value['name'];
                $attachment->disposition = Mime::DISPOSITION_ATTACHMENT;
                $this->mailService->setAttachment($attachment);                
            }
            chdir($current_dir);
        } 
        if(!is_null($this->visit)) {
            $options=$this->feaVisitOptions;
            $data['executor']=0;
        } elseif(!is_null($this->translate)) {
            $options=$this->feaTranslateOptions;
            $data['executor']=0;
        } else { 
            $options=$this->feaOptions;        
        }
        
        $this->mailService->send($this->mailService->createHtmlMessage($this->feaOptions->getEmailFromAddress(), 
                                              $options->getEmailToAddress($data['executor']), 
                                              $options->getEmailSubject(), 
                                              $options->getEmailTemplate(), $data));
        $this->mailService->send($this->mailService->createHtmlMessage($this->feaOptions->getEmailFromAddress(),
                                              'ves@ccimogilev.by',
                                              $options->getEmailSubject(),
                                              $options->getEmailTemplate(), $data));
        
        return true;
    }
}

?>