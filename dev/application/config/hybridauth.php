<?php
/**
 * Created by PhpStorm.
 * User: aldo
 * Date: 02/11/17
 * Time: 20:04
 */
// hybridauth-2.x.x/hybridauth/config.php
return array(
        // "base_url" the url that point to HybridAuth Endpoint (where index.php and config.php are found)
        "base_url" => "http://dev.funnlz.io/user/social-signup-callback",

        "providers" => array (
            // google
            "Google" => array ( // 'id' is your google client id
                "enabled" => true,
               "keys" => array ( "id" => "52410691638-mieb9s5an6kde6pl0trehv6i2qap5k9s.apps.googleusercontent.com",
                   "secret" => "z-KWo8iInyHxKv4j8xjIYqpp" )
            ),

         // facebook
            "Facebook" => array ( // 'id' is your facebook application id
                "enabled" => true,
                "keys" => array ( "id" => "342432606160206", "secret" => "3b1cdf3d6d459d58b4098be4455c64d7" ),
                "scope" => "email, user_about_me, user_birthday, user_hometown" // optional
            ),

         // twitter
            "Twitter" => array ( // 'key' is your twitter application consumer key
                "enabled" => true,
                "keys" => array ( "key" => "QxnK3wqb2qWb1GXuEIbMpCTbx", "secret" => "f6929r5XOJuyqgzsj3sKk34zBv8OkXeUHWICteA7p7zejJvgGA" )
            )

         // and so on ...
      ),

      "debug_mode" => true ,

      // to enable logging, set 'debug_mode' to true, then provide here a path of a writable file
      "debug_file" => dirname(__FILE__)."/../logs/hybridauth.log",
    );