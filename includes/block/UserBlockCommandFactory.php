<?php

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace MediaWiki\Block;

use MediaWiki\HookContainer\HookContainer;
use User;

class UserBlockCommandFactory implements UnblockUserFactory {
	/**
	 * @var BlockPermissionCheckerFactory
	 */
	private $blockPermissionCheckerFactory;

	/**
	 * @var DatabaseBlockStore
	 */
	private $blockStore;

	/**
	 * @var HookContainer
	 */
	private $hookContainer;

	/**
	 * @param BlockPermissionCheckerFactory $blockPermissionCheckerFactory
	 * @param DatabaseBlockStore $blockStore
	 * @param HookContainer $hookContainer
	 */
	public function __construct(
		BlockPermissionCheckerFactory $blockPermissionCheckerFactory,
		DatabaseBlockStore $blockStore,
		HookContainer $hookContainer
	) {
		$this->blockPermissionCheckerFactory = $blockPermissionCheckerFactory;
		$this->blockStore = $blockStore;
		$this->hookContainer = $hookContainer;
	}

	/**
	 * @param User|string $target
	 * @param User $performer
	 * @param string $reason
	 * @param array $tags
	 *
	 * @return UnblockUser
	 */
	public function newUnblockUser(
		$target,
		User $performer,
		string $reason,
		array $tags = []
	) : UnblockUser {
		return new UnblockUser(
			$this->blockPermissionCheckerFactory,
			$this->blockStore,
			$this->hookContainer,
			$target,
			$performer,
			$reason,
			$tags
		);
	}
}
