<?php
namespace GetAway\API\Communication\Request;

use GetAway\API\Communication\CommunicationManager;


class Request {

  /** @var array $headers */
  private $headers = array();

  /** @var string $url */
  private $uri = null;

  /** @var string $method */
  private $method = null;

  /** @var array $data */
  private $data = array();

  /** @var Credentials $credentials */
  private $credentials = null;


  /**
   * Construct a new HTTP request.
   *
   * @param $uri
   * @param $method
   * @param $data
   * @param Credentials $credentials
   */
  public function __construct($uri, $method, $data, $credentials = null) {

    $this->resetHeaders();

    $this->setUserAgent("Get Away, PHP - API Communication Library");

    $this->setUri($uri);
    $this->setMethod($method);
    $this->setData($data);

    if ($credentials) {
      $this->setCredentials($credentials);
    }
  }


  /**
   * Execute this request and return the response.
   *
   * @return \GetAway\API\Communication\Response\Response
   */
  public function execute() {
    return CommunicationManager::executeRequest($this);
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
  protected function setHeaders(array $headers) {
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
    return array_key_exists($header, $this->headers()) ? $this->headers()[$header] : null;
  }


  /**
   * Set a header that will be submitted to the server.
   *
   * @param $key
   * @param $value
   */
  protected function setHeader($key, $value) {
    $headers = $this->headers();
    $headers[$key] = $value;
    $this->setHeaders($headers);
  }


  /**
   * Clear a header that will be submitted to the server.
   *
   * @param $header
   */
  protected function clearHeader($header) {
    unset($this->headers()[$header]);
  }


  /**
   * The user agent information to be submitted to the server.
   *
   * @return string
   */
  public function userAgent() {
    return $this->header("User-Agent");
  }


  /**
   * The user agent information to be submitted to the server.
   *
   * @param $userAgent
   */
  protected function setUserAgent($userAgent) {
    $this->setHeader("User-Agent", $userAgent);
  }



  /*
   *   _    _        _
   *  | |  | |      (_)
   *  | |  | | _ __  _
   *  | |  | || '__|| |
   *  | |__| || |   | |
   *   \____/ |_|   |_|
   *
   */


  /**
   * Get the uri to be requested.
   *
   * @return string
   */
  public function uri() {
    return $this->uri;
  }


  /**
   * Set the uri to be requested.
   *
   * @param $uri
   */
  protected function setUri($uri) {
    $this->uri = $uri;
  }


  /*
   *   __  __        _    _                 _
   *  |  \/  |      | |  | |               | |
   *  | \  / |  ___ | |_ | |__    ___    __| |
   *  | |\/| | / _ \| __|| '_ \  / _ \  / _` |
   *  | |  | ||  __/| |_ | | | || (_) || (_| |
   *  |_|  |_| \___| \__||_| |_| \___/  \__,_|
   *
   */

  /**
   * Get the method to be used by this request when accessing the url.
   *
   * @return string
   */
  public function method() {
    return $this->method;
  }


  /**
   * Set the method to be used by this request when accessing the url.
   *
   * @param $method
   */
  protected function setMethod($method) {
    $this->method = $method;
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
   * Get the data to be sent with this request to the url.
   *
   * @return array
   */
  public function data() {
    return $this->data;
  }


  /**
   * Set the data to be sent with this request to the url.
   *
   * @param array $data
   */
  protected function setData($data) {
    $this->data = $data;
  }


  /*
   *    _____                 _               _    _         _
   *   / ____|               | |             | |  (_)       | |
   *  | |      _ __  ___   __| |  ___  _ __  | |_  _   __ _ | | ___
   *  | |     | '__|/ _ \ / _` | / _ \| '_ \ | __|| | / _` || |/ __|
   *  | |____ | |  |  __/| (_| ||  __/| | | || |_ | || (_| || |\__ \
   *   \_____||_|   \___| \__,_| \___||_| |_| \__||_| \__,_||_||___/
   *
   */

  /**
   * Get the credentials to be used when performing this request.
   *
   * @return Credentials
   */
  public function getCredentials() {
    return $this->credentials;
  }


  /**
   * Set the credentials to be used when performing this request.
   *
   * @param Credentials $credentials
   */
  protected function setCredentials(Credentials $credentials) {
    $this->credentials = $credentials;
  }


  /*
   *    _____                    _  _                     __  __             _
   *   / ____|                  | || |                   |  \/  |           | |
   *  | (___    __ _  _ __    __| || |__    ___ __  __   | \  / |  ___    __| |  ___
   *   \___ \  / _` || '_ \  / _` || '_ \  / _ \\ \/ /   | |\/| | / _ \  / _` | / _ \
   *   ____) || (_| || | | || (_| || |_) || (_) |>  <    | |  | || (_) || (_| ||  __/
   *  |_____/  \__,_||_| |_| \__,_||_.__/  \___//_/\_\   |_|  |_| \___/  \__,_| \___|
   *
   */


  /**
   * Get whether this request is in sandbox mode.
   *
   * @return bool
   */
  public function sandboxMode() {
    return $this->header("Sandbox-Mode");
  }


  /**
   * Set whether this request is in sandbox mode.
   *
   * @param $sandboxMode
   */
  protected function setSandboxMode($sandboxMode) {
    $this->setHeader("Sandbox-Mode", $sandboxMode);
  }


  /**
   * Enable sandbox mode for this request.
   */
  public function enableSandboxMode() {
    $this->setSandboxMode(true);
  }


  /**
   * Disable sandbox mode for this request.
   */
  public function disableSandboxMode() {
    $this->setSandboxMode(false);
  }


} 