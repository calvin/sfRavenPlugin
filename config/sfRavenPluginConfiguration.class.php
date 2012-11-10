<?php

class sfRavenPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    if (!sfConfig::get('app_sfRaven_enabled', true))
      return;


    $this->dispatcher->connect('application.throw_exception', array('sfRaven', 'catch_exception'));

    if (sfConfig::get('app_sfRaven_report_404', false))
      $this->dispatcher->connect('controller.page_not_found', array('sfRaven', 'page_not_found'));

    if (sfConfig::get('app_sfRaven_report_php_errors', false))
    {
      $handler = new Raven_ErrorHandler(sfRaven::getClient());
      $handler->registerErrorHandler();
      $handler->registerShutdownFunction();
    }
  }
}
