<?php

namespace App\Helpers;

class CloudFlareHelper
{

  public static function cloudFlareUpload($url,$meta)
  {
    try {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.cloudflare.com/client/v4/accounts/3bfc119f0c2c887c99b0c0d7b3124b56/stream/copy",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['url' => $url,'meta'=>['name'=> $meta]]),
        CURLOPT_HTTPHEADER => array(
          'X-Auth-Key: 366540d31b9dcde12c7486fac1f738ccc629b',
          'X-Auth-Email: webmaster@jullo.co.za',
          'content-type: application/json',
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      return $response;
    } catch (\Throwable $th) {
      return $th;
    }
  }
  public static function cloudFlareGet($uid)
  {
    try {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.cloudflare.com/client/v4/accounts/3bfc119f0c2c887c99b0c0d7b3124b56/stream/$uid",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'X-Auth-Key: 366540d31b9dcde12c7486fac1f738ccc629b',
          'X-Auth-Email: webmaster@jullo.co.za'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      return $response;
    } catch (\Throwable $th) {
      return $th;
    }
  }
  public static function cloudFlareDelete($uid)
  {
    try {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.cloudflare.com/client/v4/accounts/3bfc119f0c2c887c99b0c0d7b3124b56/stream/$uid",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
          'X-Auth-Key: 366540d31b9dcde12c7486fac1f738ccc629b',
          'X-Auth-Email: webmaster@jullo.co.za'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      return $response;
    } catch (\Throwable $th) {
      return $th;
    }
  }
}
