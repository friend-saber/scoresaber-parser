<?php declare(strict_types=1);
/**
 * @copyright Copyright (c) 2018 Robin Appelman <robin@icewind.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace ScoreSaberApi;

class Song {
	private $id;
	private $name;
	private $difficulty;
	private $image;
	private $mapper;

	public function __construct(int $id, string $name, string $difficulty, string $image, string $mapper) {
		$this->id = $id;
		$this->name = $name;
		$this->difficulty = $difficulty;
		$this->image = $image;
		$this->mapper = $mapper;
	}

	public function getId(): int {
		return $this->id;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getDifficulty(): string {
		return $this->difficulty;
	}

	public function getImage(): string {
		return $this->image;
	}

	public function getMapper(): string {
		return $this->mapper;
	}
}
