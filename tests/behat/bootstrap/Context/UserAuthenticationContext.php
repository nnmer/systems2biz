<?php

namespace BehatTests\Context;

use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserAuthenticationContext implements KernelAwareContext
{
    use KernelDictionary;

    const FIREWALL_PROVIDER_KEY = 'main';

    /**
     * @Given I am authenticated as :username
     */
    public function iAmAuthenticatedAs($username)
    {
        $session = $this->getContainer()->get('session');

        $user = $this->getContainer()->get('sonata.user.manager.user')->findOneBy(['username' => $username]);
        if (!$user) {
            throw new EntityNotFoundException("User with username: $username was not found");
        }

        $token = new UsernamePasswordToken($user, null, self::FIREWALL_PROVIDER_KEY, $user->getRoles());
        $session->set('_security_'.self::FIREWALL_PROVIDER_KEY, serialize($token));
        $session->save();
    }
}
