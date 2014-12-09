<?php
 /**
 * vendastaAPI - Vendasta Partner API PHP Library
 *
 * @category Services
 * @package  Vendasta Partner API PHP Library
 * @author   Paden Clayton <sales@fasttracksites.com>
 * @link     http://www.fasttracksites.com
 */
 
class vendastaAPI
{
	private $api_url = 'http://reputation.nusani.com/api/v1/';
	private $pid = '';
	private $apiKey = '';
		
	//=====================================================================
	//
	// Sales People Information API
	//
	//=====================================================================
	/**
	* List Sales People
	* Calling this end-point will return a list of sales people for the specified partner.
	*
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function account_getSalesPeople($callback = '') {
		$post_variables = array(
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'sales/get.json');
	}
	
	//=====================================================================
	//
	// Account API
	//
	//=====================================================================
	/**
	* Create an Account
	* Calling this end-point will create an account in our system for your user.
	* A list of category ids can be found at http://documentation.vendasta.com/repman/standard/current/account.html
	*
	* @param string $customerId				This is the unique identifier from your system.
	* @param string $ssoToken				OPTIONAL This is the token to use for single sign-on mechanics, if applicable. May be the same as customerId. It must be unique.
	* @param string $email					The user’s email address. This email does not have to be unique.
	* @param string $companyName				The user’s company name.
	* @param string $commonCompanyName			Common, colloquial names for the company. E.g., the company may be “Joe’s Shoe Repair Limited”, but a common name might be “Joe’s Shoes”. Used to create searches.
	* @param string $categoryId				OPTIONAL The business category of the company for the account. Must be one of the category short codes or blank.
	* @param string $firstName				The user’s first name.
	* @param string $lastName				The user’s last name.
	* @param string $workNumber				The 10 or 11 digit work phone number.
	* @param string $cellNumber				OPTIONAL The 10 or 11 digit cell phone number.
	* @param string $faxNumber				OPTIONAL The 10 or 11 digit fax number.
	* @param string $callTrackingNumber		OPTIONAL A 10 or 11 digit call tracking number.
	* @param string $address					The company address.
	* @param string $city					The company city.
	* @param string $state					The company’s state or province.
	* @param string $country					The company’s 2 letter country code.
	* @param string $zip					The company’s zip or postal code.
	* @param string $link					OPTIONAL A fully-qualified URL for the company (e.g., website, blog, etc.).
	* @param string $service					A service or industry that the company is in (e.g., “dentist”, “restaurant”, “pizza”).
	* @param float $latitude					OPTIONAL The decimal latitude of the company location.
	* @param float $longitude				OPTIONAL The decimal longitude of the company location.
	* @param string $competitor				OPTIONAL The name of a competitor for this company. The competitor fields are used in share of voice computation; this feature will not have results without at least one competitor.
	* @param string $employee				OPTIONAL The name of an employee of this business (e.g., “Sue Snead”). Used in personnel mentions searches.
	* @param boolean $sendAlerts				OPTIONAL The flag to disable sending of alert emails. (Sending is enabled by default).
	* @param boolean $sendReports				OPTIONAL The flag to disable sending of report emails. (Sending is enabled by default).
	* @param boolean $sendTutorials			OPTIONAL The flag to disable sending of tutorial emails. (Sending is enabled by default).
	* @param string $alternateEmailAddress		OPTIONAL Alternate email address to send alerts and emails to.
	* @param string $configToken				OPTIONAL Token identifying the specific configuration parameters to apply to this account. This must be previously configured with Vendasta.
	* @param boolean $demoAccount				OPTIONAL A flag indicating that this account is to be a sales demo account. Sales demo accounts only function fully for 7 days after creation, following which searches will stop being run.
	* @param string $salesPersonEmail			OPTIONAL The email address of the sales person that this account belongs to. This field is required for calls where demoAccount is true. Additionally, if the supplied email address does not match any existing sales person account, an error will be returned.
	* @param string $adminNotes				OPTIONAL Additional information that pertains to an account.
	*
	*/ 
	public function account_create($customerId, $ssoToken, $email, $companyName, $commonCompanyName, $categoryId, $firstName, $lastName, $workNumber, $cellNumber, $faxNumber, $callTrackingNumber, $address, $city, $state, $country, $zip, $link, $service, $latitude = 0, $longitude = 0, $competitor = '', $employee = '', $sendAlerts = true, $sendReports = true, $sendTutorials = true, $alternateEmailAddress = '', $configToken = '', $demoAccount = false, $salesPersonEmail = '', $adminNotes = '') {
		$post_variables = array(
			'customerId' => $customerId,
			'ssoToken' => $ssoToken,
			'email' => $email,
			'companyName' => $companyName,
			'commonCompanyName' => $commonCompanyName,
			'categoryId' => $categoryId,
			'firstName' => $firstName,
			'lastName' => $lastName,
			'workNumber' => $workNumber,
			'cellNumber' => $cellNumber,
			'faxNumber' => $faxNumber,
			'callTrackingNumber' => $callTrackingNumber,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'zip' => $zip,
			'link' => $link,
			'service' => $service,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'competitor' => $competitor,
			'employee' => $employee,
			'sendAlerts' => $sendAlerts,
			'sendReports' => $sendReports,
			'sendTutorials' => $sendTutorials,
			'alternateEmailAddress' => $alternateEmailAddress,
			'configToken' => $configToken,
			'demoAccount' => $demoAccount,
			'salesPersonEmail' => $salesPersonEmail,
			'adminNotes' => $adminNotes
		);

		return $this->_request($post_variables, 'POST', 'account/create.json');
	}
	
