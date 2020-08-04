<?php

namespace aryqs\csrf;

class Token
{

    /**
     * name of tha value used to store data in session and store token in hidden input
     * 
     * @var string
     */
    private $string = '_token';

    /**
     * Random string of 12 chars
     * 
     * @var string
     */
    private $key = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(12/strlen($x)) )),1,12);

    /**
     * save csrf token in session and return value, use it in hidden input
     * 
     * @param string $string
     * @return string $key
     */
    public static function set(string $string = self::$string)
	{
        (new self)->save($string, self::$key);
        return (new self)->formalize($string, self::$key);
    }
    
    /**
     * compare posted token to saved session token
     * 
     * @param string $string
     * @return boolean
     */
    public static function verify(string $string = self::$string)
    {
        $session = $_SESSION[$string];
        unset($session[$string]);
        return $_POST[$string] == $session;
    }

    /**
     * create basic html input
     * 
     * @param string $name
     * @param string $value
     * @param string $type
     * @param mixed|null $class
     * @return string
     */
    private function formalize(string $name, string $value, string $type = 'hidden', $class = null)
    {
        return "<input type='$type' class='$class' name='$name' value='$value'>";
    }
    
    /**
     * save data in session
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    private function save(string $key, $value = null)
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_SESSION[$key])) {
            throw new \Exception('Session key is already used');
        }
        $_SESSION[$key] = $value;
    }

}