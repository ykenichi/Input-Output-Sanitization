<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // Function can be improved later to check for
    // more than just '@'.
    return strpos($value, '@') !== false;
  }

  // passes_username_whitelist('User_123')
  function passes_username_whitelist($value) {
    if(preg_match('/\A[A-Za-z0-9_]+\Z/', $value)){
      return true;
    }
    else{
      return false;
    }
  }

  // passes_phone_whitelist('(123) 456-7890')
  function passes_phone_whitelist($value) {
    if(preg_match('/\A[0-9\s\-()]+\Z/', $value)){
      return true;
    }
    else{
      return false;
    }
  }

  // passes_email_whitelist('test@test.com')
  function passes_email_whitelist($value) {
    if(preg_match('/\A[A-Za-z0-9_@\.\-]+\Z/', $value)){
      return true;
    }
    else{
      return false;
    }
  }

  // My custom validation
  // passes_name_whitelist('John')
  function passes_name_whitelist($value) {
    if(preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $value)){
      return true;
    }
    else{
      return false;
    }
  }

  // My custom validation
  //is_valid_email('test@test.com')
  function is_valid_email($value) {
    if(filter_var($value, FILTER_VALIDATE_EMAIL) === false){
      return false;
    }
    else{
      return true;
    }
  }

  // My custom validation
  //has_matching_parenthesis('(123) 456 7890'')
  function has_matching_parenthesis($value) {
    $numParenthesis = 0;
    for ($i = 0; $i < strlen($value); $i++){
      if($value[$i] == '('){
        $numParenthesis++;
      }
      elseif($value[$i] == ')'){
        if($numParenthesis == 0){
          return false;
        }
        else{
          $numParenthesis--;
        }
      }
    }

    if($numParenthesis == 0){
      return true;
    }
    else{
      return false;
    }
  }

  // My custom validation
  //is_new_email('test@test.com','users')
  function is_new_email($value, $table){
    global $db;
      $result = db_query($db, "SELECT * FROM $table WHERE email='$value'");
      if(!$result) {
        echo db_error($db);
        return false;
      }
      if(db_num_rows($result) != 0) {
        return false;
      }
      return true;
  }

  // My custom validation
  // passes_code_whitelist('NY')
  function passes_code_whitelist($value) {
    if(preg_match('/\A[A-Z]+\Z/', $value)){
      return true;
    }
    else{
      return false;
    }
  }

  // My custom validation
  // passes_id_whitelist('1')
  function passes_id_whitelist($value) {
    if(preg_match('/\A[0-9]+\Z/', $value)){
      return true;
    }
    else{
      return false;
    }
  }


?>
