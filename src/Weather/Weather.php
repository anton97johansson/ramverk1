<?php

namespace Anax\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * To ease rendering a page consisting of several views.
 */
class Weather implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    public function histWeather($lat, $long)
    {
        $keys = require(ANAX_INSTALL_PATH . "/config/api.php");
        // $accessKey = file_get_contents($path[0]);

        $accessKey = $keys[1];

        $currDate = new \DateTime();
        $old = new \DateTime();
        $old->modify('-30 day');

                // array of curl handles
        $multiCurl = array();
        // data to be returned
        $result = array();
        // multi handle
        $mh = curl_multi_init();
        $day = 0;
        while($day <=30) {
          // URL from which data will be fetched
          $fetchURL = 'https://api.darksky.net/forecast/'.$accessKey.'/'.$lat.','.$long.','.$old->format("Y-m-d").'T12:00:00?exclude=flags,hourly,minutley,currently';
          $old->modify('+1 day');
          $multiCurl[$day] = curl_init();
          curl_setopt($multiCurl[$day], CURLOPT_URL,$fetchURL);
          curl_setopt($multiCurl[$day], CURLOPT_HEADER,0);
          curl_setopt($multiCurl[$day], CURLOPT_RETURNTRANSFER,1);
          curl_multi_add_handle($mh, $multiCurl[$day]);
          $day+=1;
        }
        $index=null;
        do {
          curl_multi_exec($mh,$index);
      } while($index);
        // get content and remove handles
        foreach($multiCurl as $k) {
          curl_multi_remove_handle($mh, $k);
        }
        $data = null;
        foreach($multiCurl as $ch) {
            $data = curl_multi_getcontent($ch);
            $result[] = json_decode($data, true);
        }
        // $i = 0;
        $fixedResult = [];
        foreach ($result as $res) {
            $fixedResult[] = $res["daily"]["data"];
            // $i+=1;
        }
        // close
        curl_multi_close($mh);
        return $data;
    }
    public function test($lat, $long)
    {
        $keys = require(ANAX_INSTALL_PATH . "/config/api.php");
        // $accessKey = file_get_contents($path[0]);

        $accessKey = $keys[1];

        $currDate = new \DateTime();
        $old = new \DateTime();
        $old->modify('-30 day');

                // array of curl handles
        $multiCurl = array();
        // data to be returned
        $result = array();
        // multi handle
        $mh = curl_multi_init();
        $day = 0;
        $urls = [];
        while($day <=30) {
          // URL from which data will be fetched
          $urls[] = 'https://api.darksky.net/forecast/'.$accessKey.'/'.$lat.','.$long.','.$old->format("Y-m-d").'T12:00:00?exclude=flags,hourly,minutley,currently';
          $old->modify('+1 day');
          $day+=1;
        }
        return $urls;
    }
}
