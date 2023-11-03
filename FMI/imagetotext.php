<?php

class ImageToText extends Anticaptcha implements AntiCaptchaTaskProtocol {

    private $body;
    private $phrase = false;
    private $case = false;
    private $numeric = false;
    private $math = 0;
    private $minLength = 0;
    private $maxLength = 0;
    
    
    public function getPostData() {
        return array(
            "type"      =>  "ImageToTextTask",
            "body"      =>  str_replace("\n", "", $this->body),
            "phrase"    =>  $this->phrase,
            "case"      =>  $this->case,
            "numeric"   =>  $this->numeric,
            "math"      =>  $this->math,
            "minLength" =>  $this->minLength,
            "maxLength" =>  $this->maxLength
        );
    }
    
    public function getTaskSolution() {
        return $this->taskInfo->solution->text;
    }
    
    public function setFile($fileName) {
		$this->body = $fileName;
		return true;
    }

    public function setPhraseFlag($value) {
        $this->phrase = $value;
    }
    
    public function setCaseFlag($value) {
        $this->case = $value;
    }
    
    public function setNumericFlag($value) {
        $this->numeric = $value;
    }
    
    public function setMathFlag($value) {
        $this->math = $value;
    }
    
    public function setMinLengthFlag($value) {
        $this->minLength = $value;
    }
    
    public function setMaxLengthFlag($value) {
        $this->maxLength = $value;
    }
    
}