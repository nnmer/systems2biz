Feature: Test backend pages are working (status 200)

  Background:
    Given I am authenticated as "admin"

  Scenario Outline: Open curriculum crud pages
    When I send a <method> request to <url>
    Then the response status code should be 200

    Examples:
      | method  | url                           |
      | GET     | /admin                        |
      | GET     | /admin/app/product/list       |
      | GET     | /admin/app/category/list      |
      | GET     | /admin/app/user/list          |