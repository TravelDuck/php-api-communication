<?php

use TravelDuck\API\Communication\Response\Error\InvalidIdentifierError;

class InvalidIdentifierTest extends \PHPUnit_Framework_TestCase {


  /**
   * Test setting the given identifier of the invalid identifier error.
   */
  public function testGivenIdentifier() {
    $givenIdentifier = "Test given identifier";
    $error = new InvalidIdentifierError();
    $error->setGivenIdentifier($givenIdentifier);
    $this->assertEquals($givenIdentifier, $error->givenIdentifier());
  }




  /**
   * Test converting a missing argument error to and from JSON.
   */
  public function testJson() {

    $message = "This is the test message";
    $givenIdentifier = "This is the invalid given identifier";

    $invalidIdentifierError1 = new InvalidIdentifierError($message, $givenIdentifier);

    /** @var InvalidIdentifierError $invalidIdentifierError2 */
    $invalidIdentifierError2 = InvalidIdentifierError::initialiseFromJsonObject(
      json_decode(json_encode($invalidIdentifierError1))
    );

    $this->assertEquals($invalidIdentifierError1->type(), $invalidIdentifierError2->type());
    $this->assertEquals($invalidIdentifierError1->message(), $invalidIdentifierError2->message());
    $this->assertEquals($invalidIdentifierError1->givenIdentifier(), $invalidIdentifierError2->givenIdentifier());

  }

}