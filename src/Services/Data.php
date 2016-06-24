<?php

namespace Teamtimemanager\Services;

 Class Data
 {

 	public function findAllContributors ()
 	{
 		return new ContributorCollection($contributors)
 	}

 }
