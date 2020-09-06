<?php
class InputDataProcessing
{
    private $fieldName = NULL;
    private $fieldType = NULL;
    private $fieldValue = NULL;
    private $errors = "";

    private function getFilterCode($type)
    {
        switch($type)
        {
            case "number":
                {
                    return FILTER_SANITIZE_NUMBER_INT;
                    break;
                }
            case "email":
                {
                    return FILTER_SANITIZE_EMAIL;
                    break;
                }
            default:
                return FILTER_SANITIZE_STRING;
        }
    }
    

    public function __construct($name,$type)
    {
        $this->fieldName = $name;
        $this->fieldType = $type;
        if(isset($_POST[$name]))
            $this->fieldValue = filter_var(($_POST[$name]),$this->getFilterCode($this->fieldType));
    }

   


    public function findErrors()
    {
        if(strlen($this->fieldValue) == 0):
            $this->errors .= $this->fieldName." Cannot be empty<br />";
            return $this->errors;
        else:
            return "";
        endif;
    }

    public function getValue()
    {
        return $this->fieldValue;
    }

    
    


}
?>