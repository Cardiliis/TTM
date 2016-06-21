-<?php
 -
 -namespace Teamtimemanager\Domain;
 -
 -Class Contributor
 -{
 -	private
 -		$login,
 -		$firstname,
 -		$lastname,
 -
 -	public function __construct($login, $firstname, $lastname)
 -	{
 -		$this->login = $login;
 -		$this->firstname = $firstname;
 -		$this->lastname = $lastname;
 -	}
 -
 -	public function getLogin ()
 -	{
 -		return $this->login;
 -	}
 -
    public function getFirstName()
    {
      return $this->firstname;
    }

    public function getLastName()
    {
      return $this->firstname;
    }

    public function getContributor()
    {
      return new Contributor($contributor)
    }

    public function getContributorList()
    {
      return new ContributorCollection($contributors)
    }
 -}
