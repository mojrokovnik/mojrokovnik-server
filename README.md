Mojrokovnik Server Repo
========================

Welcome to the Mojrokovnik Server Repository. This is part of Mojrokovnik Project

1) Installation:
----------------------------------

Clone `mojrokovnik-server` repo inside mojrokovnik folder on your local machine

Run installation

    php composer install

Update database schema 

    php bin/console doctrine:schema:update --force

Create initial user

    php app/console fos:user:create

Create application client

    php app/console app:create-client

Run application

    php bin/console server:run


2) Test application
----------------------------------

Before starting coding, make sure that your local system is properly configured for Symfony.
  
    php app/check.php


3) Mojrokovnik server comes pre-configured with the following bundles:
----------------------------------

  * FrameworkBundle - The core Symfony framework bundle

  * FOSRestBundle - Adds rest functionality

  * FOSUserBundle - Adds support for a database-backed user system in Symfony2

  * FOSOAuthServerBundle - Symfony2 OAuth Server Bundle

  * JMSSerializerBundle - This bundle integrates the serializer library into Symfony2.

  * NelmioApiDocBundle - This bundle allows you to generate a decent documentation for your APIs.

All libraries and bundles included in the Symfony Standard Edition and Mojrokovnik Edition are
released under the MIT or BSD license.