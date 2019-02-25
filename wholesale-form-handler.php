<?php
$errors = '';
$myemail = 'info@seedpodz.com';//<-----Put Your email address here.
if(empty($_POST['Name'])  ||
   empty($_POST['EMail']) ||
   empty($_POST['Message']))
{
    $errors .= "\n Error: Please fill in all fields marked with an *";
}

$name = $_POST['Name'];
$website = $_POST['Website'];
$phone = $_POST['Phone'];
$email_address = $_POST['EMail'];
$message = $_POST['Message'];

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

$website_email_string = '';

if ( !empty($website) || $website !== '') {
  $website_email_string = ' from: ' + $website;
}

if( empty($errors))
{
	$to = $myemail;
	$email_subject = "Wholesale form submission: $name $website_email_string";
	$email_body = "You have received a wholesale inquiry! ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Website: $website \n Phone: $phone \n Message: \n $message";

	$headers = "From: $myemail\n";
	$headers .= "Reply-To: $email_address";

	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: contact-form-thank-you.html');
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<?php include('./includes/html-head.html'); ?>
</head>

<body>

  <?php include('./includes/navbar.html'); ?>

  <div class="container-light" style="padding: 100px">
    <!-- This page is displayed only if there is some error -->
    <?php
    echo nl2br($errors);
    ?>
    <br><br>
    <a class="btn btn-success" href="contact.html">Back to contact form</a>
  </div>


<?php include('./includes/footer.html'); ?>

</body>
</html>
