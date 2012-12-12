Feature: Finding where to buy a brand product
  In order to know where are the nearest shops to buy a brand product
  As a mobile app user
  I need to set the brand name, press the search button, and get the results in a map

  Scenario: Success getting brand shops
    Given I am on "/smartc"
    When I follow "brandwheretobuy"
    And I fill in "form_product_to_buy" with "nike"
    And I press "form_submit"
    Then I should be on "/wheretobuy/1"
    And I should see "Total items:"

  Scenario: Success returning to main page
    Given I am on "/smartc"
    When I follow "brandwheretobuy"
    And I follow "return_to_main"
    Then I should be on "/smartc"
    And I should see "Brand info main page"
