<?php
namespace TravelDuck\API\Communication;

use TravelDuck\API\Communication\Request\Request;
use TravelDuck\API\Communication\Response\Response;


abstract class CommunicationManager {

  public static function executeRequest(Request $request) {

    $ch = curl_init();

    // The HTML from the web page returned goes into the $output variable rather than echoed out to standard output.
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Use the request credentials
    $credentials = $request->getCredentials();
    if ($credentials) {
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, $credentials->getUsername() . ":" . $credentials->getPassword());
    }

    // Headers
    $headers = array_map(function($key, $value) {
      return $key . ": " . $value;
    }, array_keys($request->headers()), array_values($request->headers()));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Verify peer
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, Configuration::getVerifyConnection());
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/../../../" . Configuration::getPathToCertificate());

    // Set the url to be accessed
    curl_setopt($ch, CURLOPT_URL, $request->uri());



    // Request method
    if(strtoupper($request->method()) == "PUT" || strtoupper($request->method()) == "POST") {
      curl_setopt($ch,CURLOPT_POST, count($request->data()));
      curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($request->data()));

      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($request->method()));

    } else if(strtoupper($request->method()) == "DELETE") {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($request->method()));
    }


    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);


    $status = $info['http_code'];
    $data = json_decode($output);
    $response = Response::initialiseFromStatusAndData($status, $data);

    return $response;
  }

} 