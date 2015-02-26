<?php
namespace GetAway\API\Communication\Response\Error;


class Error implements \JsonSerializable {

  const typeSignature = "general";

  private $type = null;

  private $message = null;

  private $extraDetails = array();


  public function __construct($message = "") {
    $this->setType(static::typeSignature);
    $this->setMessage($message);
  }



  /*
   *   _______
   *  |__   __|
   *     | | _   _  _ __    ___
   *     | || | | || '_ \  / _ \
   *     | || |_| || |_) ||  __/
   *     |_| \__, || .__/  \___|
   *          __/ || |
   *         |___/ |_|
   */

  /**
   * Get the type of this error.
   *
   * @return string
   */
  public function type() {
    return $this->type;
  }

  /**
   * Set the type of this error.
   *
   * @param $type
   */
  protected function setType($type) {
    $this->type = $type;
  }



  /*
   *   __  __
   *  |  \/  |
   *  | \  / |  ___  ___  ___   __ _   __ _   ___
   *  | |\/| | / _ \/ __|/ __| / _` | / _` | / _ \
   *  | |  | ||  __/\__ \\__ \| (_| || (_| ||  __/
   *  |_|  |_| \___||___/|___/ \__,_| \__, | \___|
   *                                   __/ |
   *                                  |___/
   */


  /**
   * Get the message of this error.
   *
   * @return string
   */
  public function message() {
    return $this->message;
  }


  /**
   * Set the message of this error.
   *
   * @param $message
   */
  protected function setMessage($message) {
    $this->message = $message;
  }



  /*
   *   ______        _                   _____         _          _  _
   *  |  ____|      | |                 |  __ \       | |        (_)| |
   *  | |__   __  __| |_  _ __  __ _    | |  | |  ___ | |_  __ _  _ | | ___
   *  |  __|  \ \/ /| __|| '__|/ _` |   | |  | | / _ \| __|/ _` || || |/ __|
   *  | |____  >  < | |_ | |  | (_| |   | |__| ||  __/| |_| (_| || || |\__ \
   *  |______|/_/\_\ \__||_|   \__,_|   |_____/  \___| \__|\__,_||_||_||___/
   *
   */

  /**
   * Get the extra details of this error.
   *
   * @return array
   */
  public function extraDetails() {
    return $this->extraDetails;
  }


  /**
   * Set the extra details of this error.
   *
   * @param array $extraDetails
   */
  protected function setExtraDetails($extraDetails) {
    $this->extraDetails = $extraDetails ? (array) $extraDetails : array();
  }


  /**
   * Get a value from the extra details.
   *
   * @param $key
   * @return mixed|null
   */
  public function extraDetailsValue($key) {
    return array_key_exists($key, $this->extraDetails()) ? $this->extraDetails()[$key] : null;
  }


  /**
   * Set a value in the extra details.
   *
   * @param $key
   * @param $value
   */
  public function setExtraDetailsValue($key, $value) {
    $extraDetails = $this->extraDetails();
    $extraDetails[$key] = $value;
    $this->setExtraDetails($extraDetails);
  }



  /*
   *        _   _____   ____   _   _
   *       | | / ____| / __ \ | \ | |
   *       | || (___  | |  | ||  \| |
   *   _   | | \___ \ | |  | || . ` |
   *  | |__| | ____) || |__| || |\  |
   *   \____/ |_____/  \____/ |_| \_|
   *
   */


  /**
   * Initialise an error from the given json object.
   */
  public static function initialiseFromJsonObject($jsonObject) {
    $jsonObject = (object)$jsonObject;
    $error = new static();
    /** @noinspection PhpUndefinedMethodInspection */
    $error->setType($jsonObject->{"type"});
    /** @noinspection PhpUndefinedMethodInspection */
    $error->setMessage($jsonObject->{"message"});
    /** @noinspection PhpUndefinedMethodInspection */
    $error->setExtraDetails($jsonObject->{"extra-details"});
    return $error;
  }


  /**
   * Convert this error to a json object.
   *
   * @return array
   */
  public function toJsonObject() {
    return (object) array(
      "type" => $this->type(),
      "message" => $this->message(),
      "extra-details" => $this->extraDetails(),
    );
  }

  /**
   * (PHP 5 &gt;= 5.4.0)<br/>
   * Specify data which should be serialized to JSON
   * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
   * @return mixed data which can be serialized by <b>json_encode</b>,
   * which is a value of any type other than a resource.
   */
  public function jsonSerialize() {
    return $this->toJsonObject();
  }
}