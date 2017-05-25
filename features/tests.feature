# features/tests.feature
Feature: Drupal QA starter Kit
  
  Scenario: User should get 200 response when user hits the base url
    Given I am on "/"
    Then the response should contain "200"

  Scenario: Login with authenticated user
    Given I am on "/"
    When I fill the login form with correct username and password
    And I press "edit-submit"
    Then I should see "Logout"

  Scenario: Login with unauthenticated user
    Given I am on "/"
    When I fill the login form with incorrect username and password
    And I press "edit-submit"
    Then I should not see "Logout"

  Scenario: Successfully create a node of Article content
    Given I am on "/"
    When I fill the login form with admin user credentials
    And I press "edit-submit"
    Then I should see "Log out"
    When I am on "/node/add/article"
    And I fill in "edit-title" with "title1"
    And I fill in "edit-body-und-0-value" with "body text"
    And I press "edit-submit"
    Then I should see "Article title1 has been created."

  Scenario: Successfully create a node of Basic page content
    Given I am on "/"
    When I fill the login form with admin user credentials
    And I press "edit-submit"
    Then I should see "Log out"
    When I am on "/node/add/page"
    And I fill in "edit-title" with "titlea"
    And I fill in "edit-body-und-0-value" with "body text"
    And I press "edit-submit"
    Then I should see "Basic page titlea has been created."

  Scenario: Admin user should be able to create a new authenticated user.
    Given I am on "/"
    When I fill the login form with admin user credentials
    And I press "edit-submit"
    Then I should see "Log out"
    When I am on "admin/people/create"
    And I fill in a unique username
    And I fill in a unique emailId
    And I enter password and confirm password
    And I select the radio button "Active"
    And I press "edit-submit"
    Then I should see success message of user creation



