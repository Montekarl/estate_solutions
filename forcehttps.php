<?php
    function forceHTTPS(){
      $httpsURL = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      if( count( $_POST )>0 )
        die( 'Page should be accessed with HTTPS, but a POST Submission has been sent here. Adjust the form to point to '.$httpsURL );
      if( !isset( $_SERVER['HTTPS'] ) || $_SERVER['HTTPS']!=='on' ){
        if( !headers_sent() ){
          header( "Status: 301 Moved Permanently" );
          header( "Location: $httpsURL" );
          exit();
        }else{
          die( '<script type="javascript">document.location.href="'.$httpsURL.'";</script>' );
        }
      }
    }