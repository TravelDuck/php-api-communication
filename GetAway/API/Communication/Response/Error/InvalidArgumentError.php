<?php
namespace GetAway\API\Communication\Response\Error;


/**
 * Class InvalidArgumentError
 *
 * Represents an error caused due to an invalid argument.
 * @package GetAway\Api\Communication\Response\Error
 */
class InvalidArgumentError extends Error {

  const typeSignature = "invalid-argument";


  /**
   * Construct a new MissingArgumentError.
   *
   * @param string $message
   * @param string $argumentName
   * @param string $argumentExpectedType
   * @param string $givenArgument
   */
  public function __construct($message = "", $argumentName = "", $argumentExpectedType = "", $givenArgument = "") {
    parent::__construct($message);
    $this->setArgumentName($argumentName);
    $this->setArgumentExpectedType($argumentExpectedType);
    $this->setGivenArgument($givenArgument);
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


  /**
   * Get the given argument.
   *
   * @return mixed|null
   */
  public function givenArgument() {
    return $this->extraDetailsValue("given-argument");
  }


  /**
   * Set the given argument.
   *
   * @param $givenArgument
   */
  public function setGivenArgument($givenArgument) {
    $this->setExtraDetailsValue("given-argument", $givenArgument);
  }

} 