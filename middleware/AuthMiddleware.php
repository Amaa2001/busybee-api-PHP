<?php
function authMiddleware($userId = null) {
    // I denna minimal version låtsas vi att user alltid är inloggad
    return 1; // userId = 1
}