<?php
namespace TravelDuck\API\Communication\Request;

/**
 * Class Credentials
 *
 * Models credentials used to access the Get Away API..
 *
 * @package GetAway\Api\Communication\Request
 */
class Credentials {

  /** @var string $username */
  private $username;

  /** @var string $password */
  private $password;

  /**
   * Construct new credentials given a username and password.
   *
   * @param $username
   * @param $password
   */
  public function __construct($username, $password) {
    $this->setUsername($username);
    $this->setPassword($password);
  }


  /**
   * Get the username of these credentials.
   *
   * @return string
   */
  public function getUsername() {
    return $this->username;
  }


  /**
   * Set the username of these credentials.
   *
   * @param $username
   */
  private function setUsername($username) {
    $this->username = $username;
  }


  /**
   * Get the password of these credentials.
   *
   * @return string
   */
  public function getPassword() {
    return $this->password;
  }


  /**
   * Set the password of these credentials.
   *
   * @param $password
   */
  private function setPassword($password) {
    $this->password = $password;
  }

} 