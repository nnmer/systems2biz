<?php

namespace BehatTests\Context;

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageContext extends MinkContext implements KernelAwareContext
{
    use KernelDictionary;

    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        $session = $this->getContainer()->get('session');
        $session->clear();
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->getSession()->getDriver()->getClient()->getCookieJar()->set($cookie);
    }

    /**
     * @AfterStep
     */
    public function printResponseForFailedStep(AfterStepScope $scope): void
    {
        if (!$scope->getTestResult()->isPassed()) {
            $response = $this->getSession()->getDriver()->getClient()->getResponse();
            $request = $this->getSession()->getDriver()->getClient()->getRequest();

            if ($response instanceof RedirectResponse) {
                echo "Redirecting to ".$response->getTargetUrl()."\n";
            }

            echo $request->attributes->get('_controller', '');
            echo mb_substr($response->getContent(), 0, 2000);
        }
    }

    /**
     * @When /^I send a ([^"]*) request to ([^"]*)$/
     */
    public function iSendARequestTo($method, $url)
    {
        $client = $this->getSession()->getDriver()->getClient();
        $client->request($method, $url);
    }
}
