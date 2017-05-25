<?php

use Drupal\DrupalExtension\Context\RawDrupalContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;




/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawDrupalContext implements SnippetAcceptingContext {

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */

  public $unixTimeStamp;



  public function __construct() {
    $this->unixTimeStamp = time();
  }


  public function getValueFromVariableFile(){
      print_r("This is the method");
  }

  /**
   * @Given print varible name :arg1
   */
  public function printVaribleName($arg1)
  {
      $array_var = parse_ini_file("variables.ini");
      print_r($array_var[$arg1]);

      // getValueFromVariableFile();
  }

      public function fillField($field, $value)
    {
        $this->getSession()->getPage()->fillField($field, $value);
    }

  /**
   * @When I fill the login form with correct username and password
   */
  public function iSubmitTheFormWithCorrectUsernameAndPassword()
  {
      $array_var = parse_ini_file("variables.ini");
      $this->getSession()->getPage()->fillField("edit-name", $array_var['auth_user']);
      $this->getSession()->getPage()->fillField("edit-pass", $array_var['auth_pass']);
  }


    /**
     * @When I fill the login form with incorrect username and password
     */
    public function iFillFormWithIncorrectUsernameAndPassword()
    {
      $array_var = parse_ini_file("variables.ini");
      $this->getSession()->getPage()->fillField("edit-name", "1");
      $this->getSession()->getPage()->fillField("edit-pass", "2");
    } 

    /**
     * @When I fill the login form with admin user credentials
     */
    public function iFillTheLoginFormWithAdminUserCredentials()
    {
      $array_var = parse_ini_file("variables.ini");
      $this->getSession()->getPage()->fillField("edit-name", $array_var['admin_user']);
      $this->getSession()->getPage()->fillField("edit-pass", $array_var['admin_pass']);
    }


    /**
     * @When I fill in a unique username
     */
    public function iFillInAUniqueUsername()
    {
        $username = "user".$this->unixTimeStamp;
        echo $username;
        $this->getSession()->getPage()->fillField("edit-name", $username);
    }

    /**
     * @When I fill in a unique emailId
     */
    public function iFillInAUniqueEmailid()
    {
        $email = "user".$this->unixTimeStamp."@user.com";
        echo $email;
        $this->getSession()->getPage()->fillField("edit-mail", $email);
    }

    /**
     * @When I enter password and confirm password
     */
    public function iEnterPasswordAndConfirmPassword()
    {
        $this->getSession()->getPage()->fillField("edit-pass-pass1", "admin@123");
        $this->getSession()->getPage()->fillField("edit-pass-pass2", "admin@123");
    }

    /**
     * @Then I should see success message of user creation
     */
    public function iShouldSeeSuccessMessageOfUserCreation()
    {
         $this->assertSession()->pageTextContains("Created a new user account for user".$this->unixTimeStamp);
    }


}
