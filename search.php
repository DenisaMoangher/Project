<?php
session_start();
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {
header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>E-library | Search for books</title>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-library | Issue a new Book</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <head>

      <script>
      function fetch() {
        var data = new FormData();
          data.append('search', document.getElementById("search").value);
          data.append('ajax', 1);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', "confi.php", true);
        xhr.onload = function () {
          if (this.status==200) {
            var results = JSON.parse(this.response),
                wrapper = document.getElementById("results");
            wrapper.innerHTML = "";
            if (results.length > 0) {
              for(var res of results) {
                var line = document.createElement("div");
                line.innerHTML = "Title:" + res['BookName']+ " " + "ISBNNumber: " + res['ISBNNumber'];
                wrapper.appendChild(line);
              }
            } else {
              wrapper.innerHTML = "No results found";
            }
          } else {
            alert("ERROR LOADING FILE!");
          }
        };
        xhr.send(data);
        return false;
      }
    </script>


  </head>

  <?php include('includes/header.php');?>

    <form onsubmit="return fetch();" align="center">
      <h1>SEARCH FOR BOOKS </h1>
      <input type="text" id="search" required/>
      <input type="submit" value="Search"/>
    </form>

    <div id="results" align="center"></div>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
  </body>
</html>
