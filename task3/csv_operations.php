<?php
require_once("utility.php"); 
class CSV
{
    private $file;
    private $util;
    private $streamHandler;

    public function __construct($fpath)
    {
        $this->util = new Utility();
        $this->file = $fpath;
        if(!file_exists($this->file)):
            $this->util->produceErrorMsg("File [".$this->file."] not exist please upload it first");
        else:
            $this->streamHandler = fopen($this->file,"r");
        endif;
    }

    private function readRawRow()
    {
        if($this->streamHandler !== FALSE):
            return fgetcsv($this->streamHandler);
        else:
            $this->util->produceErrorMsg("Can't open file");
            return NULL;
        endif;
    }

    private function extractIDS($row)
    {
        $client = explode("@",$row[0]);
        $deal = explode("#",$row[1]);
        return "'".$client[0]."','".$client[1]."','".$deal[0]."','".$deal[1]."',";
    }

    public function createFormatedRow()
    {
        $rawRow = $this->readRawRow();
        if($rawRow !== FALSE):
            $strRow = $this->extractIDS($rawRow);
            $rowLen = count($rawRow);;
            for($i = 2; $i < $rowLen;  $i++):
                $strRow .= "'".$rawRow[$i]."',";
            endfor;
            return trim($strRow,',');
        else:
            return NULL;
        endif;
    }

    public function lineCounts()
    {
        return count(file($this->file));
    }
}