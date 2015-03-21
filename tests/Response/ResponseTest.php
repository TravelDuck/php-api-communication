<?php
use TravelDuck\API\Communication\Response\Error\Error;
use TravelDuck\API\Communication\Response\Error\InvalidIdentifierError;
use TravelDuck\API\Communication\Response\Error\MissingArgumentError;
use TravelDuck\API\Communication\Response\Response;


class ResponseTest extends \PHPUnit_Framework_TestCase {


  /**
   * Test setting and reading a response payload.
   */
  public function testPayload() {
    $payload = array(
      "this" => "is",
      "the" => "payload",
    );
    $response = new Response();
    $response->setPayload($payload);
    $this->assertEquals($payload, $response->payload());
  }


  /**
   * Test setting and reading a header value.
   */
  public function testHeader() {
    $response = new Response();
    $key = "This is the test key";
    $value = "And this is the test value";
    $response->setHeader($key, $value);
    $this->assertEquals($value, $response->header($key));
  }


  /**
   * Test adding and retrieving an error to a response.
   */
  public function testErrors() {
    $numberOfErrors = 3;
    $generalError = new Error("This is the message");
    $missingArgumentError = new MissingArgumentError("This is the message", "Argument Name", "Some amazing argument type");
    $invalidIdentifierError = new InvalidIdentifierError("This is the message", "This is the given identifier - sweet");

    $response = new Response();
    $response->addError($generalError);
    $response->addError($missingArgumentError);
    $response->addError($invalidIdentifierError);
    $errors = $response->errors();

    $this->assertEquals($numberOfErrors, count($errors));
    $this->assertEquals($generalError, $errors[0]);
    $this->assertEquals($missingArgumentError, $errors[1]);
    $this->assertEquals($invalidIdentifierError, $errors[2]);
  }



}