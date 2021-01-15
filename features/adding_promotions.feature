@managing_enhanced_promotions
Feature: Adding a new promotion
  In order to gives rebates to customers
  As an Administrator
  I want to add a new promotion to the store

  Background:
    Given the store operates on a single channel in "United States"
    And the store ships everywhere for free
    And the store has a product "Apple Juice" priced at "$2.00"
    And I am logged in as an administrator

  @ui @javascript
  Scenario: Adding a new promotion with product and quantity rule
    Given I want to create a new promotion
    When I specify its code as "APPLE_JUICE_QUANTITY_REBATE"
    And I name it "Quantity rebate on apple juice"
    And I add the "Product and quantity" rule configured with the "Apple Juice" product and "5" amount
    And I add it
    Then I should be notified that it has been successfully created
    And the "Quantity rebate on apple juice" promotion should appear in the registry
