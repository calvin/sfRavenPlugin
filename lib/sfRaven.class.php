<?php
class sfRaven
{
  protected static $client = null;

  static public function getClient()
  {
    if (self::$client === null)
      self::$client = new sfRavenClient(sfConfig::get('app_sfRaven_dsn'));

    return self::$client;
  }

  static public function catch_exception(sfEvent $event)
  {
    $e = $event->getSubject();

    if ($e instanceof Exception)
      self::getClient()->captureException($e);
  }

  static public function page_not_found(sfEvent $event)
  {
    $e = $event->getSubject();

    if (!($e instanceof Exception))
    {
      $uri = sfContext::getInstance()->getRequest()->getUri();
      $e = new sfError404Exception('Page not found [404]: ' . $uri);
    }

    self::getClient()->captureException($e);
  }
}
