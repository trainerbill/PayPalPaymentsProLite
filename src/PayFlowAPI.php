<?php
namespace PayPalPaymentsProLite;
class PayFlowAPI {
	
	//Setup Variables
	protected $call_endpoint;
	protected $hosted_endpoint;
	protected $environment;
	protected $validation_parameters;
	
	//Call Variables
	protected $call_credentials;
	protected $call_query;
	protected $call_variables;
	protected $call_response;
	protected $call_response_decoded;	
	
	public function __construct($config = null)
	{
        // if no config load the config file
		if(is_null($config))
		{
			include __DIR__.'/../config/config.php';
		}

		$this->environment = $config['environment'];
		if($config['environment'] == 'production')
		{
			$this->call_endpoint = 'https://payflowpro.paypal.com';
			$this->hosted_endpoint = 'https://payflowlink.paypal.com';
		}
		else
		{	
			$this->call_endpoint = 'https://pilot-payflowpro.paypal.com';
			$this->hosted_endpoint = 'https://pilot-payflowlink.paypal.com';
		}
		$this->setCredentials($config['credentials']);
		
		$this->call_variables['VERBOSITY'] = 'HIGH';
		
	}
	
	//GET METHODS
	public function getCallResponse()
	{
		return $this->call_response;
	}
	
	public function getCallResponseDecoded()
	{
		return $this->call_response_decoded;
	}
	
	public function getCallEndpoint()
	{
		return $this->call_endpoint;
	}
	
	public function getHostedEndpoint()
	{
		return $this->hosted_endpoint;
	}
	
	public function getCallQuery()
	{
		return $this->call_query;
	}
	
	public function getCallVariables()
	{
		return $this->call_variables;
	}
	
	public function getCredentials()
	{
		return $this->call_credentials;
	}
	
	public function getEnvironment()
	{
		return $this->environment;
	}
	
	public function getValidationParameters()
	{
		return $this->validation_parameters;
	}
	
	public function setCredentials($credentials)
	{
		if(!is_array($credentials))
			throw new \Exception(__METHOD__ . ': argument must be an array.');
		
		if(!array_key_exists('PARTNER',$credentials))
			throw new \Exception(__METHOD__.': argument must contain a PARTNER key');
		
		if(!array_key_exists('VENDOR',$credentials))
			throw new \Exception(__METHOD__.': argument must contain a VENDOR key');
		
		if(!array_key_exists('USER',$credentials))
			throw new \Exception(__METHOD__.': argument must contain a USER key');
		
		if(!array_key_exists('PWD',$credentials))
			throw new \Exception(__METHOD__.': argument must contain a PWD key');
		
		$this->call_credentials = $credentials;
		return $this->call_credentials;	
	}
	
	public function pushVariables($variables)
	{
		if(!is_array($variables))
			throw new \Exception(__METHOD__ . ': argument must be an array.');
		
		foreach($variables as $key => $value)
		{
			$this->call_variables[$key] = $value;
		}
		return $this->call_variables;
	}
	
	public function clearVariables()
	{
		$this->call_variables = array();
	}
	
	public function clearCredentials()
	{
		$this->call_credentials = array();
	}
	
	//Worker functions
	public function getApiString()
	{
		$string = '';
		foreach($this->call_credentials as $key => $value)
			$string .= $key . '=' . $value . '&';
		foreach($this->call_variables as $key => $value)
			$string .= $key . '=' . $value . '&';
		//Always set VERBOSITY = HIGH
		$string.='VERBOSITY=HIGH';
		$this->call_query = $string;
		return $string;
	}
	
	public function decodeReturn($inputdata = NULL)
	{
		if(!$inputdata)
			$inputdata = $this->call_response;
		
		$data = array();
		$key = explode('&',$inputdata);
		foreach($key as $temp)
		{
			$keyval = explode('=',$temp);
			if(isset($keyval[1]))
				$data[$keyval[0]] = $keyval[1];
		}
		$this->call_response_decoded = $data;
		return $data;
	}
	
	public function quickValidation()
	{
		if($this->validation_parameters && is_array($this->validation_parameters))
		{
			foreach($this->validation_parameters as $key )
			{
				if(!array_key_exists($key,$this->call_variables))
					throw new \Exception(__METHOD__.': '.$key.' is listed as a required variable and not present in the call variables.');
			}
		}
	}
	
	public function executeCall()
	{
		$this->quickValidation();
		
		$string = $this->getApiString();
		$ch = curl_init ();
		curl_setopt($ch, CURLOPT_URL,$this->call_endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $string);  //Set My query string
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$this->call_response =  curl_exec($ch);		//Execute the API Call
		$this->decodeReturn();
		
		return $this->call_response;
	}
	
}