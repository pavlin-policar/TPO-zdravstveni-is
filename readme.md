# TPO Zdravstveni informacijski sistem
**2015 / 2016**

## Installation

Run `composer install` in the project folder. See magic.

### Composer
In case you don't have composer installed, you really really should. You can get it [here](https://getcomposer.org/).

### Vagrant
Run `php vendor/bin/homestead make`. You should now have a `Homestead.yaml` file in the project directory. Configure to your liking.

[Homestead](https://laravel.com/docs/5.2/homestead)
[Vagrant](https://www.vagrantup.com/docs/)

## General

### Deployment

To deploy, push / merge to master branch. Codeship (CI) set up to automatically commit changes to Heroku on passing build.

[Codeship](https://codeship.com)
[Heroku app](http://tpo-zdravstveni-is.herokuapp.com/)

### Templates
Form helpers for blade are installed. [Docs](https://laravelcollective.com/docs/5.2/html)

### Gulp

To compile sass / es6 / and other useful things, run `npm install` in the base directory. This will install gulp and other dependencies that help with development. If you don't have npm, you can get it [here](https://www.npmjs.com/).

To view or add gulp tasks, see the `gulpfile.js` for reference.

Gulp tasks:
 - **spec**: since phpspec does not have a way to continuously run tests, this will run them whenever a file is changed in the watched directories.

### Testing

#### Behat
For acceptance testing. Run `vendor/bin/behat` to run acceptance tests (if they exist).

#### Phpspec
Unit tests. Run `vendor/bin/phpspec run` to run spec (if it exists). To run continuous tests, use the gulp task `gulp spec`.
