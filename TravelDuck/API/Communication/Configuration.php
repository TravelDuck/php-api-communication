<?php
namespace TravelDuck\API\Communication;


/**
 * Class Configuration
 *
 * Manage the configuration to be used when communicating with the API.
 *
 * @package GetAway\Api\Communication
 */
abstract class Configuration {

  private static $verifyPeer = true;
  private static $pathToCertificate = "certificates/CA/StarfieldRootCertificateAuthority-G2.pem";


  /**
   * Should the connection be verified?
   *
   * @return bool
   */
  public static function getVerifyConnection() {
    return self::$verifyPeer;
  }


  /**
   * Set whether the connection should be verified.
   *
   * @param $verifyPeer
   */
  public static function setVerifyConnection($verifyPeer) {
    self::$verifyPeer = $verifyPeer;
  }


  /**
   * The path to the Certificate Authority (CA) certificate.
   *
   * @return string
   */
  public static function getPathToCertificate() {
    return self::$pathToCertificate;
  }


  /**
   * Set the path to the Certificate Authority (CA) certificate.
   *
   * @param $pathToCertificate
   */
  public static function setPathToCertificate($pathToCertificate) {
    self::$pathToCertificate = $pathToCertificate;
  }

} 