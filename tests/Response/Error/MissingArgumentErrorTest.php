<?php
use GetAway\API\Communication\Response\Error\MissingArgumentError;


class MissingArgumentTest extends \PHPUnit_Framework_TestCase {


  /**
   * Test setting the argument name of a missing argument error.
   */
  public function testArgumentName() {
    $argumentName = "Test argument name";
    $error = new MissingArgumentError();
    $error->setArgumentName($argumentName);
    $this->assertEquals($argumentName, $error->argumentName());
  }


  /**
   * Test setting the argument expected type of a missing argument error.
   */
  public function testArgumentExpectedName() {
    $argumentName = "Test argument expected type";
    $error = new MissingArgumentError();
    $error->setArgumentExpectedType($argumentName);
    $this->assertEquals($argumentName, $error->argumentExpectedType());
  }


  /**
   * Test converting a missing argument error to and from JSON.
   */
  public function testJson() {

    $message = "This is the test message";
    $argumentName = "This is the argument name";
    $argumentExpectedType = "This is the argument expected type";

    $missingArgumentError1 = new MissingArgumentError($message, $argumentName, $argumentExpectedType);

    /** @var MissingArgumentError $missingArgumentError2 */
    $missingArgumentError2 = MissingArgumentError::initialiseFromJsonObject(
      json_decode(json_encode($missingArgumentError1))
    );

    $this->assertEquals($missingArgumentError1->type(), $missingArgumentError2->type());
    $this->assertEquals($missingArgumentError1->message(), $missingArgumentError2->message());
    $this->assertEquals($missingArgumentError1->argumentName(), $missingArgumentError2->argumentName());
    $this->assertEquals($missingArgumentError1->argumentExpectedType(), $missingArgumentError2->argumentExpectedType());

  }

}