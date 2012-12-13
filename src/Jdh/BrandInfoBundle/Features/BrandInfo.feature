Feature: Finding brand info
  In order to get brand info to know if respects environment, people, etc.
  As a mobile app user
  I need to set the brand name, press the search button, and get the results

  Scenario: Success getting brand info
    Given I am on "/smartc"
    When I follow "brandinfo"
    And I fill in "form_brand_name" with "nike"
    And I press "form_submit"
    Then I should be on "/brand/1"
    And I should see "Results for"

  Scenario: Success returning to main page
    Given I am on "/smartc"
    When I follow "brandinfo"
    And I follow "return_to_main"
    Then I should be on "/smartc"
    And I should see "Brand info main page"