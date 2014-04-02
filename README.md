[![Build Status](https://travis-ci.org/trainerbill/PayPalPaymentsProLite.png?branch=master)](https://travis-ci.org/trainerbill/PayPalPaymentsProLite)

PayPalPaymentsProLite
==========================
This tutorial is provided "AS-IS" with no warranty.  YOU (the developer) would need to ensure that your code works well with your own platform, and that you are handling data securely

Demo
==========================
http://www.mystartupsolutions.com/clients/paypal/PayPalPaymentsProLite/examples/

IMPORTANT
==========================
When you go to production delete the examples folder.  It is outputting raw api calls that include your credentials!

Setup
==========================
1.  git clone https://github.com/trainerbill/PayPalPaymentsProLite.git
2.  Edit config/config.php
3.  Presto.
4.  go to /examples/ to see examples

Goals
==========================
1.  Make basic PayPal Payments Pro integrations easier
2.  Provide basic validation for required parameters before submitting to paypal
3.  Reduce bloat of SDK
4.  Allow developer to place custom variables on NVP string
5.  Make it extendable and allow community to update
6.  Make basic functions like sending the api call and decoding the response easy.
