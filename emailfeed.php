<?php 
$mailbox = '{localhost:143/notls}';
$username = 'feed@montechristo.site';
$password = 'ggt87hxfrb8s';
 
$imapResource = imap_open($mailbox, $username, $password);
if($imapResource === false){
    throw new Exception(imap_last_error());
}
 
$search = 'SINCE "' . date("j F Y", strtotime("-7 days")) . '"';
$emails = imap_search($imapResource, $search);

if(!empty($emails)){
    //Loop through the emails.
    foreach($emails as $email){
        //Fetch an overview of the email.
        $overview = imap_fetch_overview($imapResource, $email);
        $overview = $overview[0];
        //Print out the subject of the email.
        echo '<b>' . htmlentities($overview->subject) . '</b><br>';
        //Print out the sender's email address / from email address.
        echo 'From: ' . $overview->from . '<br><br>';
        //Get the body of the email.
        $message = imap_fetchbody($imapResource, $email, 1, FT_PEEK);
    }
}