<?php
namespace TravelDuck\API\Communication\Response\Error;


/**
 * Class InvalidIdentifierError
 *
 * Represents an error caused due to an invalid identifier.
 *
 * @package GetAway\Api\Communication\Response\Error
 */
class InvalidIdentifierError extends Error {

  const typeSignature = "invalid-identifier";


  /**
   * Construct a new InvalidIdentifierError.
   *
   * @param string $message
   * @param string $givenIdentifier
   */
  public function __construct($message = "", $givenIdentifier = "") {
    parent::__construct($message);
    $this->setGivenIdentifier($givenIdentifier);
  }


  /**
   * Initialise a new InvalidIdentifierError from an Error.
   *
   * @param Error $error
   * @return InvalidIdentifierError
   */
  public static function initialiseFromError(Error $error) {
    $missingArgumentError = new self();
    $missingArgumentError->setType($error->type());
    $missingArgumentError->setMessage($error->message());
    $missingArgumentError->setExtraDetails($error->extraDetails());
    return $missingArgumentError;
  }


  /**
   * Get the given identifier.
   *
   * @return mixed|null
   */
  public function givenIdentifier() {
    return $this->extraDetailsValue("given-identifier");
  }


  /**
   * Set the given identifier.
   *
   * @param $givenIdentifier
   */
  public function setGivenIdentifier($givenIdentifier) {
    $this->setExtraDetailsValue("given-identifier", $givenIdentifier);
  }


} 