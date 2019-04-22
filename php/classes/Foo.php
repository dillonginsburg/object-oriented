<?php
/**
 *I understand the idea of specifying a namespace, but this exact bit of code is beyond me.
 */

namespace dginsburg\objectOriented;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 *creating a class for table 'author'
 */
class Author {
	/**
	 *id and primary key for table.
	 * mentioning a function to validate uuid's, but we dont have the actual uuid yet.
	 */
	use ValidateUuid
	private $authorId;

	/**
	 * creating private variables for authorAvatarUrl, authorActivationToken, authorEmail, AuthorHash, authorUsername all in the same fashion. create them within a private class for distribution per our discretion later on.
	 */
	private $authorAvatarUrl
	private $authorActivationToken
	private $authorEmail
	private $authorHash
	private $authorUsername

	/**
	 *accessor method for authorId
	 *
	 * @return Uuid for authorId
	 */
	public function getAuthorId(): Uuid {
		return ($this->authorId)
}

	/**
	 * mutator method for authorId
	 *
	 * @param Uuid| string $newAuthorId
	 * @throws \RageException if $newAuthorId value of new authorId
	 * @throws \TypeErrorif the authorId is not positive
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
	 * @throws \
	 */
	
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
		$this->authorActivationToken = $newAuthorActivationToken
	}
	
}