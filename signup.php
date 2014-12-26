<?php //signup.php
include_once 'login.php';
include_once 'common.php';

if (!isset($_POST['submitok'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>New User Registration</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
  <h3>New User Registration Form</h3>
  <p><font color="orangered" size="+1"><tt><b>*</b></tt></font> indicates a required field</p>
	  <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
		<table border="0" cellpadding="0" cellspacing="5">
		  <tr>
			<td align="right">
			  <p>User ID</p>
			</td>
			<td>
			  <input name="newid" type="text" maxlength="100" size="25" />
			 <font color="orangered" size="+1"><tt><b>*</b></tt></font>
		   </td>
		</tr>
		<tr>
		  <td align="right">
			  <p>Password</p>
		  </td>
		  <td>
			 <input name="newpass" type="password" maxlength="100" size="25" />
			 <font color="orangered" size="+1"><tt><b>*</b></tt></font>			
		  </td>
		</tr>
		<tr>
		  <td align="right">
			<p>First Name</p>
		  </td>
		  <td>
			<input name="firstName" type="text" maxlength="100" size="25" />
			<font color="orangered" size="+1"><tt><b>*</b></tt></font>
		  </td>
		 </tr>
		 <tr>
		  <td align="right">
			<p>Last Name</p>
		  </td>
		  <td>
			<input name="lastName" type="text" maxlength="100" size="25" />
			<font color="orangered" size="+1"><tt><b>*</b></tt></font>
		  </td>
		</tr>
		<tr>
		  <td align="right">
			<p>E-Mail Address</p>
		  </td>
		  <td>
			<input name="newemail" type="text" maxlength="100" size="25" />
			<font color="orangered" size="+1"><tt><b>*</b></tt></font>
		  </td>
		</tr>
		<tr valign="top">
		  <td align="right">
			<p>Other Notes</p>
		  </td>
		  <td>
			<textarea wrap="soft" name="newnotes" rows="5" cols="30"></textarea>
		  </td>
		</tr>
		<tr>
		  <td align="right" colspan="2">
			<hr noshade="noshade" />
			<input type="reset" value="Reset Form" />
			<input type="submit" name="submitok" value="   OK   " />
		  </td>
		</tr>
	  </table>
	</form>
</body>

</html>
<?php
}
	//Make sure fields are filled
	elseif ($_POST['newid']=='' or $_POST['firstName']=='' or $_POST['lastName']=='' or $_POST['newemail']=='') {
			$errtext="One or more required fields were left blank. Please fill them in and try again.";
			echo "<script type='text/javascript'>alert('".$errtext."');</script>";
	}
	else {

	//Establish DB Connection
	$link = mysqli_connect($servername, $username,$password,$pickemDb);
	if (!$link){die("Connection error: " . mysqli_connect_errno());}
	
    // Check for existing user with the new id
    $sql = "SELECT * FROM user WHERE userid = '".$_POST[newid]."'";
    $result = mysqli_query($link, $sql);
    if (!$result) {	
		errmsg('results failed');
    }
	$rowCount = mysqli_num_rows($result);
	if ($rowCount > 0){
			$errtext="Username is already taken. Please try again.";
			echo "<script type='text/javascript'>alert('".$errtext."');</script>";
			echo "Navigate <a href='signup.php'>back</a>";
	}
    else{
    $newpass = substr(md5(time()),0,6);
    $pwd = $_POST[newpass];
    $sql = "INSERT INTO user SET
              userid = '$_POST[newid]',
              password = PASSWORD('".$pwd."'),
              firstName = '$_POST[firstName]',
              lastName = '$_POST[lastName]',
              email = '$_POST[newemail]',
              notes = '$_POST[newnotes]'";
    if (!mysqli_query($link, $sql)){
        //error('A database error occurred in processing your '.
              //'submission.\\nIf this error persists, please '.
              //'contact you@example.com.\\n');
              exit();
    }
              
    // Email the new password to the person.
    $message = "G'Day!

Your personal account for the Pick Em web app
has been created! To log in, proceed to the
following address:

    http://www.fill this in later.com/

Your personal login ID and password are as
follows:

    userid: $_POST[newid]
    password: $newpass

You aren't stuck with this password! Your can
change it at any time after you have logged in.

If you have any problems, feel free to contact me at
<RMiller07@gmail.com>.

-Ryan Miller
 Site Webmaster
";

    mail($_POST['newemail'],"Your Password for the Pick Em web app",
         $message, "From:Ryan <RMiller07@gmail.com>");
    ?>
    <!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <title> Registration Complete </title>
      <meta http-equiv="Content-Type"
        content="text/html; charset=iso-8859-1" />
    </head>
    <body>
    <p><strong>User registration successful!</strong></p>
    <p>Your userid and password have been emailed to
       <strong><?=$_POST['newemail']?></strong>, the email address
       you just provided in your registration form. To log in,
       click <a href="accesscontrol.php">here</a> to return to the login
       page, and enter your new personal userid and password.</p>
    </body>
    </html>
    <?php
}}
?>
