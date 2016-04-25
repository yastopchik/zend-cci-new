<?php

namespace DmnAdmin\Form;

use Zend\InputFilter\InputFilter;

class UploadFilter extends InputFilter
{
    protected $emailValidator;

    public function __construct()
    {
    	$this->add(array(
    			'name'       => 'fileupload',
    			'required'   => true,    			
    	));
    }
   
}