	/**
	* Delete an Account
	* Calling this end-point will delete an account in our system. Calling this end-point does not synchronously delete an account, it merely schedules it, thought typically the account will be deleted within a few minutes.
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	*
	*/ 
	public function account_delete($srid, $customerId = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId
		);

		return $this->_request($post_variables, 'POST', 'account/delete.json');
	}
	
	/**
	* Update an account
	* Calling this end-point will update an account in our system for your user. Calling this end-point does not synchronously update an account, it merely schedules it, though typically the account will be updated within a few minutes.
	* A list of category ids can be found at http://documentation.vendasta.com/repman/standard/current/account.html
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $ssoToken				OPTIONAL This is the token to use for single sign-on mechanics, if applicable. May be the same as customerId. It must be unique.
	* @param string $email					The user’s email address. This email does not have to be unique.
	* @param string $companyName				The user’s company name.
	* @param string $commonCompanyName			Common, colloquial names for the company. E.g., the company may be “Joe’s Shoe Repair Limited”, but a common name might be “Joe’s Shoes”. Used to create searches.
	* @param string $categoryId				OPTIONAL The business category of the company for the account. Must be one of the category short codes or blank.
	* @param string $firstName				The user’s first name.
	* @param string $lastName				The user’s last name.
	* @param string $workNumber				The 10 or 11 digit work phone number.
	* @param string $cellNumber				OPTIONAL The 10 or 11 digit cell phone number.
	* @param string $faxNumber				OPTIONAL The 10 or 11 digit fax number.
	* @param string $callTrackingNumber		OPTIONAL A 10 or 11 digit call tracking number.
	* @param string $address					The company address.
	* @param string $city					The company city.
	* @param string $state					The company’s state or province.
	* @param string $country					The company’s 2 letter country code.
	* @param string $zip					The company’s zip or postal code.
	* @param string $link					OPTIONAL A fully-qualified URL for the company (e.g., website, blog, etc.).
	* @param string $service					A service or industry that the company is in (e.g., “dentist”, “restaurant”, “pizza”).
	* @param float $latitude					OPTIONAL The decimal latitude of the company location.
	* @param float $longitude				OPTIONAL The decimal longitude of the company location.
	* @param string $competitor				OPTIONAL The name of a competitor for this company. The competitor fields are used in share of voice computation; this feature will not have results without at least one competitor.
	* @param string $employee				OPTIONAL The name of an employee of this business (e.g., “Sue Snead”). Used in personnel mentions searches.
	* @param boolean $sendAlerts				OPTIONAL The flag to disable sending of alert emails. (Sending is enabled by default).
	* @param boolean $sendReports				OPTIONAL The flag to disable sending of report emails. (Sending is enabled by default).
	* @param boolean $sendTutorials			OPTIONAL The flag to disable sending of tutorial emails. (Sending is enabled by default).
	* @param string $alternateEmailAddress		OPTIONAL Alternate email address to send alerts and emails to.
	* @param string $configToken				OPTIONAL Token identifying the specific configuration parameters to apply to this account. This must be previously configured with Vendasta.
	* @param string $adminNotes				OPTIONAL Additional information that pertains to an account.
	*
	*/ 
	public function account_update($srid, $customerId = '', $ssoToken, $email, $companyName, $commonCompanyName, $categoryId, $firstName, $lastName, $workNumber, $cellNumber, $faxNumber, $callTrackingNumber, $address, $city, $state, $country, $zip, $link, $service, $latitude = 0, $longitude = 0, $competitor = '', $employee = '', $sendAlerts = true, $sendReports = true, $sendTutorials = true, $alternateEmailAddress = '', $configToken = '', $adminNotes = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'ssoToken' => $ssoToken,
			'email' => $email,
			'companyName' => $companyName,
			'commonCompanyName' => $commonCompanyName,
			'categoryId' => $categoryId,
			'firstName' => $firstName,
			'lastName' => $lastName,
			'workNumber' => $workNumber,
			'cellNumber' => $cellNumber,
			'faxNumber' => $faxNumber,
			'callTrackingNumber' => $callTrackingNumber,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'zip' => $zip,
			'link' => $link,
			'service' => $service,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'competitor' => $competitor,
			'employee' => $employee,
			'sendAlerts' => $sendAlerts,
			'sendReports' => $sendReports,
			'sendTutorials' => $sendTutorials,
			'alternateEmailAddress' => $alternateEmailAddress,
			'configToken' => $configToken,
			'adminNotes' => $adminNotes
		);

		return $this->_request($post_variables, 'POST', 'account/update.json');
	}
	
	/**
	* Searching for an Account
	* Calling this end-point will return a list of accounts in the RepMan system which match the criteria you have supplied. This api end-point supports both POST and GET operations returning either JSON or JSONP data.
	*
	* @param string $terms				 	OPTIONAL Optional list of terms to search for. Specified terms may be found in firstName, lastName, email, address or company data. If no terms are specified all accounts on the specified pid will be returned.
	* @param string $cursor				 	OPTIONAL Cursor value returned by a previous call to this end-point allowing for paging through search results.
	* @param int $limit				 		OPTIONAL Number of results to return, defaults to 25.
	* @param string $callback				OPTIONAL The JavaScript function call to wrap the result in. Required for JSONP requests.
	*
	*/ 
	public function account_search($terms = '', $cursor = '', $limit = 25, $callback = '') {
		$post_variables = array(
			'terms' => $terms,
			'cursor' => $cursor,
			'limit' => $limit,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/search.json');
	}
	
	/**
	* Searching for an Account by email
	* Calling this endpoint will return an account from the RepMan accounts system matching the specified salesPersonEmail given in the query. This api end-point supports both POST and GET operations returning either JSON or JSONP data.
	*
	* @param string $terms				 	OPTIONAL Optional list of terms to search for. Specified terms may be found in firstName, lastName, email, address or company data. If no terms are specified all accounts on the specified pid will be returned.
	* @param string $cursor				 	OPTIONAL Cursor value returned by a previous call to this end-point allowing for paging through search results.
	* @param int $limit				 		OPTIONAL Number of results to return, defaults to 25.
	* @param string $callback				OPTIONAL The JavaScript function call to wrap the result in. Required for JSONP requests.
	*
	*/ 
	public function account_searchByEmail($terms = '', $cursor = '', $limit = 25, $callback = '') {
		$post_variables = array(
			'terms' => $terms,
			'cursor' => $cursor,
			'limit' => $limit,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/searchSaleEmail.json');
	}
	
	/**
	* Looking Up an Account
	* Calling this end-point will return the details of the account matching the specified customerId or srid. This api end-point supports both POST and GET operations returning either JSON or JSONP data.
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This isequired for JSONP calls.
	*
	*/ 
	public function account_lookup($srid, $customerId = '', $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/lookup.json');
	}
	
	/**
	* Enabling Apps on An Account
	* The RepMan application is comprised of several modular pieces called “apps”. These apps roughly correspond to the tabs a user sees within the RepMan application. Some of these apps can be enabled on a per-account basis. This end-point is for enabling an app for an account.
	* A list of app ids can be found at http://documentation.vendasta.com/repman/standard/current/account.html#enabling-apps-on-an-account
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $app_id					This is the identifier of the app being enabled for the specified account. See Valid app_id Options for valid options.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This isequired for JSONP calls.
	*
	*/ 
	public function account_enableApp($srid, $customerId = '', $app_id, $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'app_id' => $app_id,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/enable_app.json');
	}
	
	/**
	* Disabling Apps on An Account
	* The RepMan application is comprised of several modular pieces called “apps”. These apps roughly correspond to the tabs a user sees within the RepMan application. Some of these apps can be enabled on a per-account basis. This end-point is for disabling an app for an account.
	* A list of app ids can be found at http://documentation.vendasta.com/repman/standard/current/account.html#enabling-apps-on-an-account
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $app_id					This is the identifier of the app being disabled for the specified account. See Valid app_id Options for valid options.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This isequired for JSONP calls.
	*
	*/ 
	public function account_disableApp($srid, $customerId = '', $app_id, $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'app_id' => $app_id,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/disable_app.json');
	}
	
	/**
	* Convert a Demo Account to Paid
	* Convert a Repman demo account into a paid account
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $email					This is the new email address for converting account
	* @param string $firstName				OPTIONAL This is the new first name for converting account
	* @param string $lastName				OPTIONAL This is the new last name for converting account
	*
	*/ 
	public function account_convertToPaid($srid, $customerId = '', $email, $firstName = '', $lastName = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'email' => $email,
			'firstName' => $firstName,
			'lastName' => $lastName
		);

		return $this->_request($post_variables, 'POST', 'account/convert.json');
	}
	
	/**
	* Get Company Categories
	* Calling this end-point will return a list of valid Company Categories for an account. The company category is used to set the initial Visibility Sources of an account.
	*
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function account_getCompanyCategories($callback = '') {
		$post_variables = array(
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/getCompanyCategories.json');
	}
	
	/**
	* Get Partner Markets
	* Calling this end-point will return the set of valid market ids and market names for a Partner’s account.
	*
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function account_getPartnerMarkets($callback = '') {
		$post_variables = array(
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/getPartnerMarkets.json');
	}
	
	//=====================================================================
	//
	// Reputation API
	//
	//=====================================================================
	/**
	* Get Current Reputation Information By SRID or customerId
	* Calling this end-point will fetch the current reputation information for the account referenced by the specified RepMan ID (SRID) or your own unique customerId.
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function account_getCurrentReputationInformation($srid, $customerId = '', $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/reputation/current.json');
	}
	
	//=====================================================================
	//
	// Review Information API
	//
	//=====================================================================
	/**
	* Get Reviews By SRID or customerId
	* Calling this end-point will fetch the the details of reviews collected for the specified account. The Account may be specified by customerId or RepMan id (SRID).
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $type				 	OPTIONAL The type of query to run against reviews. Possible options are: all, positive, negative, neutral, oneStar, twoStar, threeStar, fourStar, and fiveStar.
	* @param boolean $enableCursor			OPTIONAL Flag to indicate whether or not to enable cursor support on the query. If the chosen query type supports cursors, the response will include a cursor value which can be passed to subsequent queries as the value of the cursor parameter. Cursors are not supported for positive and negative query types.
	* @param string $cursor				 	OPTIONAL A cursor value returned by a previous call to the API with enableCursor set to True. This query will continue where the previous one ended.
	* @param string $startDate				OPTIONAL The start date for the period of time to include reviews. Date must be specified in the format ‘YYYY-MM-DD’.
	* @param string $endDate				 	OPTIONAL The end date for the period of time to include reviews. Date must be specified in the format ‘YYYY-MM-DD’.
	* @param int $limit				 		OPTIONAL Number of results to return, defaults to 25.
	* @param boolean $publishOrder			OPTIONAL Flag to return results sorted in descending order by published date. Defaults to False (sorted descending by date discovered).
	* @param string $source				 	OPTIONAL The review source to return results for. Defaults to ‘2000’ which returns all reviews for valid sources. See Get Review Sources for retrieving valid source values.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function account_getReviews($srid, $customerId = '', $type = '', $enableCursor = false, $cursor = '', $startDate = '', $endDate = '', $limit = 25, $publishOrder = false, $source = '2000', $callback = '') {
		$enableCursor = ( $type == 'negative' || $type == 'positive' ) ? false : $enableCursor;
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'type' => $type,
			'enableCursor' => $enableCursor,
			'cursor' => $cursor,
			'limit' => $limit,
			'publishOrder' => $publishOrder,
			'source' => $source,
			'callback' => $callback
		);
		// Add special items that are not empty in order to avoid bugs
		if (!empty($startDate)) $post_variables['startDate'] = $startDate;
		if (!empty($endDate)) $post_variables['endDate'] = $endDate;

		return $this->_request($post_variables, 'POST', 'account/reputation/review.json');
	}
	
	/**
	* Get Review Details
	* Calling this end-point will fetch the the details of a specific review with the specified identifier.
	*
	* @param string $identifier				The unique review key.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function review_getDetails($identifier, $callback = '') {
		$post_variables = array(
			'identifier' => $source,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/reputation/singleReview.json');
	}
	
	/**
	* Get Review Sources
	* Calling this end-point will return a lit of valid Review Sources for the specified account.
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				OPTIONAL This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function review_getSources($srid, $customerId = '', $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/reputation/reviewSource.json');
	}
	
	//=====================================================================
	//
	// Mentions Information API
	//
	//=====================================================================
	/**
	* Get Mentions By SRID or customerId
	* Calling this end-point will fetch the the details of mentions collected for the specified account. Account may be specified by customerId or RepMan id (SRID).
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param int $limit				 		OPTIONAL The number of results to return as a maximum. Defaults to 25.
	* @param string $start_date				OPTIONAL The start date for the period of time to include mentions. Date must be specified in the format ‘YYYY-MM-DD’.
	* @param string $end_date				OPTIONAL The end date for the period of time to include mentions. Date must be specified in the format ‘YYYY-MM-DD’.
	* @param int $sentiment			 		OPTIONAL The sentiment for which to return mentions. Must be in the range of 1 to 5.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function account_getMentions($srid, $customerId = '', $limit = 25, $start_date = '', $end_date = '', $sentiment = 0, $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'limit' => $limit,
			'callback' => $callback
		);
		// Add special items that are not empty in order to avoid bugs
		if (!empty($customerId)) $post_variables['customerId'] = $customerId;
		if (!empty($start_date)) $post_variables['start_date'] = $start_date;
		if (!empty($end_date)) $post_variables['end_date'] = $end_date;
		if (!empty($sentiment)) $post_variables['sentiment'] = $sentiment;
		//print_r($post_variables);

		return $this->_request($post_variables, 'POST', 'account/mentions.json');
	}
	
	/**
	* Mark Mention Not Mine
	* Calling this end-point will mark the specified mention as “Not Mine” in order to exclude it from display and alerts.
	*
	* @param string $id				 		The unique mention id key.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function mention_markNotMine($id, $callback = '') {
		$post_variables = array(
			'id' => $id,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'mentions/markNotMine.json');
	}
	
	/**
	* Set Mention Sentiment
	* Calling this end-point will set the sentiment rank on the specified mention.
	*
	* @param string $id				 		The unique mention id key.
	* @param int $sentiment			 		The sentiment for which to return mentions. Must be in the range of 1 to 5.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function mention_setSentiment($id, $sentiment, $callback = '') {
		$post_variables = array(
			'id' => $id,
			'sentiment' => $sentiment,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'mentions/setSentiment.json');
	}
	
	//=====================================================================
	//
	// Visibility Information API
	//
	//=====================================================================
	/**
	* Get Visibility Listings By SRID or customerId
	* Calling this end-point will fetch the the details of visibility listings for the specified account. Account may be specified by customerId or RepMan id (SRID).
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function account_getVisibilityListings($srid, $customerId = '', $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'account/reputation/visibility.json');
	}
	
	/**
	* Mark Visibility Listing Not Mine
	* Calling this end-point will fetch flag the specified visibility listing as “Not Mine”.
	*
	* @param string $id				 		The unique visibility listing id key.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function visility_markNotMine($id, $callback = '') {
		$post_variables = array(
			'id' => $id,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'visibility/markNotMine.json');
	}
	
	/**
	* Mark Visibility Listing Mine
	* Calling this end-point will fetch flag the specified visibility listing as “Mine”.
	*
	* @param string $id				 		The unique visibility listing id key.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function visility_markMine($id, $callback = '') {
		$post_variables = array(
			'id' => $id,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'visibility/markMine.json');
	}
	
	/**
	* Mark Visibility Listing User Verified
	* Calling this end-point will fetch flag the specified visibility listing as “User Verified”.
	*
	* @param string $id				 		The unique visibility listing id key.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function visility_markUserVerified($id, $callback = '') {
		$post_variables = array(
			'id' => $id,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'visibility/markUserVerified.json');
	}
	
	/**
	* Submit A Visibility Listing
	* Calling this end-point will supply the URL for a visibility listing to include in the visibility listings for the specified account.
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $url				 	The fully-qualified URL for the listing being submitted.
	* @param string $sourceTag				The tag for the Visibility Source that the submitted listing belongs to.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function visility_submitListing($srid, $customerId = '', $url, $sourceTag, $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'url' => $url,
			'sourceTag' => $sourceTag,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'visibility/submitListing.json');
	}
	
	/**
	* Get Visibility Possible Matches Listings By SRID or customerId
	* Calling this end-point will fetch the possible visiblity matches for an account. Account may be specified by customerId or RepMan id (SRID).
	*
	* @param string $srid				 	This is the unique RepMan ID for the account. Either this or customerId must be specified.
	* @param string $customerId				This is the unique identifier from your system. Either this or customerId must be specified.
	* @param string $sourceTag				The tag for the Visibility Source to return possible matches for.
	* @param string $callback				OPTIONAL This is the name of the function to wrap the result in. This is required for JSONP calls.
	*
	*/ 
	public function visility_getPossibleMatches($srid, $customerId = '', $sourceTag, $callback = '') {
		$post_variables = array(
			'srid' => $srid,
			'customerId' => $customerId,
			'sourceTag' => $sourceTag,
			'callback' => $callback
		);

		return $this->_request($post_variables, 'POST', 'visibility/getPossibleMatches.json');
	}
	
	//=====================================================================
	//
	// API Handlers
	//
	//=====================================================================
	/** 
	* Lookup the meaning of an error code - returns a error message
	*
	* @param int $codeOrArray	Response code that we are looking up or the response array from the CURL request
	*
	*/
	public function _lookupError($codeOrArray) {	
		$code = (is_array($codeOrArray)) ? $codeOrArray['code'] : $codeOrArray;	
		$errorCodes = array(
			200 => 'Request succedded.',
			201 => 'Account creation succedded.',
			202 => 'Account was scheduled for update/deletion.',
			400 => 'Incoming POST or GET was malformed in some way, see response for message.',
			401 => 'We could not validate your pid/apiKey combination.',
			403 => 'You do not have permission to access the specified item.',
			404 => 'We could not find the item specified.',
			405 => 'You did not use the required POST method.',
			409 => 'An account with the provided customerId or ssoToken already exists in our system.',
			999 => $codeOrArray['result'],
		);
		$errorCode = (isset($errorCodes[$code])) ? $errorCodes[$code] : 'Some unexpected error occurred. (Reported Error: ' . var_export($code, true) . ')';
		
		return $errorCode;
	}
	
	/** 
	* Determine if a call resulted in an error
	*
	* @param int $requestArray	This is the array returned from _request
	*
	*/
	public function _hasError($requestArray) {	
		$sucessCodes = array(200, 201, 202);	
		return (in_array($requestArray['code'], $sucessCodes)) ? false : true;
	}

	/**
	* Request using PHP CURL functions
	* Requires curl library installed and configured for PHP
	* Returns response from the AuthorityLabs Partner API
	*
	* @param array $request_vars	Data for making the request to API
	* @param string $method			Specifies POST or GET method
	* @param string $path			OPTIONAL Path for the API request - specifies priority or get URL when applicable
	*
	*/		
	private function _request($request_vars = array(), $method, $path = '') {
		$qs = 'pid=' . $this->pid . '&apiKey=' . $this->apiKey;
		$response = array(
			'code' => '',
			'result' => '',
		);
		
		foreach($request_vars AS $key => $value)
			$qs .= '&' . $key . '=' . urlencode($value);
		
		//construct full api url
		$url = $this->api_url . $path;
		if(strtoupper($method) == 'GET')
		$url .= $qs;
		
		//initialize a new curl object            
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//echo $url . '?' . $qs;
		
		switch(strtoupper($method)) {
			case "GET":
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
				break;
			case "POST":
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $qs);
				break;
		}
		
		if(FALSE === ($response['result'] = curl_exec($ch)))
			return array('code' => 999, 'result' => "Curl failed with error " . curl_error($ch)); 
		
		$response['code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$response['result'] = json_decode($response['result']);
		
		curl_close($ch);	
		
		return $response;
	}
}