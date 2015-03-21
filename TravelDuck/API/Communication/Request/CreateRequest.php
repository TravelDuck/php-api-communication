<?php
namespace TravelDuck\API\Communication\Request;


class CreateRequest extends Request {

  /**
   * Construct a new write request.
   *
   * @param $uri
   * @param $data
   * @param null $credentials
   */
  public function __construct($uri, $data, $credentials = null) {
    parent::__construct($uri, "POST", $data, $credentials);
  }

} 