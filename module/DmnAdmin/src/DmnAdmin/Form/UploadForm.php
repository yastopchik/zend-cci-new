<?php
namespace DmnAdmin\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class UploadForm extends Form
{    
    public function __construct()
    {
        parent::__construct('Upload');  
        $this->setAttribute('method', 'post'); 
        $this->setHydrator(new ClassMethods(false));
        $this->setAttribute('enctype','multipart/form-data'); 
        $this->setAttribute('id','uploadForm');
        $this->add(array(
            'name' => 'fileupload',
            'attributes' => array(
                'type'  => 'file',
            )            
         )); 
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Загрузить'
            ),
        ));   
    }   
}
