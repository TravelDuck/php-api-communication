<?php
namespace TravelDuck\API\Communication\Request;


class ReadRequest extends Request {

  /**
   * Construct a new read request.
   *
   * @param $uri
   * @param null $credentials
   */
  public function __construct($uri, $credentials = null) {
    parent::__construct($uri, "GET", null, $credentials);
  }

} 