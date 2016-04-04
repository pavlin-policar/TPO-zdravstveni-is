Feature: Two step registration
  In order to test two step registration
  As a regular user
  I need to be verify that I can't access the webpage until I create my profile

  Scenario: I have not yet created my profile and try to access the homepage
    Given I have a new user with the email "user@gmail.com"
    And I log in as "user@gmail.com"
    When I go to "/"
    Then I should be on "/registration/step-2"
    And I should see "Niste še zaključili registracije"

  Scenario: I have already created my profile and I try to access the homepage
    Given I have an existing user with the email "user@gmail.com"
    And I log in as "user@gmail.com"
    When I go to "/"
    Then I should be on "/"

  Scenario: I have already created my profile and I try to access the registration step-2 page
    Given I have an existing user with the email "user@gmail.com"
    And I log in as "user@gmail.com"
    When I go to "registration/step-2"
    Then I should not be on "registration/step-2"

  Scenario: I have already created my profile and I try to access the profile create page
    Given I have an existing user with the email "user@gmail.com"
    And I log in as "user@gmail.com"
    When I go to "profile/create"
    Then I should not be on "profile/create"

  Scenario: I have not yet created my profile and I go to the create profile page
    Given I have a new user with the email "user@gmail.com"
    And I log in as "user@gmail.com"
    When I go to "/registration/step-2"
    And I follow "Kreiraj profil"
    Then I should see "Kreiraj profil"
    And I should be on "profile/create"

  Scenario: I have not yet created my profile and I decide to do it another time
    Given I have a new user with the email "user@gmail.com"
    And I log in as "user@gmail.com"
    When I go to "/registration/step-2"
    And I follow "Izpiši me"
    Then I should see "Login"
    And I should be on "login"