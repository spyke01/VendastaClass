Vendasta API Interface Class
=============

This class was created to allow us to interface with the Vendasta RepIntelligence API. Unfortunately they do not have a premade version so we created one.

I hope this helps out anyone trying to do this via PHP, feel free to make any changes to improve this and I'll try and keep everything merged in.

Notes about Version 1 Class
---
This one was originally designed to allow some of our junior devlopers to quickly use the API without have to learn all the endpoints and parameters. It was also massive overkill for what we needed.

To use v1 you would need to make calls like this:

```php
$vendastaAPI = new vendastaAPI( 'pid', 'apiKey' );
$visibilityResult = $vendastaAPI->visility_markUserVerified($actual_id);
if ( $vendastaAPI->_hasError($visibilityResult) ) { echo $vendastaAPI->_lookupError($visibilityResult); }
else { 
	echo "$actual_id marked user verified";
}
```

Notes about Version 2 Class
---
We moved away from a full class set and instead moved to just calling the API calls directly using a small wrapper to handle the calls and error checking.

To use v2 you would need to make calls like this:

```php
$vendastaAPIv2 = new vendastaAPIv2( 'pid', 'apiKey' );
$visibilityResult = $vendastaAPIv2->request( 'endpoint/url/', array(
  'param1' => 'param1Val',
  'param2' => 'param2Val',
), 'POST');
if ( $vendastaAPIv2->hasError($visibilityResult) ) { echo $vendastaAPIv2->lookupError($visibilityResult); }
else { 
	echo "$actual_id marked user verified";
}
```
