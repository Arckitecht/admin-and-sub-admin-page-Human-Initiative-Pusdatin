<?php
require 'config.php';

// username, email, and password sent from form 
$username = 'user';
$userr    = $_POST['username'];
$password = $_POST['password'];

// Protect MySQL injection
$userr    = stripslashes($userr);
$password = stripslashes($password);
$userr    = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Admin or Sub-Admin
$sql    = "SELECT * FROM $username  WHERE username='$userr' and passwordu='$password'";
$result = mysqli_query($conn, $sql);
$row    = $result->fetch_object();
$count  = mysqli_num_rows($result);

// Member
$sqlmember = mysqli_query($conn, "SELECT * FROM member WHERE Username='$userr' and PasswordMember='$password'");
$apakahada = mysqli_num_rows($sqlmember);

// If result matched $email and $password, table row must be 1 row
if ($count == 1 and $apakahada <= 0)
{
    // Register $username, $email, and $password and redirect to each of their own index file
    session_start();
    $_SESSION["password"] = $password;
    $_SESSION["username"] = $userr;

    if ($row->Akses == 'Sub-Admin')
    {
        header("location:index-subadmin.php");
    }
    else if ($row->Akses == 'Admin')
    {
        header("location:index-admin.php");
    }
}
elseif ($apakahada == 1 and $count <= 0)
{
    // Register $username, $email, and $password and redirect to each of their own index file
    session_start();
    $_SESSION["password"] = $password;
    $_SESSION["username"] = $userr;

    header("location:profile-member.php");
}
else
{
    header("location:login.php?msg=failed");
}