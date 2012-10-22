Feature: test problems rendering the form prototypes with zombie
  In order to test if the form prototypes render properly with the zombie driver
  As a tester
  I need to be able to see if the form prototypes render properly with the zombie driver

  @javascript
  Scenario: Test if the form prototypes render properly with the zombie driver
    Given I am on "/"
    Then show last response