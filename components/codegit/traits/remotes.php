<?php


trait Remotes {

	public function getRemotes() {
		$result = $this->execute("git remote -v");
		return $result["status"] ? $result["data"] : "Error loading remotes";
	}

	public function addRemote($name, $url) {
		$result = $this->execute("git remote add$name $url");
		return $result["status"] ? $result["data"] : "Error loading remotes";
	}


	/**
	* Renames remote repository
	* @param  string
	* @param  string
	* @return self
	* @throws GitException
	*/
	public function renameRemote($oldName, $newName) {
		return $this->begin()
		->run('git remote rename', $oldName, $newName)
		->end();
	}


	/**
	* Removes remote repository
	* @param  string
	* @return self
	* @throws GitException
	*/
	public function removeRemote($name) {
		return $this->begin()
		->run('git remote remove', $name)
		->end();
	}


	/**
	* Changes remote repository URL
	* @param  string
	* @param  string
	* @param  array|NULL
	* @return self
	* @throws GitException
	*/
	public function setRemoteUrl($name, $url, array $params = NULL) {
		return $this->begin()
		->run('git remote set-url', $params, $name, $url)
		->end();
	}
}