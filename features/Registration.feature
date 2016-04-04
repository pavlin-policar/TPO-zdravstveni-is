Feature: Initial registration
  In order to test the basic registration process
  As a regular user
  I need to verify that I can register with data and that an activation email is sent to the supplied email

  Scenario: Normal registration flow
    Given I am on "/register"
    When I fill in "email" with "user@gmail.com"
    And I fill in "password" with "password"
    And I fill in "password_confirmation" with "password"
    And I press "Register"
    Then An email should be sent to "user@gmail.com" with their confirmation code