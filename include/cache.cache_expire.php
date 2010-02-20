<?php
/*
 *  cache.cache_expire.pehe
 *  gitphp: A PHP git repository browser
 *  Component: Cache - cache expire
 *
 *  Copyright (C) 2009 Christopher Han <xiphux@gmail.com>
 */

function cache_expire($expireall = false)
{
	global $tpl, $gitphp_current_project;

	if ($expireall) {
		$tpl->clear_all_cache();
		return;
	}

	if (!$gitphp_current_project)
		return;

	$headlist = $gitphp_current_project->GetHeads();

	if (count($headlist) > 0) {
		$age = $headlist[0]->GetCommit()->GetAge();

		$tpl->clear_cache(null, sha1($gitphp_current_project->GetProject()), null, $age);

		$tpl->clear_cache('projectlist.tpl', sha1(serialize(GitPHP_ProjectList::GetInstance()->GetConfig())), null, $age);
	}
}

?>
