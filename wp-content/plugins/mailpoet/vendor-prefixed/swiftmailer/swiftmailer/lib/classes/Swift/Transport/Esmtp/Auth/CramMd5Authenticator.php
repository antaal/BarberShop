<?php
namespace MailPoetVendor;
if (!defined('ABSPATH')) exit;
class Swift_Transport_Esmtp_Auth_CramMd5Authenticator implements Swift_Transport_Esmtp_Authenticator
{
 public function getAuthKeyword()
 {
 return 'CRAM-MD5';
 }
 public function authenticate(Swift_Transport_SmtpAgent $agent, $username, $password)
 {
 try {
 $challenge = $agent->executeCommand("AUTH CRAM-MD5\r\n", [334]);
 $challenge = \base64_decode(\substr($challenge, 4));
 $message = \base64_encode($username . ' ' . $this->getResponse($password, $challenge));
 $agent->executeCommand(\sprintf("%s\r\n", $message), [235]);
 return \true;
 } catch (Swift_TransportException $e) {
 $agent->executeCommand("RSET\r\n", [250]);
 throw $e;
 }
 }
 private function getResponse($secret, $challenge)
 {
 if (\strlen($secret) > 64) {
 $secret = \pack('H32', \md5($secret));
 }
 if (\strlen($secret) < 64) {
 $secret = \str_pad($secret, 64, \chr(0));
 }
 $k_ipad = \substr($secret, 0, 64) ^ \str_repeat(\chr(0x36), 64);
 $k_opad = \substr($secret, 0, 64) ^ \str_repeat(\chr(0x5c), 64);
 $inner = \pack('H32', \md5($k_ipad . $challenge));
 $digest = \md5($k_opad . $inner);
 return $digest;
 }
}
