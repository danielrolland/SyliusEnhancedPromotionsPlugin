@applying_enhanced_promotion_rules
Feature: Receiving discount based on products and quantity
  In order to pay decreased amount for my order during promotion
  As a Visitor
  I want to have promotion applied to my cart when my cart product quantity qualifies

  Background:
    Given the store operates on a single channel in "United States"
    And the store has a product "PHP T-Shirt" priced at "$100.00"
    And the store has a product "USB Drive" priced at "$40.00"
    And there is a promotion "T-Shirts promotion"

  @ui
  Scenario: Receiving discount on order while buying product from product and quantity criteria
    Given the promotion gives "$20.00" off each product if order has 5 quantity of product "PHP T-Shirt"
    When I add 5 products "PHP T-Shirt" to the cart
    Then my cart total should be "$400.00"
    And my discount should be "-$100.00"

  @ui
  Scenario: Receiving discount on order while buying product from product and quantity criteria
    Given the promotion gives "$20.00" off each product if order has 3 quantity of product "PHP T-Shirt"
    When I add 4 products "PHP T-Shirt" to the cart
    Then my cart total should be "$320.00"
    And my discount should be "-$80.00"

  @ui
  Scenario: Receiving discount on order while buying product from product and quantity criteria but not on other product
    Given the promotion gives "$20.00" off each product if order has 3 quantity of product "PHP T-Shirt"
    And I have 4 products "PHP T-Shirt" in the cart
    When I add 3 products "USB Drive" to the cart
    Then my cart total should be "$440.00"
    And my discount should be "-$80.00"

  @ui
  Scenario: Not receiving discount on order while buying less products than the promotion criteria
    Given the promotion gives "$20.00" off each product if order has 5 quantity of product "PHP T-Shirt"
    When I add 4 products "PHP T-Shirt" to the cart
    Then my cart total should be "$400.00"
    And there should be no discount

  @ui
  Scenario: Not receiving discount on order while buying less products than the criteria on the target product
    Given the promotion gives "$20.00" off each product if order has 5 quantity of product "PHP T-Shirt"
    And I have 4 products "PHP T-Shirt" in the cart
    When I add 3 products "USB Drive" to the cart
    Then my cart total should be "$520.00"
    And there should be no discount
