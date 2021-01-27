<?php

namespace Core\HTML;

class BootstrapForm extends Form{
    
    
    protected function surround($field){
        
        return "<" . $this->surround . " class='form-group'>" . $field . "</" . $this->surround .">";
    }
    
    public function input($name, $options = array()){
        
        $html = $this->label($name);
        
        $html .= "<input id='$name' name='$name'";
        
        $html .= isset($options['type']) ?  " type = '" .$options['type']."'" : " type = 'text'";
        $html .= isset($options['class']) 
                 ? " class = 'form-control " .$options['class']."'" 
                 : " class = 'form-control'";
        $html .= isset($options['pattern']) ?  " pattern = " .$options['partern']."'" : "";
        $html .= isset($options['required']) ?  " required" : "";
        $html .= " value = '" .$this->getValue($name). "'>";
        
        return $this->surround($html);
    }
    
    public function select($name, $options = array()){
        
        $html = $this->label($name);
        
        $html .= "<select class='form-control' name='$name' id='$name'>";
        
        foreach($options as $k => $v){

            $html .= "<option value = '$k'>$v</option>";
        }
                    
        $html .= "</select>";
        
        return $this->surround($html);
    }
    
    public function textarea($name){
        
        $html = $this->label($name);
        
        $html .= "<textarea class='form-control' name='$name' id='$name' rows='3'></textarea>";
        
        return $this->surround($html);
    }
    
    public function end($text, $reset = ""){
        
        if($reset == "")
            $html  = "<button type='submit' name='submit' class='btn btn-success'>$text</button> ";
        else
            $html  = "<button type='submit' name='submit' class='btn btn-success'>$text</button>  
                      <button type='reset' name='reset' class='btn btn-danger'>$reset</button>";  
        
        $html  = $this->surround($html) ."</form>";
        
        return $html;
        
    }
}

$form = new BootstrapForm(array("pseudo" => "haydenx"));

echo $form->create("register");
/*
echo $form->radio("civ" ,array("Mr" => "mr",
                               "Mme" => "mme"));
                               */
echo $form->input("pseudo");
echo $form->input("mdp", array('type' => 'password'));
echo $form->input("email", array('type' => 'email'));
echo $form->select("pays", array('fr' => 'France',
                                 'en' => 'Angleterre'));
echo $form->textarea("description");
echo $form->end("Valider", "Réinitialiser");

?>