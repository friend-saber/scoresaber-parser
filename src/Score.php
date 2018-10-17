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

class Score {
	private $song;
	private $accuracy;
	private $rank;
	private $pp;
	private $weightedPP;
	private $time;

	public function __construct(Song $song, float $accuracy, int $rank, float $pp, float $weightedPP, \DateTime $time) {
		$this->song = $song;
		$this->accuracy = $accuracy;
		$this->rank = $rank;
		$this->pp = $pp;
		$this->weightedPP = $weightedPP;
		$this->time = $time;
	}

	public function getSong(): Song {
		return $this->song;
	}

	public function getAccuracy(): float {
		return $this->accuracy;
	}

	public function getRank(): int {
		return $this->rank;
	}

	public function getPp(): float {
		return $this->pp;
	}

	public function getWeightedPP(): float {
		return $this->weightedPP;
	}

	public function getTime(): \DateTime {
		return $this->time;
	}
}
