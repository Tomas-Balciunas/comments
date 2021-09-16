<?php

namespace Orca;

class Validation {

    private static $errors = [];

    public static function validation($data) {
        self::name($data['name']);
        self::email($data['email']);
        self::comment($data['comment']);
        return self::$errors;
    }

    public static function validationReply($data) {
        self::name($data['replyName']);
        self::email($data['replyEmail']);
        self::comment($data['replyComment']);
        return self::$errors;
    }

    private static function name($title) {
        $valid = preg_match('/^[\w\d ,.]{3,100}$/', $title);
        if (empty($title)) {
            Validation::$errors['1'] = 'Name field is required.';
        } else if (!$valid) {
            Validation::$errors['1'] = 'Name can only consist of letters and numbers, between 3-100 symbols.';
        } else {
            Validation::$errors['1'] = '';
        }
    }

    

    private static function email($title) {
        if (empty($title)) {
            Validation::$errors['2'] = 'Email field is required';
        } else if (!filter_var($title, FILTER_VALIDATE_EMAIL)) {
            Validation::$errors['2'] = 'Incorrect email format.';
        } else {
            Validation::$errors['2'] = '';
        }
    }

    private static function comment($title) {
        $valid = preg_match('/^[\s\S]{2,1000}$/', $title);
        if (empty($title)) {
            Validation::$errors['3'] = 'Comment field is required';
        } else if (!$valid) {
            Validation::$errors['3'] = 'Comment field can only consist of letters and numbers, between 2-1000 symbols.';
        } else {
            Validation::$errors['3'] = '';
        }
    }
}