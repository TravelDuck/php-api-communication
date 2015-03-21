<?php
namespace TravelDuck\API\Communication\Request;


class DeleteRequest extends Request {

  /**
   * Construct a new delete request.
   *
   * @param $uri
   * @param null $credentials
   */
  public function __construct($uri, $credentials = null) {
    parent::__construct($uri, "DELETE", null, $credentials);
  }

} 