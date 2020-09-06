<?php
    require_once("utility.php");
    class UploadProcess
    {
        //max file size to upload
        private const MAXSIZE = 1000000;

        //utility object
        private $util = NULL;

        //file properties
        private $fileName = "";
        private $fileExtension = "";
        private $fileMimeType = "";
        private $fileSize = "";
        private $fileTmp = "";
        private $errorNum = 0;

        //allowed types array
        private $allowedMIMES = array("text/csv","text/plain");

        //errors to check all at end before uploading
        private $errors = array();


        private function findErrors()
        {
            if($this->errorNum == 4):
                array_push($this->errors,"No File Choosen");
                return;
            endif;
            if($this->errorNum == 2 || $this->fileSize > self::MAXSIZE):
                array_push($this->errors,"File greater than ".(self::MAXSIZE/1000000)."MB");
            endif;

            if($this->fileExtension !== "csv"):
                array_push($this->errors,"File type is not supported (Only CSV)");
            endif;  
        }

        private function checkMIMEAfterUpload()//two-step verification
        {
            if(in_array($this->fileMimeType,$this->allowedMIMES)):
                $this->util->produceSuccessMsg("File uploaded Successfully");
                return TRUE;
            else:
                $this->util->produceErrorMsg("File deleted , detect wrong type (NOT CSV)");
                unlink(__DIR__."/".$this->fileName);
                return FALSE;
            endif;
        }

        public function __construct($field_name)
        {
            $this->util = new Utility();
            $this->fileName = $_FILES[$field_name]['name'];
            $this->fileSize = $_FILES[$field_name]['size'];
            $nameParts = explode(".",$this->fileName);
            $this->fileExtension = strtolower(end($nameParts));
            $this->fileTmp = $_FILES[$field_name]['tmp_name'];
            $this->errorNum = $_FILES[$field_name]['error'];
            $this->findErrors();
        }

        public function upload_file()
        {
            if(count($this->errors) == 0):
                move_uploaded_file($this->fileTmp,__DIR__."/"."file.".$this->fileExtension);
                $this->fileMimeType = mime_content_type(__DIR__."/"."file.".$this->fileExtension);
                return $this->checkMIMEAfterUpload();
            else:
                $this->util->produceErrors("File can't be uploaded due to this reasons:",$this->errors);
                return FALSE;
            endif;
        }

        

        

    }
?>