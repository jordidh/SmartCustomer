Feature: Finding where to buy a brand product
  In order to know where are the nearest shops to buy a brand product
  As a mobile app user
  I need to set the brand name, press the search button, and get the results in a map

  Scenario: Success getting brand shops
    Given I am on "/smartc"
    When I follow "brandwheretobuy"
    And I fill in "queryInput" with "nike"
    And I press "formSubmit"
    Then I should be on "/wheretobuy"
    And I should see "results found"

  Scenario: Success returning to main page
    Given I am on "/smartc"
    When I follow "brandwheretobuy"
    And I follow "return_to_main"
    Then I should be on "/smartc"
    And I should see "Brand info main page"
