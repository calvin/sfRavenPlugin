Raven plugin for Symfony 1.x
============================

Install plugin (via Github):

    github clone git@github.com:calvin/sfRavenPlugin.git plugins/sfRaven

Please activate sfRaven plugin by adding the following line in `config/ProjectConfiguration.class.php`:

    $this->enablePlugins('sfRavenPlugin');

Then, add Raven DSN values in `app.yml`:

    prod:
      sfRaven:
        dsn: http://username:password@sentry.server.example.com/project-id

Clear cache:

    $ ./symfony cc

Optional parameters
-------------------

    all:
      sfRaven:
        enabled: true
        dsn: false
        report_404: true # capture 404 errors
        report_php_errors: true # captrue PHP errors (E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_STRICT)
