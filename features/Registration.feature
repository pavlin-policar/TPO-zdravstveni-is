Feature: Initial registration
  As a regular user
  I want to be able to register myself
  So that I could gain access to the web application

  Scenario: Normal registration flow
    Given I am on "/register"
    When I fill in "email" with "user@gmail.com"
    And I fill in "password" with "password"
    And I fill in "password_confirmation" with "password"
    And I press "Register"
    Then I should be on "/registration/confirm"
    And An email should be sent to "user@gmail.com" with their confirmation code