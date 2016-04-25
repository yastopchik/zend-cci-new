<?php
namespace DmnDatabase\Service;

abstract class ArrayHelper {

	/**
	 *
	 * @param mixed $array        	
	 * @param callable $callback        	
	 * @throws Exception\InvalidArgumentException
	 * @return array
	 */
	public static function findAll(&$array, callable $callback) {
		if (!is_array($array) && !($array instanceof \Traversable)) {
			throw new Exception\InvalidArgumentException('Input array must be array or implements Traversable');
		}
		return array_filter($array, $callback);
	}

	/**
	 *
	 * @param mixed $array        	
	 * @param callable $callback        	
	 * @throws Exception\InvalidArgumentException
	 * @return mixed | NULL
	 */
	public static function findOne(&$array, callable $callback) {
		if (!is_array($array) && !($array instanceof \Traversable)) {
			throw new Exception\InvalidArgumentException('Input array must be array or implements Traversable');
		}
		foreach ($array as $value) {
			if (true === $callback($value)) {
				return $value;
			}
		}
		return null;
	}

	/**
	 *
	 * @param mixed $array        	
	 * @param string $columnName
	 *        	* @throws Exception\InvalidArgumentException
	 * @return array
	 */
	public static function enumOneColumn(&$array, $columnName) {
		if (!is_array($array) && !($array instanceof \Traversable)) {
			throw new Exception\InvalidArgumentException('Input array must be array or implements Traversable');
		}
		$list = array();
		foreach ($array as $item) {
			if (array_key_exists($columnName, $item)) {
				$list[] = $item[$columnName];
			}
		}
		return $list;
	}

	public static function orderBy(&$array, $fieldName, $sort = SORT_REGULAR, $direction = SORT_ASC) {
		// todo
	}

	/**
	 *
	 * @param array $input        	
	 * @param callable $compareFunc        	
	 * @throws \InvalidArgumentException
	 * @return array
	 */
	public static function array_group($input, callable $compareFunc) {
		if (!is_array($input) && !($input instanceof \Traversable)) {
			throw new \InvalidArgumentException('Input array must be array or Traversable instance');
		}
		$groups = [];
		$usedPositions = [];
		$topPosition = 0;
		$i = 0;
		foreach ($input as $top) {
			if (!in_array($topPosition, $usedPositions)) {
				$group = [
					$top 
				];
				$usedPositions[] = $topPosition;
				$childPosition = 0;
				foreach ($input as $child) {
					if (!in_array($childPosition, $usedPositions) && $compareFunc($top, $child)) {
						$group[] = $child;
						$usedPositions[] = $childPosition;
					}
					$childPosition++;
				}
				$groups[] = $group;
			}
			$i++;
			$topPosition++;
		}
		return $groups;
	}

	/**
	 *
	 * @param array $array        	
	 * @param string $multikey        	
	 * @param string $keySeparator        	
	 * @return boolean
	 */
	public static function multiKeyExists(array &$array, $multikey, $keySeparator = '.') {
		$checkArr = &$array;
		$keys = explode($keySeparator, $multikey);
		foreach ($keys as $index => $key) {
			if (array_key_exists($key, $checkArr)) {
				$checkArr = &$checkArr[$key];
			} else {
				return false;
			}
		}
		return true;
	}

	/**
	 *
	 * @param array $array        	
	 * @param string $multikey        	
	 * @param string $keySeparator        	
	 * @return NULL | mixed
	 */
	public static function multiKeyGet(array &$array, $multikey, $keySeparator = '.') {
		$checkArr = &$array;
		$keys = explode($keySeparator, $multikey);
		foreach ($keys as $index => $key) {
			if (array_key_exists($key, $checkArr)) {
				$checkArr = &$checkArr[$key];
			} else {
				return null;
			}
		}
		return $checkArr;
	}

}

?>