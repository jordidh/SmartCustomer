Feature: Finding where to buy a brand product online
  In order to know where can buy a product online
  As a mobile app user
  I need to set the product name, press the search button, and get the results

  Scenario: Success getting brand shops
    Given I am on "/smartc"
    When I follow "brandwheretobuyonline"
    And I fill in "form_product_name" with "nike"
    And I press "form_submit"
    Then I should be on "/wheretobuyonline/1"
    And I should see "Products found"

  Scenario: Success returning to main page
    Given I am on "/smartc"
    When I follow "brandwheretobuyonline"
    And I follow "return_to_main"
    Then I should be on "/smartc"
    And I should see "Brand info main page"
