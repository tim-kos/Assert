# Assert class

Assert class to check if your application is doing fine at runtime. Throws an exception with detailed information when an assertion fails.

Sample usage:

      Assert::true(false, '404');

.. would raise an AppException with information about the error. The passed parameter would be available in the 'type' index:

      try {
        Assert::true(false, '404');
      } catch (Exception $e) {
        print_r($e->info);
      }