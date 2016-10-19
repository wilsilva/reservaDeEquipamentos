<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 3:08 PM
 */

namespace App\Helpers;


use Silex\Application;

class Message
{
    /**
     * @var Application
     */
    private $application;

    const Error = 'error';
    const Success = 'success';
    const Warning = 'warning';

    private $typeMessage;
    private $message;


    /**
     * Message constructor.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public function makeText(string $message, string $typeMessage): Message
    {
        $this->message = $message;
        $this->typeMessage = $typeMessage;
        return $this;
    }

    public function show()
    {
        $this->application['session']->getFlashBag()->add($this->typeMessage, $this->message);
    }
}