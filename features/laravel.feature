# Example test, will fail when home page id something other than the default laravel homepage
Feature: Laravel home page
  In order to test that Behat works properly
  As a developer
  I want to demonstrate that Behat does indeed work properly

  Scenario: Home page
    Given I am on the homepage
    Then I should see "Laravel 5"
