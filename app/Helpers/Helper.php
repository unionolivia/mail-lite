<?php
declare(strict_types=1);

namespace App\Helpers;

class Helper
{
   /**
   *	Generates a token for the logged in users
   */
   public static function isValidEmail(string $email) : bool {
   	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    //Get host name from email and check if it is valid
    $email_host = array_slice(explode("@", $email), -1)[0];

    // Check if valid IP (v4 or v6). If it is we can't do a DNS lookup
    if (!filter_var($email_host,FILTER_VALIDATE_IP, [
        'flags' => FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE,
    ])) {
        //Add a dot to the end of the host name to make a fully qualified domain name
        // and get last array element because an escaped @ is allowed in the local part (RFC 5322)
        // Then convert to ascii (http://us.php.net/manual/en/function.idn-to-ascii.php)
        $email_host = idn_to_ascii($email_host.'.', 0, INTL_IDNA_VARIANT_UTS46);

        //Check for MX pointers in DNS (if there are no MX pointers the domain cannot receive emails)
        if (!checkdnsrr($email_host, "MX")) {
            return false;
        }
    }

    return true;
  }
     
}
