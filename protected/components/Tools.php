<?php
class Tools{
	/**
	 * Convierte todos los elementos
	 * de un arreglo en UTF-8, aun en arreglos multi-dimensionales.
	 * @param Array $array
	 * @return Array
	 */
	public static function arreglo2Utf8($array) {
		$miArr = array();
		foreach($array as $key => $value) {
			if(is_array($value)) {
				$miArr[$key] = $this->arreglo2Utf8($value);
			} else {
				$aaa = utf8_encode($value);
				$miArr[$key] = $aaa;
			}
		}
		return $miArr;
	}
	
	public static function array2Json($data){
		$dataAux = Tools::arreglo2Utf8($data);
		return json_encode($dataAux);
	}
	
	/**
     *
     * @param String $text
     * @return String
     */
	public static function encrypt($text,$salt) {
		if (!isset($salt)){
			$salt = 'kcw3;5*!9;*!neo,.d\h';
		}
        return trim(strtr((base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))), '+/', '-_'), '=');
    }

    /**
     *
     * @param String $text
     * @return String
     */
    public static function decrypt($text,$salt) {
		if (!isset($salt)){
			$salt = 'kcw3;5*!9;*!neo,.d\h';
		}
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode(str_pad(strtr($text, '-_', '+/'), strlen($text) % 4, '=', STR_PAD_RIGHT)), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
	
	public static function build_full_request_id($request_id, $user_id) {
      return $request_id . '_' . $user_id; 
   }
}