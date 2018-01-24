<?php

namespace App\Event;


use App\Entity\Candidate;
use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class CandidateRegisterEvent extends Event
{
    const NAME = 'candidate.register';

    /**
     * @var User $user
     */
    protected $user;
    /**
     * @var Candidate
     */
    private $candidate;

    /**
     * RegisterUserEvent constructor.
     *
     * @param User $user
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }

    /**
     * @return User
     */
    public function getCandidate(): Candidate
    {
        return $this->candidate;
    }

}