<?php

require "../Models/User.php";
require "../Models/Database.php";
session_start();
if(!isset($_seesion["user_id"]))
    {
        header("location:/views/login.php");
    }

