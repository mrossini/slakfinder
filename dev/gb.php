<?php
/*
 * Copyright 2009, 2010, 2011, 2012 Matteo (ZeroUno) Rossini, Rome, Italy
 * All rights reserved.
 *
 * Redistribution and use of this script, with or without modification, is
 * permitted provided that the following conditions are met:
 *
 * 1. Redistributions of this script must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ''AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO
 * EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


session_start(); 
include 'inc/includes.inc.php';
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Package Finder</title>
  </head>
  <style type="text/css">
  <!--
    a:link    {text-decoration: none; color: blue;}
    a:visited {text-decoration: none; color: blue;}
    a:hover   {text-decoration: underline; color: red;}
    input {border:1px solid #000000;}
  .gb {border:none; border-bottom:1px dotted #000000; }
  .gb td { border-top:1px dotted #000000; padding:10px; }
/*  .gb th { border-right:none; }*/
  -->
  </style>
<body>
<pre><a href='javascript:history.go(-1)'>Return to back</a> | <a href='index.php'>Go to home</a><br></pre>

<h2>Guest Book</h2>
<pre><font color=green>
Thanks all for use SlakFinder. I hope it was useful to all.
Now, if you want, you can write a comment. 
Just for feedback, suggests, bug report, repository report, greetings to the world, ..., or just a signature.
</font>
<form action="gb.php" method="post">Nick:
<?php
  if(isset($_POST['nick']))$_SESSION['slakhomelinux2guestbooknick']=$_POST['nick'];
  echo "<input name=nick maxlength=15 ";
  if(isset($_SESSION['slakhomelinux2guestbooknick']))echo "value='{$_SESSION['slakhomelinux2guestbooknick']}'";
  echo ">";
?><br>message:
<textarea name=message cols=70 rows=3></textarea>
<input type=submit><br></form>
<a href='gb.php'>Reload</a> <?php
  if(isset($_POST['message'])){
    if(isset($_SESSION['slakhomelinux2guestbookmsg'])){
      if($_SESSION['slakhomelinux2guestbookmsg']==$_POST['message']){
	$gb=new guestbook();
      }else{
	$_SESSION['slakhomelinux2guestbookmsg']=$_POST['message'];
	$gb=new guestbook($_POST['message'],$_SESSION['slakhomelinux2guestbooknick']);
      }
    }else{
      $_SESSION['slakhomelinux2guestbookmsg']=$_POST['message'];
      $gb=new guestbook($_POST['message'],$_SESSION['slakhomelinux2guestbooknick']);
    }
  }else{
    $gb=new guestbook();
  }

  echo "<br><br>";

  echo tables(array("","",""),1," class='gb' ");
  //echo tables(array("Date","Nick","Message"),1," class='gb' ");
  while($message=$gb->fetch()){
    echo tables(array("<sup>{$message['date']}</sup>","<font color='red'>".$message['nick']."</font>",$message['message']));
  }
  echo tables();

  echo "</pre>";

?>
</body>
</html>
