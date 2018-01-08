<?php

namespace App\Event;


use App\Entity\Contact;
use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class ContactEvent extends Event
{
    const NAME = 'app.contact';

    /**
     * @var Contact
     */
    private $contact;

    /**
     * RegisterUserEvent constructor.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }
}