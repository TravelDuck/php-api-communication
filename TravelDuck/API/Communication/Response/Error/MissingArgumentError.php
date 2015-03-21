<?php
namespace TravelDuck\API\Communication\Response\Error;


/**
 * Class MissingArgumentError
 *
 * Represents an error caused due to a missing argument.
 *
 * @package GetAway\Api\Communication\Response\Error
 */
class MissingArgumentError extends Error {

  const typeSignature = "missing-argument";


  /**
   * Construct a new MissingArgumentError.
   *
   * @param string $message
   * @param string $argumentName
   * @param string $argumentExpectedType
   */
  public function __construct($message = "", $argumentName = "", $argumentExpectedType = "") {
    parent::__construct($message);
    $this->setArgumentName($argumentName);
    $this->setArgumentExpectedType($argumentExpectedType);
  }


  /**
   * Initialise a new MissingArgumentError from an Error.
   *
   * @param Error $error
   * @return MissingArgumentError
   */
  public static function initialiseFromError(Error $error) {
    $missingArgumentError = new self();
    $missingArgumentError->setType($error->type());
    $missingArgumentError->setMessage($error->message());
    $missingArgumentError->setExtraDetails($error->extraDetails());
    return $missingArgumentError;
  }


  /**
   * Get the argument name of this missing argument error.
   *
   * @return mixed|null
   */
  public function argumentName() {
    return $this->extraDetailsValue("argument-name");
  }


  /**
   * Set the argument name of this missing argument error.
   *
   * @param $argumentName
   */
  public function setArgumentName($argumentName) {
    $this->setExtraDetailsValue("argument-name", $argumentName);
  }


  /**
   * Get the argument expected type of this missing argument error.
   *
   * @return mixed|null
   */
  public function argumentExpectedType() {
    return $this->extraDetailsValue("argument-expected-type");
  }


  /**
   * Set the argument expected type of this missing argument error.
   *
   * @param $argumentExpectedType
   */
  public function setArgumentExpectedType($argumentExpectedType) {
    $this->setExtraDetailsValue("argument-expected-type", $argumentExpectedType);
  }

} 