<?
 class Validator {
    private $errors = [];

    private $validatorsList = ['required', 'min', 'max'];//названия функций -валидаторов

//шаблоны сообщений

    private $messages = [         
            'required' => "The :fieldname: field is required",
            'min' => "The :fieldname: field must be a minumum of :rule_value: characters",
            'max' => "The :fieldname: field must be a maximum of :rule_value: characters",
    ];

    public function validate(array $data = [], array $rules = []) {
    foreach ($data as $fieldname => $value) {
        //если $fieldname есть в массиве из названий ключей $rules
        if(in_array(needle: $fieldname, haystack: array_keys(array: $rules))) {
               
            $field = [
              'fieldname' => $fieldname,
              'value' => $value,
              'rules' => $rules[$fieldname],
            ];
            //валидируем
            $this ->callValidator($field);
        }
      }
    }
    private function callValidator(array $field){
                //проходим по правилам валидации
        foreach ($field['rules'] as $rule => $ruleValue) {
            if(in_array($rule, $this->validatorsList)) {
                //вызываем функцию валидатора
               if(!call_user_func_array([$this, $rule],[$field['value'], $ruleValue])) {
                //add error
                  $errMessage = str_replace(
                    search:[':fieldname:',':rule_value:'],
                    replace: [$field['fieldname'], $ruleValue],
                    subject: $this->messages[$rule]
                  ); 
                  $this->addError( $field['fieldname'], $errMessage);
                }
            }
        }
    }

    public function hasErrors() {
    return !empty($this->errors);
    }
    public function getErrors() {
        return $this->errors;
    }
    
    private function addError(string $fieldname, string $errMessage) {
        $this->errors[$fieldname][] = $errMessage;
    }
    // ------------влидаторы-----------------------------------
    //название совпадает с $validatorsList, два параметра 1 полученные данные, 2 правила валидации/референсное значение
    //возврвщает true, если валидация пройдена
    // $value -полученные данные, которые нужно проверить
    //$ruleValue - референсное значение


    private function required($value, bool $ruleValue) {
        return !empty($value);
    }
    private function min($value, int $ruleValue) {
        return len($value) >= $ruleValue;
    }
    private function max($value, int $ruleValue) {
        return len($value) <= $ruleValue;
    }


    public function listErrors($fieldname) {
       
             $errors_list = '<div class="invalid-feedback d-block"><ul class="list-unstyled">';
             if(isset($this->errors[$fieldname])) {
                foreach($this->errors[$fieldname] as $errMessage) {
                      $errors_list .="<li>$errMessage</li>";
                }
            }
             $errors_list .='</ul></div>';
             return $errors_list;
         }
}