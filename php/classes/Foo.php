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
class Author
	/**
	 *id and primary key for table.
	 * mentioning a function to validate uuid's, but we dont have it written yet.
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

