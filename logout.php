<?php
    // melepaskan sesi kemudian memindahkan user ke halaman index.html
    session_start();
    session_unset();
    header("Location: index.html");