<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * The Encryption library provides functionalities such as hashing passwords, 
 * encrypting/decrypting data, URLs encoding, using cryptographic algorithms.
 */
class Encryptor
{
    public function getHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function validateHash($password, $hash)
    {
        return password_verify($password, $hash);
    }
}