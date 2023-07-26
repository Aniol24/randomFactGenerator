<?php
class missatge
{
    private $sender;
    private $text;

    public function __construct($who, $text)
    {
        $this->sender = $who;
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getWho()
    {
        return $this->sender;
    }

    public function thisToJSON()
    {
        return array(
            'text' => $this->text,
            'who' => $this->sender
        );
    }
}