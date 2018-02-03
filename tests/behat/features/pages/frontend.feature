Feature: Test frontend pages are working (status 200)

  Scenario Outline: Open curriculum crud pages
    When I send a <method> request to <url>
    Then the response status code should be 200

    Examples:
      | method    | url                  |
      | GET       | /                    |
      | GET       | /categories          |
      | GET       | /categories?page=2   |
      | GET       | /category-2?page=4   |