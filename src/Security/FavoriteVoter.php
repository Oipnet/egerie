<?php

namespace App\Security;


use App\Entity\Candidate;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class FavoriteVoter extends Voter
{
    const ADD = 'add';

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (! in_array($attribute, [self::ADD])){
            return false;
        }

        if (!$subject instanceof Candidate) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /** @var User $user */
        $user = $token->getUser();

        /** @var Candidate $candidate */
        $candidate = $subject;

        switch ($attribute){
            case self::ADD:
                return $this->canAddFavorite($user, $candidate);
                break;
        }
    }

    private function canAddFavorite(User $user, Candidate $candidate)
    {
        if ($user->getFavorites()->indexOf($candidate)) {
            return false;
        };

        return true;
    }
}