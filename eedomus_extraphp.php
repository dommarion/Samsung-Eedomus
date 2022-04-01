//
//----------------------------------------------------------------
// Déclaration des fonctions complémentaires aux fonctions Eedomus
// pour contourner les fonctions php bloquées sur la box Eedomus 
//       sdk_is_bool
//	 sdk_is_array
//	 sdk_json_encode (fonctionne que sur 3 niveaux)
//	 sdk_generateRandomString
//----------------------------------------------------------------
//
// Fonction PHP is_bool():boolean (true/false)
function sdk_is_bool($data) {
    $reply = false;
    $type = gettype($data);
    if ($type == 'boolean') {$reply = true;}
    return $reply;
}

// Fonction PHP is_array():boolean (true/false)
function sdk_is_array($data) {
    $reply = false;
    $type = gettype($data);
    if ($type== 'array') {$reply = true;}
    return $reply;
}

// Fonction PHP json_encode():string - pour l'instant gère 3 niveaux "seulement"
function sdk_json_encode($array) {
	if (sdk_is_array($array)){$l=count($array);
	}
	else {$l=1;}
    	$i=1;
    	$result='';
	foreach ($array as $id=>$value)
    	{
        if (sdk_is_array($value))
        	{
		$l2=count($value);
		$i2=1;
		if (!is_int($id)&&($i>1)) {$result .='"'.$id.'":[{';}
		elseif ($i>1) {$result .='[{';}
		foreach ($value as $id2=>$value2)
			{
        		if (sdk_is_array($value2))
        			{
				$l3=count($value2);
				$i3=1;
				if (($i==1) && ($i2==1) && ($i3==1)) {$result .= '{"'.$id.'":[{';}
				if (!is_int($id2)&&($i2>1)) {$result .='"'.$id2.'":{';}
				elseif ($i2>1) {$result .='{';}
				foreach ($value2 as $id3=>$value3)
					{
 					$result .='"'.$id3.'":';
					if (sdk_is_bool($value3)) 
						{if ($value3 == true) 
							{$result.='true';}
			 			else {$result.='false';}
						}
					elseif (is_int($value3)) {$result.=$value3;}
						else {$result.='"'.$value3.'"';
						    }
		        		if ($i3 < $l3) {$result .=',';}
        				$i3++;
					}
    				if (!is_int($id2)&&($i2<$l2)) {$result .='}';}
				elseif ($i2<$l2) {$result .='}';}
		        	if ($i2 < $l2) {$result .=',';}
        			$i2++;
				}
			else
				{
				$value2_a= (array) $value2;
				if ($i2==1) {$result .='{';}
				$result .='"'.$id2.'":';
				if (sdk_is_bool($value2_a[0])) 
					{if ($value2_a[0] == true) 
						{$result.='true';}
					else {$result.='false';}
					}
				elseif (is_int($value2_a[0])) {$result.=$value2_a[0];}
					else {$result.='"'.$value2_a[0].'"';
					    }
		        	if ($i2 < $l2) {$result .=',';}
				if ($i2 == $l2) {$result .='}';}
        			$i2++;
				}
			}
    		if (!is_int($id)) {$result .='}]';}
		if ($i < $l) {$result .=',';}
        	$i++;
		}
        else
		{
		$value_a= (array) $value;
		if ($i==1) {$result .='{';}
		$result .='"'.$id.'":';
		if (sdk_is_bool($value_a[0])) 
			{if ($value_a[0] == true) 
				{$result.='true';}
			 else {$result.='false';}
			}
		elseif (is_int($value_a[0])) {$result.=$value_a[0];}
		else {$result.='"'.$value_a[0].'"';
		    }
        	if ($i < $l) {$result .=',';}
		if ($i == $l) {$result .='}';}
        	$i++;
		}
	}
    return $result;
}

// Fonction pour générer une chaine de n caractères aléatoires (Majuscules, minuscules et chiffres)
function sdk_generateRandomString($length = 16) {
	if (is_int($length))
		{
		if ($length >0) 
			{
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    			$charactersLength = strlen($characters);
    			$randomString = '';
    			for ($i = 0; $i < $length; $i++) 
				{
        			$randomString .= $characters[rand(0, $charactersLength - 1)];
    				}
			}
		else {$randomString='';}
		}
	else {$randomString='';}
    return $randomString;
}

//
//----------------------------------------------------------------
// Fin des fonctions complémentaires aux fonctions eedomus
//----------------------------------------------------------------
