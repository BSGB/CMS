<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../includes/db.php'; ?>
<?php include 'functions.php'; ?>
<?php
if(!isset($_SESSION['user_role'])){
  header("Location: ../index.php");
} else if($_SESSION['user_role'] == 'subscriber'){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS-project-admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/inner.css" rel="stylesheet" type="text/css">
    <link href="css/posts.css" rel="stylesheet" type="text/css">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="js/jquery.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="css/loader.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<body>
<div id='load-screen'><div id='loading'></div></div>
