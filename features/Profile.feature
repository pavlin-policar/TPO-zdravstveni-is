Feature: Profile page
  As a regular user
  I want to be able to change my personal information
  So that I can update it if I move or change phone numbers

  Scenario: Checking validity of my personal information
    Given I have have registered as Janez Novak
    And I log in as "janez.novak@gmail.com"
    And I am on "/profile"
    Then the "first_name" field should contain "Janez"
    And the "last_name" field should contain "Novak"
    And the "birth_date" field should contain "2000-01-01 00:00:00"
    # And the "gender-male" checkbox should be checked
    And the "email" field should contain "janez.novak@gmail.com"
    And the "phone_number" field should contain "123456789"
    And I should see "Ljubljana (1000)"
    And the "address" field should contain "Dunajska"
    And the "zz_card_number" field should contain "123"

  Scenario: I want to update my personal information
    Given I have have registered as Janez Novak
    And I log in as "janez.novak@gmail.com"
    And I am on "/profile"
    When I fill in "first_name" with "Miran"
    When I fill in "last_name" with "Baloh"
    When I fill in "phone_number" with "321321321"
    When I fill in "birth_date" with "2000-01-02 00:00:00"
    And I press "Shrani spremembe"
    Then the "first_name" field should contain "Miran"
    Then the "last_name" field should contain "Baloh"
    Then the "phone_number" field should contain "321321321"
    Then the "birth_date" field should contain "2000-01-02 00:00:00"
