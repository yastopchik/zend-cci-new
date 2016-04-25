<?php 
namespace DmnDatabase\Validator;

class RequestValidator
{   
    
    public static function fileExist($filename, $repository, $entityName)
    {  
       return new NoObjectExistsJoin(array('object_repository'=>$repository, 
	  									   'fields' => 'file',
	  									   'messages' => array( NoObjectExistsJoin::ERROR_OBJECT_FOUND => "У Вас еже есть заявка с таким именем файла!")
	  		));
    }  
     
}
