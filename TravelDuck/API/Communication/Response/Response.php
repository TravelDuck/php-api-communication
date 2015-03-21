<?php
namespace TravelDuck\API\Communication\Response;

use TravelDuck\API\Communication\Response\Error\Error;
use TravelDuck\API\Communication\Response\Error\InvalidArgumentError;
use TravelDuck\API\Communication\Response\Error\InvalidIdentifierError;
use TravelDuck\API\Communication\Response\Error\MissingArgumentError;


class Response {

  const OK = "ok";
  const ERROR = "error";


  /** @var array $headers */
  private $headers = array();

  /** @var int $status */
  private $status = null;

  /** @var array $data */
  private $data = null;



  /**
   * Construct a new response given the status and data.
   */
  public function __construct() {

    // Initialise response data
    $this->data = (object) array(
      "errors" => array(),
      "payload" => null,
      "status" => self::OK,
    );

    $this->setStatusOk();
  }



  /*
   *   _    _                   _
   *  | |  | |                 | |
   *  | |__| |  ___   __ _   __| |  ___  _ __  ___
   *  |  __  | / _ \ / _` | / _` | / _ \| '__|/ __|
   *  | |  | ||  __/| (_| || (_| ||  __/| |   \__ \
   *  |_|  |_| \___| \__,_| \__,_| \___||_|   |___/
   *
   */

  /**
   * Get the headers that will be submitted to the server.
   *
   * @return array
   */
  public function headers() {
    return $this->headers;
  }


  /**
   * Set the headers that will be submitted to the server.
   *
   * @param array $headers
   */
  private function setHeaders(array $headers) {
    $this->headers = $headers;
  }


  /**
   * Reset the headers that will be submitted to the server.
   */
  public function resetHeaders() {
    $this->setHeaders(array());
  }


  /**
   * Get a header that will be submitted to the server.
   *
   * @param $header
   * @return mixed
   */
  public function header($header) {
    return $this->headers()[$header];
  }


  /**
   * Set a header that will be submitted to the server.
   *
   * @param $header
   * @param $value
   */
  public function setHeader($header, $value) {
    $this->headers[$header] = $value;
  }


  /*
   *    _____  _          _
   *   / ____|| |        | |
   *  | (___  | |_  __ _ | |_  _   _  ___
   *   \___ \ | __|/ _` || __|| | | |/ __|
   *   ____) || |_| (_| || |_ | |_| |\__ \
   *  |_____/  \__|\__,_| \__| \__,_||___/
   *
   */

  /**
   * Get the status code given by the server for this response.
   *
   * @return int
   */
  public function status() {
    return $this->status;
  }

  /**
   * Set the status code given by the server for this response.
   *
   * @param $status
   */
  protected function setStatus($status) {
    $this->status = $status;
  }

  /**
   * The status of this response is ok, the operation was executed on the resource as requested.
   *
   * @return bool
   */
  public function statusOk() {
    return $this->status() == 200;
  }

  /**
   * Set the status of this response as: Ok.
   */
  public function setStatusOk() {
    $this->setStatus(200);
  }

  /**
   * The request generating this response is invalid, and has one or more errors.
   *
   * @return bool
   */
  public function statusInvalidRequest() {
    return $this->status() == 400;
  }

  /**
   * Set the status of this response as: invalid request.
   */
  public function setStatusInvalidRequest() {
    $this->setStatus(400);
  }

  /**
   * The credentials provided (if any) do not have permission to perform the request on the specified resource.
   *
   * @return bool
   */
  public function statusInvalidCredentials() {
    return $this->status() == 401;
  }

  /**
   * Set the status of this response as: invalid credentials.
   */
  public function setStatusInvalidCredentials() {
    $this->setStatus(401);
  }

  /**
   * The requested resource does not exist.
   *
   * @return bool
   */
  public function statusInvalidResource() {
    return $this->status() == 404;
  }

  /**
   * Set the status of this response as: invalid resource.
   */
  public function setStatusInvalidResource() {
    $this->setStatus(404);
  }

  /**
   * The API is down for maintenance and will be restored shortly.
   *
   * @return bool
   */
  public function statusDownForMaintenance() {
    return $this->status() == 503;
  }

  /**
   * Set the status of this response as: down for maintenance.
   */
  public function setStatusDownForMaintenance() {
    $this->setStatus(503);
  }


  /**
   * The server has a fault and made an error processing the request.
   *
   * @return bool
   */
  public function statusServerError() {
    return $this->status() == 500;
  }


  /**
   * Set the status of this response as: server error.
   */
  public function setStatusServerError() {
    $this->setStatus(500);
  }
  

  /*
   *   _____          _
   *  |  __ \        | |
   *  | |  | |  __ _ | |_  __ _
   *  | |  | | / _` || __|/ _` |
   *  | |__| || (_| || |_| (_| |
   *  |_____/  \__,_| \__|\__,_|
   *
   */

  /**
   * Get the data given by the server for this response.
   *
   * @return string
   */
  public function data() {
    return $this->data;
  }


  /**
   * Set the data given by the server for this response.
   *
   * @param $data
   * @return mixed
   */
  private function setData($data) {
    return $this->data = $data;
  }


  /*
   *   ______
   *  |  ____|
   *  | |__    _ __  _ __  ___   _ __  ___
   *  |  __|  | '__|| '__|/ _ \ | '__|/ __|
   *  | |____ | |   | |  | (_) || |   \__ \
   *  |______||_|   |_|   \___/ |_|   |___/
   *
   */


  /**
   * Get this response's errors.
   *
   * @return array
   */
  public function errors() {
    return array_map(function($jsonObject) {
      $jsonObject = (object) $jsonObject;
      switch($jsonObject->{"type"}) {
        case MissingArgumentError::typeSignature:
          return MissingArgumentError::initialiseFromJsonObject($jsonObject);
        case InvalidArgumentError::typeSignature:
          return InvalidArgumentError::initialiseFromJsonObject($jsonObject);
        case InvalidIdentifierError::typeSignature:
          return InvalidIdentifierError::initialiseFromJsonObject($jsonObject);
        default:
          return Error::initialiseFromJsonObject($jsonObject);
      }
    }, $this->data->{"errors"});
  }


  /**
   * Clear the errors.
   */
  public function clearErrors() {
    $this->data->{"errors"} = array();
    $this->data->{"status"} = self::OK;
  }


  /**
   * Add an error to this response.
   *
   * @param Error $error
   */
  public function addError($error) {
    /** @var Error $error */
    array_push($this->data->{"errors"}, $error->toJsonObject());
    $this->data->{"status"} = self::ERROR;
  }


  /**
   * Get whether this response has errors or not.
   *
   * @return bool
   */
  public function hasErrors() {
    return count($this->errors()) > 0;
  }


  /*
   *   _____               _                    _
   *  |  __ \             | |                  | |
   *  | |__) |__ _  _   _ | |  ___    __ _   __| |
   *  |  ___// _` || | | || | / _ \  / _` | / _` |
   *  | |   | (_| || |_| || || (_) || (_| || (_| |
   *  |_|    \__,_| \__, ||_| \___/  \__,_| \__,_|
   *                 __/ |
   *                |___/
   */


  /**
   * Get the payload of this response.
   *
   * @return array
   */
  public function payload() {
    return $this->data->{"payload"};
  }


  /**
   * Set the payload of this response.
   *
   * @param array $payload
   */
  public function setPayload($payload) {
    $this->data->{"payload"} = $payload;
  }





  public static function initialiseFromStatusAndData($status, $data) {
    $response = new Response();
    $response->setStatus($status);
    $response->setData($data);
    return $response;
  }

} 