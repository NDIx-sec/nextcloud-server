<?php

/**
 * SPDX-FileCopyrightText: 2021-2024 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
namespace OCP;

/**
 * Class HintException
 *
 * An Exception class with the intention to be presented to the end user
 *
 * @package OCP
 * @since 23.0.0
 */
class HintException extends \Exception {
	private $hint;

	/**
	 * HintException constructor.
	 *
	 * @since 23.0.0
	 * @param string $message The error message. It will be not revealed to the
	 *                        the user (unless the hint is empty) and thus
	 *                        should be not translated.
	 * @param string $hint A useful message that is presented to the end
	 *                     user. It should be translated, but must not
	 *                     contain sensitive data.
	 * @param int $code
	 * @param \Exception|null $previous
	 */
	public function __construct($message, $hint = '', $code = 0, ?\Exception $previous = null) {
		$this->hint = $hint;
		parent::__construct($message, $code, $previous);
	}

	/**
	 * Returns a string representation of this Exception that includes the error
	 * code, the message and the hint.
	 *
	 * @since 23.0.0
	 * @return string
	 */
	public function __toString(): string {
		return self::class . ": [{$this->code}]: {$this->message} ({$this->hint})\n";
	}

	/**
	 * Returns the hint with the intention to be presented to the end user. If
	 * an empty hint was specified upon instantiation, the message is returned
	 * instead.
	 *
	 * @since 23.0.0
	 * @return string
	 */
	public function getHint(): string {
		if (empty($this->hint)) {
			return $this->message;
		}
		return $this->hint;
	}
}
