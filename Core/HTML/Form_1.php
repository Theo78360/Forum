<?php

namespace Core\HTML;

class Form{
    
    protected $data;
    public $surround = "div";
    
    public function __construct($data = array()){
        
        $this->data = $data;
    }
    
    protected function getValue($key){
        
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
    
    protected function label($name){
        
        return "<label for='$name'>". ucfirst($name) ."</label>: ";
    }
    
    protected function surround($field){
        
        return "<" . $this->surround . ">" . $field . "</" . $this->surround .">";
    }
    
    public function create($name, $options = array()){
        
        $html = "<form name='$name'";
        
        $html .= isset($options['method']) ?  " method = '" .$options['method']. "'" : " method = 'post'";
        $html .= isset($options['action']) ?  " action = '" .$options['action']. "'" : " action = '#'";
        $html .= isset($options['class']) ?  " class = '" .$options['class']. "'" : "";
        
        $html .= ">";
        
        return $html;
    }
 
    public function input($name, $options = array()){
        
        $html = $this->label($name);
        
        $html .= "<input id='$name' name='$name'";
        
        $html .= isset($options['type']) ?  " type = '" .$options['type']."'" : " type = 'text'";
        $html .= isset($options['class']) ?  " class = '" .$options['class']."'" : "";
        $html .= isset($options['pattern']) ?  " pattern = " .$options['pattern']."'" : "";
        $html .= isset($options['placeholder']) ?  " placeholder = " .$options['placeholder']."'" : "";
        $html .= isset($options['required']) ?  " required" : "";
        $html .= " value = '" .$this->getValue($name). "'>";
        
        return $this->surround($html);
    }
    
    public function select($name, $options = array()){
        
        $html = $this->label($name);
        
        $html .= "<select name='$name' id='$name'>";
        
        foreach($options as $k => $v){

            $html .= "<option value = '$k'>$v</option>";
        }
                    
        $html .= "</select>";
        
        return $this->surround($html);
    }
    
    public function checkbox($checkboxes){
        
        $html = $this->label($name);
        
        foreach($checkboxes as $k => $v){

            $html .= $k ." <input type = 'checkbox' name = '$k' id='$k' value = '$v'>";
        }
        
        return $this->surround($html);
    }
    
    public function radio($name, $radios){
        
        $html = $this->label($name);
        
        foreach($radios as $k => $v){

            $html .= $k ." <input type = 'radio' name = '$name' id='$k' value = '$v'>";
        }
        
        return $this->surround($html);
    }
    
    public function textarea($name){
        
        $html = $this->label($name);
        
        $html .= "<textarea name='$name' id='$name' cols='30' rows='10'></textarea>";
        
        return $this->surround($html);
    }
    
    public function end($text, $reset = ""){
        
        if($reset == "")
            $html  = $this->surround("<input type='submit' name='submit' value='$text'> ");
        else
            $html  = $this->surround("<input type='submit' name='submit' value='$text'> 
                                      <input type='reset' name='reset' value='$reset'>");  
        
        $html .= "</form>";
        
        return $html;
        
    }
}

?>


