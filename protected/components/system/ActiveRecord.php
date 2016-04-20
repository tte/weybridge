<?php

/**
 * Class ActiveRecord
 */
class ActiveRecord extends CActiveRecord {

	/**
	 * @param $limit
	 * @return ActiveRecord
	 */
	public function limit($limit) {
		$this->getDbCriteria()->mergeWith(array(
			'limit' => $limit,
		));
		return $this;
	}

	/**
	 * @param $offset
	 * @return ActiveRecord
	 */
	public function offset($offset) {
		$this->getDbCriteria()->mergeWith(array(
			'offset' => $offset,
		));
		return $this;
	}

	/**
	 * @param $raw
	 * @param $orderDirection
	 * @return ActiveRecord
	 */
	public function orderBy($raw, $orderDirection) {
		$this->getDbCriteria(TRUE)->mergeWith(array(
			'order' => sprintf('%s %s', $raw, $orderDirection)
		));
		return $this;
	}

	/**
	 * @param $raw
	 * @return $this
	 */
	public function group($raw) {
		$this->getDbCriteria()->mergeWith(array(
			'group' => $raw
		));

		return $this;
	}

	/**
	 * @param bool $isActive
	 * @return $this
	 */
	public function whereActive($isActive = TRUE) {
		$this->getDbCriteria()->mergeWith(array(
			'condition' => 't.`is_active` = :is_active',
			'params' => array(':is_active' => $isActive)
		));

		return $this;
	}

	/**
	 * @param array $ids
	 * @return $this
	 */
	public function whereIdIn(array $ids) {
		$ids = "'".implode("','", $ids)."'";

		$this->getDbCriteria()->mergeWith(array(
			'condition' => 't.`id` IN ('.$ids.')',
			'order' => 'FIELD(t.id, '.$ids.') ASC'
		));

		return $this;
	}

}