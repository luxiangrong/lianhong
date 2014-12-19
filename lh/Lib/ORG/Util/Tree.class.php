<?php
class Tree {
	/** 
	* Description 
	* @var 
	* @since 1.0 
	* @access private 
	*/
	var $data = array ();

	/** 
	* Description 
	* @var 
	* @since 1.0 
	* @access private 
	*/
	var $child = array (
		-1 => array ()
	);

	/** 
	* Description 
	* @var 
	* @since 1.0 
	* @access private 
	*/
	var $layer = array (
		-1 => -1
	);

	/** 
	* Description 
	* @var 
	* @since 1.0 
	* @access private 
	*/
	var $parent = array ();

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function Tree($value) {
		$this->setNode(0, -1, $value);
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function setNode($id, $parent, $value) {
		$parent = $parent ? $parent : 0;

		$this->data[$id] = $value;
		$this->child[$id] = array ();
		$this->child[$parent][] = $id;
		$this->parent[$id] = $parent;

		if (!isset ($this->layer[$parent])) {
			$this->layer[$id] = 0;
		} else {
			$this->layer[$id] = $this->layer[$parent] + 1;
		}
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function getList(& $tree, $root = 0) {
		foreach ($this->child[$root] as $key => $id) {
			$tree[] = $id;

			if ($this->child[$id])
				$this->getList($tree, $id);
		}
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function getValue($id) {
		return $this->data[$id];
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function getLayer($id, $space = false) {
		return $space ? str_repeat($space, ($this->layer[$id]-1)*2) : $this->layer[$id];
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function getParent($id) {
		return $this->parent[$id];
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function getParents($id) {
		while ($this->parent[$id] != -1) {
			$id = $parent[$this->layer[$id]] = $this->parent[$id];
		}

		ksort($parent);
		reset($parent);

		return $parent;
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function getChild($id) {
		return $this->child[$id];
	} // end func 

	/** 
	* Short description. 
	* 
	* Detail description 
	* @param none 
	* @global none 
	* @since 1.0 
	* @access private 
	* @return void 
	* @update date time 
	*/
	function getChilds($id = 0) {
		$child = array (
			$id
		);
		$this->getList($child, $id);

		return $child;
	} // end func 
} // end class 
?> 