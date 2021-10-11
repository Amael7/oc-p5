<?php 

namespace App\Core;

class Validation {

  /**
   * function to check if the data enter by the user is correct
   *
   * @param $data
   * @return
   */
  public static function check($data) {
    if (isset($data) && ($data != '')) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);

      return $data;
    } else {
        return false;
        // $_SESSION['flash']['danger'] = 'Les champs ne sont pas remplis correctement';
        // header('Location: /blog/admin/dashboard'); // redirection ?
    }
  }
}