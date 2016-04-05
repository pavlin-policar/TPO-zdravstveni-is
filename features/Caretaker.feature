Feature: Caretakers
  As a caretaker
  I want to be able to create and update data for the people I am taking care of
  So that they don't have to worry about it

  Scenario: I want to be able to access the list of my charges from any page
    Given I am logged in
    And I am taking care of "Bojan"
    And I am on "/dashboard"
    Then I should see "Bojan"

  Scenario: I want to visit the charges page to see who I am taking care of
    Given I am logged in
    And I am on "/dashboard"
    When I follow "Pregled oskrbljencev"
    Then I should be on "/charges"
    And I should see "Oskrbljenci"

  Scenario: I want to be able to access the add charge page
    Given I am logged in
    And I am on "/charges"
    When I follow "Dodaj oskrbljenca"
    Then I should be on "/charges/create"
    And I should see "Osebni podatki"
    And I should see "Kartica zdravstvenega zavarovanja"

  Scenario: I want to see a list of my charges
    Given I am logged in
    And I am taking care of "France"
    And I am taking care of "Bojan"
    And I am on "/charges"
    Then I should see "France"
    And I should see "Bojan"


