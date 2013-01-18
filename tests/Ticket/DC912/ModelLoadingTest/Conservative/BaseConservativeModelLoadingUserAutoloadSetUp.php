<?php
abstract class BaseConservativeModelLoadingUserAutoloadSetUp extends Doctrine_Record
{
    public function setTableDefinition()
    {

    }
	
	static public function autoloadSetUp () {
		global $autoloadSetUpCalled;
		$autoloadSetUpCalled = true;
	}
}