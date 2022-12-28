<?php
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

require "BaseController.php";

class UserController extends BaseController {

	private $secret_key = 'Kjs_&a$ua#ljn:Ys#%';
	private $api_autho = 'Kjs_&a$ua#ljn:Ys#%';
	private $api_fatch = 'https://www.sgcarena.com/wp-json/wp/v2/posts/';
	private $api_encrypt = 'http://localhost/rest-api/index.php/key/encrypt?string=';
	private $api_decrypt = 'http://localhost/rest-api/index.php/key/decrypt?string=';
	
	public function __construct(){
		/*$this->encrypt_method = "AES-256-CBC";
		$this->key = hash( 'sha256', $this->secret_key );
		$this->iv = substr( hash( 'sha256', $this->secret_iv ), 0, 16 );*/
	}

	/**
	 * 
	 * Get All Post
	 * 
	 * */
	public function get_posts()
	{
		$api_uri = $this->api_fatch . '?per_page=24';
		$response = json_decode( $this->CallAPI( 'GET', $api_uri ) );

		if ( empty( $response ) ) {
			return;
		}

		$page = get_headers( $api_uri, 1);

		return array($response, $page['x-wp-totalpages']);
	}

	/**
	 * 
	 * Get Single Post
	 * 
	 * */
	public function get_post()
	{
		//GET REQUEST information from URL
		$veebom_post_uri = $_GET;
		$veebom_post_type = filter_var( $veebom_post_uri['veebom_post_type'], FILTER_SANITIZE_STRING );
		$veebom_post_id = filter_var( $veebom_post_uri['veebom_post_id'], FILTER_SANITIZE_NUMBER_INT );

		/* Run This only for BUSSID or bsi request */
		if ( $veebom_post_type != 'bsi') {
			return;
		}

		/* Create Single post GET api URL */
		$api_uri = $this->api_fatch . $veebom_post_id;


		$response = json_decode( $this->CallAPI( 'GET', $api_uri ) );

		if ( empty( $response ) ) {
			return;
		}

		return $response;
	}

	/**
	 * 
	 * "/index.php/{key}/encrypt?valid=10&string={DATE}" Endepoint - Encrepted Value
	 * 
	 * @var ?valid = int; (Adition time is seconds)
	 * @var ?string = string; (Current time in datetime formate)
	 * 
	 * @return array
	 * 	key=> "{result}"
	 * 
	 * */
	public function encrypt() {

	}

	/**
	 * 
	 * "/index.php/{key}/decrypt?string={STRING}" Endepoint - Decrypt Value
	 * 
	 * @var ?string = string; (Encrepted hash value)
	 * 
	 * @return array
	 * 	key=> "{result}"
	 * 
	 * */
	public function decrypt() {
		
	}

}