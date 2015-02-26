<?php
namespace GetAway\API\Communication\Request;


class UpdateRequest extends Request {

  /**
   * Construct a new write request.
   *
   * @param $uri
   * @param $data
   * @param null $credentials
   */
  public function __construct($uri, $data, $credentials = null) {
    parent::__construct($uri, "PUT", $data, $credentials);
  }

} 