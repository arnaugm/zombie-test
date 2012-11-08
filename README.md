Zombie Driver test
==================

Simple example to verify that there is an issue whit zombie driver when it has to deal
with the data-prototype field of the forms. The HTML is not correctly rendered.

The majority of code used is the one in the documentation about the embed collections http://symfony.com/doc/current/cookbook/form/form_collections.html

I've created this repository with the test based on a Symfony 2.1.2 instalation.

Installation
------------

```
> npm install -g zombie@0.12.15
> git clone https://github.com/arnaugm/zombie-test.git
> cd zombie-test
> composer install
> php bin/behat
```