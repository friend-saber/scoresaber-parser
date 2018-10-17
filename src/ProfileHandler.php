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


class ProfileHandler extends BaseHandler {
	private function getRecentScoresPage(string $id, int $page = 1): \SimpleXMLElement {
		return $this->getHTML('/u/' . $id . '?sort=2&page=' . $page);
	}

	/**
	 * @param \SimpleXMLElement $doc
	 * @return \Generator|Score[]
	 */
	private function getScoresFromDoc(\SimpleXMLElement $doc): \Generator {
		$rows = $doc->xpath("//table[contains(@class, 'songs')]/tbody/tr");
		if (!$rows) {
			return;
		}
		foreach ($rows as $row) {
			$rank = (int)substr(trim((string)$row->xpath("./th[contains(@class, 'rank')]")[0]), 1);
			$image = (string)$row->xpath(".//img[contains(@src, 'imports/images')]")[0]->attributes()->src;
			$id = (int)substr((string)$row->xpath(".//a[contains(@href, '/leaderboard/')]")[0]->attributes()->href, 13);
			$title = (string)$row->xpath(".//span[contains(@class, 'songTop pp')]")[0];
			$mapper = (string)$row->xpath(".//span[contains(@class, 'songTop mapper')]")[0];
			$difficulty = (string)$row->xpath(".//span[contains(@class, 'songTop pp')]")[0]->children()[0];
			$time = new \DateTime((string)$row->xpath(".//span[contains(@class, 'time')]")[0]->attributes()->title);
			$accuracyNodes = $row->xpath(".//span[contains(text(), 'accuracy')]");
			$accuracy = $accuracyNodes ? (float)substr((string)$accuracyNodes[0], 10, -1) : 0;
			$pp = (float)(string)$row->xpath(".//span[contains(@class, 'ppValue')]")[0];
			$weightedPP = (float)substr((string)$row->xpath(".//span[contains(@class, 'ppWeightedValue')]")[0], 1);
			$song = new Song($id, $title, $difficulty, $image, $mapper);
			yield new Score($song, $accuracy, $rank, $pp, $weightedPP, $time);
		}
	}

	/**
	 * @param string $id
	 * @return \Generator|Score[]
	 */
	public function getRecentScores(string $id): \Generator {
		$doc = $this->getRecentScoresPage($id, 1);
		$maxPage = (int)$doc->xpath("//ul[contains(@class, 'pagination-list')]/li[last()]/a/text()")[0];
		$currentPage = 1;
		while ($currentPage <= $maxPage) {
			$scores = $this->getScoresFromDoc($doc);
			foreach ($scores as $score) {
				yield $score;
			}

			$currentPage++;
			$doc = $this->getRecentScoresPage($id, $currentPage);
		}
	}
}
