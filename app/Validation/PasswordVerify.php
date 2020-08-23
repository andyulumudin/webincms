<?php

namespace App\Validation;

class PasswordVerify
{
    public function passcheck($str): bool
	{
        // echo $str.'==';
        if($str !== '') {
            return true;
        }
        return false;
		// // Grab any data for exclusion of a single row.
		// list($field, $ignoreField, $ignoreValue) = array_pad(explode(',', $field), 3, null);

		// // Break the table and field apart
		// sscanf($field, '%[^.].%[^.]', $table, $field);

		// $db = Database::connect($data['DBGroup'] ?? null);

		// $row = $db->table($table)
		// 		  ->select('1')
		// 		  ->where($field, $str)
		// 		  ->limit(1);

		// if (! empty($ignoreField) && ! empty($ignoreValue))
		// {
		// 	if (! preg_match('/^\{(\w+)\}$/', $ignoreValue))
		// 	{
		// 		$row = $row->where("{$ignoreField} !=", $ignoreValue);
		// 	}
		// }

		// return (bool) ($row->get()
		// 				->getRow() === null);
	}
}