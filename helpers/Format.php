<?php


class Format{
  //Date format for post;;;
  public function formatDate($date){
    return date('F j, Y, g:i a',strtotime($date));
  }

  //post text display limit set;;;
  public function textShorten($text, $limit = 300){
    $text = $text. " ";
    $text = substr($text, 0 ,$limit);
      $text = substr($text, 0 , strrpos($text,' '));
    $text = $text."......";
    return $text;
  }

  public function validation($data){
   $data = trim($data);
   $data = stripcslashes($data);
   $data = htmlspecialchars($data);
   return $data;
  }

  public function title(){
  $path = $_SERVER['SCRIPT_FILENAME'];
  $title = basename($path, '.php');
  if ($title == 'index') {
    $title = 'home';
  }elseif ($title == 'contact') {
    $title = 'contact';
  }
    return $title = ucwords($title);
  }

}




 ?>
