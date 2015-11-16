@block @block_simple_cetificate
Feature: Simple certificate block in a course
  In order to have one Simple certificate block blocks in a course
  As a teacher
  I need to be able to create and change such blocks

  Scenario: Adding  Simple certificate block in a course
    Given the following "users" exist:
      | username | firstname | lastname | email            |
      | teacher1 | Terry1    | Teacher1 | teacher@example.com  |
      | student1 | Sam1      | Student1 | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | student1 | C1     | student        |
    When I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
    And I add the "Certificates" block
    And I log out
    And I log in as "student1"
    And I follow "Course 1"
    And "block_simple_certificate" "block" should exist
    And I should see "No avaliable certificates" in the "Certificates" "block"
  
  	@javascript  
    Scenario: Adding  Simple certificate block in a course, with an issue certificate
    Given the following "users" exist:
      | username | firstname | lastname | email            |
      | teacher1 | Terry1    | Teacher1 | teacher@example.com  |
      | student1 | Sam1      | Student1 | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | student1 | C1     | student        |
    When I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
	And I add the "Certificates" block
    And I add a "Simple Certificate" to section "1" and I fill the form with:
      | Certificate Name | Test Simple Certificate Block 1 |
      | Certificate Text | Test Simple Certificate Block 1 |
    And I follow "Test Simple Certificate Block 1"
    And I follow "Bulk operations"
    And I select "Send to user's email" from the "Choose a Bulk Operation" singleselect
    #And I select "Send to user's email"
    And I press "Send"
    And I follow "Continue"
    And I log out
    And I log in as "student1"
    And I follow "Course 1"
    And I should not see "Course 1" in the "Certificates" "block"
    And I should see "Test Simple Certificate Block 1" in the "Certificates" "block"
    And I log out
    
	@javascript  
    Scenario: See all certificates dashboard
    Given the following "users" exist:
      | username | firstname | lastname | email            |
      | teacher1 | Terry1    | Teacher1 | teacher@example.com  |
      | student1 | Sam1      | Student1 | student1@example.com |
    And the following "courses" exist:
      | fullname | shortname |
      | Course 5 | C5        |
      | Course 2 | C2        |
      | Course 3 | C3        |
      | Course 4 | C4        |
      | Course 1 | C1        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C5     | editingteacher |
      | student1 | C5     | student        |
      | teacher1 | C2     | editingteacher |
      | student1 | C2     | student        |
      | teacher1 | C3     | editingteacher |
      | student1 | C3     | student        |
      | teacher1 | C4     | editingteacher |
      | student1 | C4     | student        |
      | teacher1 | C1     | editingteacher |
      | student1 | C1     | student        |
    When I log in as "teacher1"
    And I follow "Course 2"
    And I turn editing mode on
	And I add the "Certificates" block
    And I add a "Simple Certificate" to section "1" and I fill the form with:
      | Certificate Name | Test Simple Certificate Block 2 |
      | Certificate Text | Test Simple Certificate Block 2 |
    And I follow "Test Simple Certificate Block 2"
    And I follow "Bulk operations"
    And I select "Send to user's email" from the "Choose a Bulk Operation" singleselect
    And I press "Send"
    And I follow "Continue"
    And I am on homepage 
    And I follow "Course 1"
    And I add the "Certificates" block
    And I add a "Simple Certificate" to section "1" and I fill the form with:
      | Certificate Name | Test Simple Certificate Block 1 |
      | Certificate Text | Test Simple Certificate Block 1 |
    And I follow "Test Simple Certificate Block 1"
    And I follow "Bulk operations"
    And I select "Send to user's email" from the "Choose a Bulk Operation" singleselect
    And I press "Send"
    And I follow "Continue"
    And I am on homepage
    And I follow "Course 4"
    And I add the "Certificates" block
    And I add a "Simple Certificate" to section "1" and I fill the form with:
      | Certificate Name | Test Simple Certificate Block 4 |
      | Certificate Text | Test Simple Certificate Block 4 |
    And I follow "Test Simple Certificate Block 4"
    And I follow "Bulk operations"
    And I select "Send to user's email" from the "Choose a Bulk Operation" singleselect
    And I press "Send"
    And I follow "Continue"
    And I log out
    And I log in as "student1"
    And I follow "Course 1"
    And I should not see "Course 1" in the "Certificates" "block"
    And I should see "Test Simple Certificate Block 1" in the "Certificates" "block"
    And I follow "Show all certificates"
    And I should see "Course 1"
    And I should see "Course 2"
    And I should see "Course 4"
    And I should not see "Course 3"
    And I should not see "Course 5"
    And I log out

    
    
      
      
    
    