<?php
/**
 *I understand the idea of specifying a namespace, but this exact bit of code is beyond me.
 */

namespace dginsburg\ObjectOriented;
require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once(dirname(__DIR__) . "/classes/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 *creating a class for table 'author'
 */
class
Author {
	/**
	 *id and primary key for table.
	 * mentioning a function to validate uuid's, but we dont have the actual uuid yet.
	 */
	use ValidateUuid;
	private $authorId;

	/**
	 * creating private variables for authorAvatarUrl, authorActivationToken, authorEmail, AuthorHash, authorUsername all in the same fashion. create them within a private class for distribution per our discretion later on.
	 */
	private $authorAvatarUrl;
	private $authorActivationToken;
	private $authorEmail;
	private $authorHash;
	private $authorUsername;

	/**
	 *accessor method for authorId
	 *
	 *
	 */

	public function __construct($newAuthorId, string $newAuthorAvatarUrl, string $newAuthorActivationToken,
										 string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername ) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	public function getAuthorId(): Uuid {
		return ($this->authorId);
}

	/**
	 * mutator method for authorId
	 *
	 * @param Uuid| string $newAuthorId
	 * @throws \RangeException if $newAuthorId value of new authorId
	 * @throws \TypeError if the authorId is not positive
	 * @thros \TypeError if the authorId is not
	 */

	public function setAuthorId($newAuthorId): void {
		try {
		$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	// convert and store authorId
		$this->authorId = $uuid;
	}
	/**
	 * accessor method for authorAvatarUrl
	 *
	 * @return string value of authorAvatarUrl
	 */
	public function getAuthorAvatarUrl(): ?string {
		return ($this->authorAvatarUrl);
	}

	/**
	 * mutator method for authorAvatarUrl
	 *
	 * @param string $newAuthorAvatarUrl
	 * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
	 * @throws \RangeException if the Url is not < 255 characters
	 * @throws \TypeError if the Url is not a string
	 */

	public function setAuthorAvatarUrl($newAuthorAvatarUrl) : void {
		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl);
		if(empty($newAuthorAvatarUrl) === true) {
			throw(new \RangeException("Author Avatar URL is is empty or insecure"));
		}
		if(strlen($newAuthorAvatarUrl)>255) {
			throw(new \RangeException("Author Avatar URL is too large"));
		}
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}
	
	/* accessor method for authorActivationToken
	 *
	 * @return string value of authorActivationToken
	 */
	
	
	public function getAuthorActivationToken(): ?string {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for author activation token
	 *
	 * @param string $newauthorActivationToken
	 * @throws \InvalidArgumentException if the url is not a string or insecure
	 * @throws \ TypeError if the url is not a string
	 */
	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
		if($newAuthorActivationToken === null) {
			$this->authorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accessor method for authorEmail
	 * @return string value of authorEmail
	 */
	public function getAuthorEmail():?string {
		return $this->authorEmail;
	}
	/**
	 *mutator method for authorEmail
	 *
	 *@param string $newAuthorEmail new email
	 *@throws \ InvalidArgumentException if $newEmail is not valid email or insecure
	 *@throws \RangeException if $newEmail is >128 characters
	 *@throws \TypeError if $newEmail is not a string
	 */

	public function setAuthorEmail( string $newAuthorEmail): void{
	$newAuthorEmail = trim($newAuthorEmail);
	$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
	if(empty($newAuthorEmail) === true) {
		throw(new \InvalidArgumentException("authorEmail is empty or insecure"));
	}
	if(strlen($newAuthorEmail) >128) {
		throw(new \RangeException("Author Email is too large"));
	}
	$this->authorEmail = $newAuthorEmail;
	}

	/**
	 *accessor method for author hash
	 *
	 * @return string value authorHash
	 */

	public function getAuthorHash():?string {
		return $this->authorHash;
	}

	/**
	 * Mutator method for author hash
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure 
	 * @throws \RangeException if the hash is >97 characters
	 */
	
	public function setAuthorHash(string $newAuthorHash): void {
		//enforce hash formatting
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("Author hash is not a valid hash"));
		}
		//enforce that it is an argon hash
		$newAuthorHashInfo = password_get_info($newAuthorHash);
		if($newAuthorHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("author hash is not a valid hash"));
		}
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("author hash must be 97 characters"));
		}
		$this->authorHash = $newAuthorHash;
	}

	/**
	 * accessor method for AuthorUsername
	 *
	 */
	public function getAuthorUsername():?string {
		return $this->authorUsername;
	}


	public function setAuthorUsername(string $newAuthorUsername) : void {
		$newAuthorUsername = trim($newAuthorUsername);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("author username is not a valid username"));
		}
		if(strlen($newAuthorUsername)>32){
			throw(new \RangeException("Author Username must be less than 32 characters"));
		}
		$this->authorUsername = $newAuthorUsername;
	}

	public function insert (\PDO $pdo) : void{
		$query = "insert into author(authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername) values (:authorId, :authorAvatarUrl, :authorActivationToken, authorEmail, authorHash, authorUsername)";
	}

	public function update(\PDO $pdo) : void {
		$query = "update tweet set authorId = :authorId, authorAvatarUrl = :authorAvatarUrl, authorActivationTOoken = :authorActivationToken, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername";
		$satement = $pdo->prepare($query);

		$parameters = ["authorId" => $this -> tweetId->getBytes(), "authorAvatarUrl => $this -> authorAvatarUrl, authorActivationToken => $this -> authorActivationToken, authorEmail => $this -> authorEmail, authorHash => $this -> authorHash -> getBytes(), authorUsername => $this -> authorUsername"];
		$satement ->execute($parameters);
	}
	public function delete (\PDO $pdo) : void {
		$query = "delete from author where authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" => $this->authorId->getbytes()];
			$statement -> execute ($parameters);
	}

	public static function getAuthorByAuthorId(\PDO $pdo, $authorId) : ?author {
		try{
			$authorId = self::validateUuid($authorId);
		}
		Catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		$query = "select authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorhash, authorUsername from author where authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = [authorId => $authorId->getBytes()];
		$statement->execute($parameters);

		try{
			$author = null;
			$statement->setFetchMode(\PDO::fetch_assoc);
			$row = $statement-fetch();
			if($row !== false) {
				$author = new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
			}
		}
		catch(\Exception $exception) {
			throw(new \PDOException($exception->getmessage(), 0, $exception));
		}
		return($author);
	}

	//get authors by email provider
	public static function getAuthorsByEmailProvider (\PDO $pdo, string $EmailType) : \SplFixedArray {
		$EmailType = trim($EmailType);
		$EmailType = filter_var($EmailType, filter_sanitze_string);
		if(empty($EmailType)===true){
			throw(new \PDOException("author Email is invalid"));
		}

		//escape sql wildcards
		$EmailType = str_replace("_", "\\_", str_replace("%", "\\%", $EmailType));

		//create query template
		$query = "select authorId, authorAvatarUrl, authorActivationToken, authorEmail, authorHash, authorUsername from author where authorEmail like :gmail";
		$statement = $pdo->prepare($query);

		//bind email to place holder
		$EmailType = "%$EmailType%";
		$parameters = ["EmailType" => $EmailType];
		$statement->execute ($parameters);

		//build array of authors
		$authors = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$authors[$authors->key()] =  new author($row["authorId"], $row["authorAvatarUrl"], $row["authorActivationToken"], $row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
				$authors->next();
			}
			catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($authors);
	}





}
