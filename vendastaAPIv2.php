<?php
 /**
 * vendastaAPI - Vendasta Partner API PHP Library
 *
 * You can find the APi documentation here: http://www.vendasta.com/documentation
 *
 * @version  2
 * @category Services
 * @package  Vendasta Partner API PHP Library
 * @author   Paden Clayton <sales@fasttracksites.com>
 * @link     http://www.fasttracksites.com
 */
 
class vendastaAPIv2
{
	private $api_url = 'https://reputation-intelligence-api.vendasta.com/api/v2/';
	public  $apiUser = ''; // Set this here or during constructor
	public  $apiKey = ''; // Set this here or during constructor

	/** 
	* Our class constructor
	*
	* @param string $apiUser				Partner identifier provided by Vendasta
	* @param string $apiKey		API Key provided by Vendasta
	*
	*/
	public function __construct( $apiUser		 = '', $apiKey = '' ) {
		if ( !empty( $apiUser		 ) )
			$this->pid = $apiUser		;
			
		if ( !empty( $apiKeypid ) )
			$this->apiKey = $apiKey;
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
	public function lookupError( $codeOrArray ) {	
		$code = ( is_array( $codeOrArray ) ) ? $codeOrArray['code'] : $codeOrArray;	
		$errorCodes = array(
			200 => 'Request succeeded.',
			201 => 'Account creation succeeded.',
			202 => 'Account was scheduled for update/deletion.',
			400 => 'Incoming POST or GET was malformed in some way, see response for message.',
			401 => 'We could not validate your pid/apiKey combination.',
			403 => 'You do not have permission to access the specified item.',
			404 => 'We could not find the item specified.',
			405 => 'You did not use the required POST method.',
			409 => 'An account with the provided customerId or ssoToken already exists in our system.',
			999 => $codeOrArray['result'],
		);
		$errorCode = ( isset( $errorCodes[$code] ) ) ? $errorCodes[$code] : 'Some unexpected error occurred. (Reported Error: ' . var_export( $code, true ) . ')';
		
		return $errorCode;
	}
	
	/** 
	* Determine if a call resulted in an error
	*
	* @param int $requestArray	This is the array returned from _request
	*
	*/
	public function hasError( $requestArray ) {	
		$sucessCodes = array( 200, 201, 202 );	
		return ( in_array( $requestArray['code'], $sucessCodes ) ) ? false : true;
	}

	/**
	* Request using PHP CURL functions
	* Requires curl library installed and configured for PHP
	* Returns response from the AuthorityLabs Partner API
	*
	* @param string $path			Path for the API request - specifies priority or get URL when applicable
	* @param array $request_vars	Data for making the request to API
	* @param string $method			Specifies POST or GET method
	*
	*/		
	public function request( $path = '', $request_vars = array(), $method = 'POST' ) {
		$qs = 'pid=' . $this->pid . '&apiKey=' . $this->apiKey;
		$response = array(
			'code' => '',
			'result' => '',
		);
		
		foreach( $request_vars AS $key => $value ) {
			if ( is_array( $value ) ) {
				foreach( $value AS $value2 ) {
					$qs .= '&' . $key . '=' . urlencode($value2);
				}				
			} else {
				$qs .= '&' . $key . '=' . urlencode($value);
			}
		}
		
		//construct full api url
		$url = $this->api_url . $path;
		if( strtoupper( $method ) == 'GET' )
		$url .= $qs;
		
		//initialize a new curl object            
		$ch = curl_init();
		
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
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
		
		if( FALSE === ( $response['result'] = curl_exec( $ch) ) )
			return array('code' => 999, 'result' => "Curl failed with error " . curl_error($ch)); 
		
		$response['code'] = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		$response['result'] = json_decode( $response['result'] );
		
		curl_close($ch);	
		
		return $response;
	}
}