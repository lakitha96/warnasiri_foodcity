<?php
/**
 * PHPMailer Exception class.
 *
 * This class will handle all the email exceptions for php mailer.
 */

namespace PHPMailer\PHPMailer;

class EmailException extends Exception
{
    /**
     * Prettify error message output.
     *
     * @return string
     */
    public function errorMessage()
    {
        return '<strong>' . htmlspecialchars($this->getMessage()) . "</strong><br />\n";
    }
}
