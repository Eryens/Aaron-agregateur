<?php

function setConnectedSession($email, $username) {
    session_start();
    $_SESSION['logged'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
}