<?

class Validator
{
    private $errors = [];

    private $validatorsList = ['required', 'min', 'max', 'email', 'match', 'login', 'validatePassword']; //названия функций -валидаторов

    //шаблоны сообщений

    private $messages = [
        'required' => "The :fieldname: field is required",
        'min' => "The :fieldname: field must be a minumum of :rule_value: characters",
        'max' => "The :fieldname: field must be a maximum of :rule_value: characters",
        'email' => 'Not valid email',
        'email' => 'The user with this address already exists.',
        'login' => 'The user with this username already exists.',
        'match' => 'The :fieldname: field must match :rulevalue: field',
        'validatePassword' => ':password_errors:',
    ];
    private $dataItems;

    public function validate(array $data = [], array $rules = [])
    {
        $this->dataItems = $data;
        foreach ($data as $fieldname => $value) {
            //если $fieldname есть в массиве из названий ключей $rules
            if (in_array(needle: $fieldname, haystack: array_keys(array: $rules))) {

                $field = [
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname],
                ];
                //валидируем
                $this->callValidator($field);
            }
        }
    }
    public function callValidator(array $field)
    {
        //проходим по правилам валидации
        foreach ($field['rules'] as $rule => $ruleValue) {
            if (in_array($rule, $this->validatorsList)) {
                if ($rule === 'validatePassword') {
                    $passwordErrors = $this->validatePassword($field['value']);
                    if (!empty($passwordErrors)) {
                        foreach ($passwordErrors as $error) {
                            $this->addError($field['fieldname'], $error);
                        }
                    }
                } else {
                    //вызываем функцию валидатора
                    if (!call_user_func_array([$this, $rule], [$field['value'], $ruleValue])) {
                        //add error
                        $errMessage = str_replace(
                            search: [':fieldname:', ':rule_value:'],
                            replace: [$field['fieldname'], $ruleValue],
                            subject: $this->messages[$rule]
                        );
                        $this->addError($field['fieldname'], $errMessage);
                    }
                }
            }
        }
    }
    public function hasErrors()
    {
        return !empty($this->errors);
    }
    public function getErrors()
    {
        return $this->errors;
    }

    public function addError(string $fieldname, string $errMessage)
    {
        $this->errors[$fieldname][] = $errMessage;
    }
    // ------------влидаторы-----------------------------------
    //название совпадает с $validatorsList, два параметра 1 полученные данные, 2 правила валидации/референсное значение
    //возврвщает true, если валидация пройдена
    // $value -полученные данные, которые нужно проверить
    //$ruleValue - референсное значение


    private function required($value, bool $ruleValue)
    {
        return !empty($value);
    }
    private function min($value, int $ruleValue)
    {
        return len($value) >= $ruleValue;
    }
    private function max($value, int $ruleValue)
    {
        return len($value) <= $ruleValue;
    }

    private function email($value, $rule_value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function match($value, $rule_value)
    {
        return $value === $this->dataItems[$rule_value];
    }
    private function validatePassword(string $password): array
    {
        $errors = [];

        // Минимальная длина пароля (например, 6 символов).
        $minLength = 6;
        if (strlen($password) < $minLength) {
            $errors[] = "The password must contain at least {$minLength} characters.";
        }

        // Требование наличия как минимум одной цифры.
        if (!preg_match('/\d/', $password)) {
            $errors[] = "The password must contain at least one digit.";
        }

        // Требование наличия как минимум одной буквы в верхнем регистре.
        if (!preg_match('/[A-ZА-Я]/', $password)) {
            $errors[] = "The password must contain at least one uppercase letter.";
        }

        // Требование наличия хотя бы одного специального символа (например, !@#$%^&*).
        if (!preg_match('/[!@#$%^&*"№]/', $password)) {
            $errors[] = "The password must contain at least one special character.(!@#$%^&*).";
        }

        return $errors;
    }
   
           

    public function listErrors($fieldname)
    {

        $errors_list = '<div class="invalid-feedback d-block"><ul class="list-unstyled">';
        if (isset($this->errors[$fieldname])) {
            foreach ($this->errors[$fieldname] as $errMessage) {
                $errors_list .= "<li>$errMessage</li>";
            }
        }
        $errors_list .= '</ul></div>';
        return $errors_list;
    }
}
