<?php
	$array_unit_kerja = $this->lunit_kerja->get_tree($_POST);
	if (!empty($_POST['K_PARENT'])) {
		$parent_unit_kerja_temp = $this->lunit_kerja->get_by_id(array( 'K_UNIT_KERJA' => $_POST['K_PARENT'] ));
		$parent_unit_kerja_temp['CHILDREN'] = $array_unit_kerja;
		$parent_unit_kerja[] = $parent_unit_kerja_temp;
		$array_unit_kerja = $parent_unit_kerja;
	}
?>

<?php echo get_select_tree($array_unit_kerja); ?>