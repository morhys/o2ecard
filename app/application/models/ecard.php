<?php

class Ecard extends Eloquent
{

    public function link() {
        return self::getBitly( Config::get('application.return_url') != '' ? Config::get('application.return_url') . $this->slug : URL::to_action('ecard@show', array( $this->slug ) ) );
    }

    public static function start( $photo ) {
        $exists = self::where('photo', '=', $photo)->first();
        if ($exists)
            return $exists;

        $model = new self;
        $model->photo = $photo;
        $model->session_id = Session::instance()->session['id'];
        $model->user_agent = substr(trim($_SERVER['HTTP_USER_AGENT']), 0, 50);
        $model->save();

        return $model;
    }

    public static function getSlug($in, $to_num = false, $pad_up = false, $passKey = null)
    {
      $index = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
          if ($passKey !== null) {
              // Although this function's purpose is to just make the
              // ID short - and not so much secure,
              // with this patch by Simon Franz (http://blog.snaky.org/)
              // you can optionally supply a password to make it harder
              // to calculate the corresponding numeric ID

              for ($n = 0; $n<strlen($index); $n++) {
                  $i[] = substr( $index,$n ,1);
              }

              $passhash = hash('sha256',$passKey);
              $passhash = (strlen($passhash) < strlen($index))
                  ? hash('sha512',$passKey)
                  : $passhash;

              for ($n=0; $n < strlen($index); $n++) {
                  $p[] =  substr($passhash, $n ,1);
              }

              array_multisort($p,  SORT_DESC, $i);
              $index = implode($i);
          }

          $base  = strlen($index);

          if ($to_num) {
              // Digital number  <<--  alphabet letter code
              $in  = strrev($in);
              $out = 0;
              $len = strlen($in) - 1;
              for ($t = 0; $t <= $len; $t++) {
                  $bcpow = bcpow($base, $len - $t);
                  $out   = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
              }

              if (is_numeric($pad_up)) {
                  $pad_up--;
                  if ($pad_up > 0) {
                      $out -= pow($base, $pad_up);
                  }
              }
              $out = sprintf('%F', $out);
              $out = substr($out, 0, strpos($out, '.'));
          } else {
              // Digital number  -->>  alphabet letter code
              if (is_numeric($pad_up)) {
                  $pad_up--;
                  if ($pad_up > 0) {
                      $in += pow($base, $pad_up);
                  }
              }

              $out = "";
              for ($t = floor(log($in, $base)); $t >= 0; $t--) {
                  $bcp = bcpow($base, $t);
                  $a   = floor($in / $bcp) % $base;
                  $out = $out . substr($index, $a, 1);
                  $in  = $in - ($a * $bcp);
              }
              $out = strrev($out); // reverse
          }

          return $out;
    }

    public static function getBitly ($url, $key, $format = 'txt') {

        $login = Config::get('application.bitly_login');
        $appKey = Config::get('application.bitly_appkey');

        if ( $login && $appKey ) {
            $connectURL = 'http://api.bitly.com/v3/shorten?login='.$login.'&apiKey='.$appKey.'&longUrl='.urlencode($url).'&format='.$format;
            return Cache::remember("bitly_$key", function() use ( $connectURL, $url ) {
                $bitlyUrl = self::getCurl( $connectURL );
                return $bitlyUrl ? $bitlyUrl : $url;
            }, 262974); //remember for 6 months
        } else { return $url; }
    }

    public static function getCurl ( $url ) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}