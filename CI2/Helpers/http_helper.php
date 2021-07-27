<?php
function get_http_header_as_array($aResponse){
  $header_array = array();
  $header_rows = explode("\n",$aResponse);
  for($i=0;$i<count($header_rows);$i++){
      $fields = explode(":",$header_rows[$i]);

      if($i != 0 && !isset($fields[1])){//carriage return bug fix.
          if(substr($fields[0], 0, 1) == "\t"){
              end($header_array);
              $header_array[key($header_array)] .= "\r\n\t".trim($fields[0]);
          }
          else{
              end($header_array);
              $header_array[key($header_array)] .= trim($fields[0]);
          }
      }
      else{
          $field_title = trim($fields[0]);
          if (!isset($header_array[$field_title])){
              $header_array[$field_title]=trim($fields[1]);
          }
          else if(is_array($header_array[$field_title])){
                  $header_array[$field_title] = array_merge($header_array[$fields[0]], array(trim($fields[1])));
              }
          else{
              $header_array[$field_title] = array_merge(array($header_array[$fields[0]]), array(trim($fields[1])));
          }
      }
  }
  return $header_array;
}
 ?>
