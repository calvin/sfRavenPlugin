<?php
require_once dirname(__FILE__) . '/vendor/raven/lib/Raven/Autoloader.php';
Raven_Autoloader::register();

class sfRavenClient extends Raven_Client
{
    protected function get_user_data()
    {
        $sf_instance = sfContext::getInstance();
        $sf_user = $sf_instance->getUser();

        return array(
            'sentry.interfaces.User' => array(
                'is_authenticated' => $sf_user->isAuthenticated(),
                'id' => $sf_user->isAuthenticated() ? $sf_user->getGuardUser()->id : '-1',
                'username' => $sf_user->isAuthenticated() ? $sf_user->getGuardUser()->username : '-1',
                'email' => $sf_user->isAuthenticated() ? $sf_user->getGuardUser()->email_address : '-1',
                'data' => $sf_user->getAttributeHolder()->getAll(),
            )
        );
    }

    protected function get_extra_data()
    {
        $context = sfContext::getInstance();
        return array(
                'settings' => sfDebug::settingsAsArray(),
                'request' => sfDebug::requestAsArray($context->getRequest()),
                'reponse' => sfDebug::responseAsArray($context->getResponse()),
                'user' => sfDebug::userAsArray($context->getUser()),
        );
    }
}
