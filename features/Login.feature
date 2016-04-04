Feature: Login system
  In order to test the login system
  As a regular user
  I need to be verify that I can actually log in

  Scenario: I log in as a valid user
    Given I have a new user with the email "user@gmail.com"
    And I am on "/login"
    When I fill in "email" with "user@gmail.com"
    And I fill in "password" with "password"
    And I press "Prijava"
    Then I should not be on "/login"
