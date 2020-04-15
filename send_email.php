<!doctype html>
<html lang="" en xmlns="http://www.w3.org/1999/html"/>">
<head>
    <meta charset="utf-8">
    <title>
        Send Email
    </title>
</head>
<body>
    <h1>Contact Form</h1>
</body>
<?php # Script 1 send_email.php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['comments'])){
        $body = "Name: {$_POST['name']}\n\nComments: {$_POST['comments']}";
        $body = wordwrap($body,70);
        mail('karl@bensonpartners.co.uk','contact form submission',$body,"From: {$_POST['email']}");
        echo '<p><em> Thank you for contacting me. I will come back to as soon as possible.</em></p>';
        $_POST =[]; #this is to clear contact form
    } else {
        echo '<p style="font-weight: bold; color: #CC00000"> Please fill in the form completely </p>';
    }
}
?>
<p>Please fill in the below form</p>
<form action="send_email.php" metod ="post">
    <p>Name: <input type="text" name="name" size="30" maxlength="60" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" </p>
    <p>Email Address: <input type = "text" name="email" size="30" maxlength="60" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" </p>
    <p>Comments: <textarea name="comments" size="30" maxlength="60" value="<?php if(isset($_POST['comments'])) echo $_POST['comments']; ?>"</textarea> </p>
<p><input type="submit" name="submit" value="Send!"</p>
</form>
</body>
</html>
