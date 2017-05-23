# features/tests.feature
Feature: Drupal QA starter Kit
  
  Scenario: User should get 200 response when user hits the base url
    Given I am on "/"
    Then the response should contain "200"

  Scenario: Login with authenticated user
    Given I am on "/"
    When I fill in "edit-name" with "demotest@mailinator.com"
    And I fill in "edit-pass" with "Everything7!"
    And I press "edit-submit"
    Then I should see "Logout"

  Scenario: Login with un-authenticated user
    Given I am on "/"
    When I fill in "edit-name" with "demotest_wronginfo@mailinator.com"
    And I fill in "edit-pass" with "Everything"
    And I press "edit-submit"
    Then I should not see "Logout"

