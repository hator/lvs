<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class Validator {

    public static function Word ($input, $min_size = false) {

        $status = false;

        if ($min_size) {
            if (strlen($input) >= $min_size) {
                if (ctype_alnum($input)) {
                    $status = true;
                }
            }
        } else {
            if (ctype_alnum($input) && strlen($input) > 0) {
                $status = true;
            }
        }

        return $status;

    }

    public static function EncodeHtml($input) {

		$input = str_replace("<","&lt;",$input);
		$input = str_replace(">","&gt;",$input);

    	return $input;

    }

    public static function DecodeHtml($input) {

		$input = str_replace("&lt;","<",$input);
		$input = str_replace("&gt;",">",$input);

    	return $input;

    }

    public static function Digit ($input) {

        $status = false;

        if (ctype_digit($input)){
            $status = true;
        }

        return $status;

    }

    public static function Email ($input) {

        $status = false;

        if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $input)) {
            $status = true;
        }

        return $status;
    }

    public static function Url ($urladdr) {

        $regexp = "^(https?://)?(([0-9a-z_!~*'().&=+$%-]+:)?[0-9a-z_!~*'().&=+$%-]+@)?((([12]?[0-9]{1,2}\.){3}[12]?[0-9]{1,2})|(([0-9a-z_!~*'()-]+\.)*([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.(com|net|org|edu|mil|gov|int|aero|coop|museum|name|info|biz|pro|[a-z]{2})))(:[1-6]?[0-9]{1,4})?((/?)|(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";

        if (eregi( $regexp, $urladdr )){

            if (!eregi( "^https?://", $urladdr )) $urladdr = "http://" . $urladdr;
            if (!eregi( "^https?://.+/", $urladdr )) $urladdr .= "/";
            if ((eregi( "/[0-9a-z~_-]+$", $urladdr)) && (!eregi( "[\?;&=+\$,#]", $urladdr))) $urladdr .= "/";

            return true;

        } else {

            return false;

        }

    }


    public static function Text ($input, $return = false, $safe = false) {

        $text = false;

        if ($return == true) {
            if (strlen(trim($input)) > 0) {
                if (!$safe) {

                    $text = strip_tags($input);
                    $text = htmlspecialchars($text);

                    if (!get_magic_quotes_gpc()) {
                        $text = addslashes($input);
                    } else {
                        $text = $input;
                    }

                }
            }
        } else {
            if (strlen(trim($input)) > 0) {
                $text = true;
            }
        }

        return $text;

    }

}

?>